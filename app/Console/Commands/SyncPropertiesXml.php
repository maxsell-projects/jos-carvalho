<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\User;

class SyncPropertiesXml extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-properties-xml';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize properties from Ximo XML feed';

    /**
     * Helper to download the external image and save to public storage
     */
    private function downloadImage($url, $reference)
    {
        if (empty($url)) return null;
        
        try {
            $name = basename(parse_url($url, PHP_URL_PATH));
            // e.g. 717ab093-e8b0-4ad1.jpg
            $filename = 'properties/' . $reference . '/' . $name;
            
            if (Storage::disk('public')->exists($filename)) {
                return $filename; // Already downloaded
            }
            
            $response = Http::timeout(60)->get($url);
            if ($response->successful()) {
                Storage::disk('public')->put($filename, $response->body());
                return $filename;
            }
        } catch (\Exception $e) {
            Log::error("Failed to download image [{$reference}]: " . $url . " - " . $e->getMessage());
        }
        return null;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Starting XML Property Synchronization...");

        $url = 'http://services.ximo.pt/export_xml_base/default.aspx?h=4409D627-376B-4B7E-92EF-E1E2607C3430&p=FFINOFGSPHRIEOVGSPQZSOAEGCUDBFWX-605856&l=pt';
        
        $this->info("Downloading XML feed...");
        
        // Use streaming or store in a local file as XML can be large
        $response = Http::timeout(120)->get($url);
        
        if (!$response->successful()) {
            $this->error("Failed to download XML feed.");
            return;
        }

        $xmlString = $response->body();
        $xml = @simplexml_load_string($xmlString);

        if ($xml === false) {
            $this->error("Failed to parse the downloaded XML.");
            return;
        }

        // Find the user to associate with the properties
        $user = User::where('email', 'josecarvalho@tophousers.pt')->first() ?? User::first();
        $userId = $user ? $user->id : 1;

        $count = 0;
        $activeReferences = [];

        $this->info("Processing properties...");

        foreach ($xml->imovel as $item) {
            // Todos os imóveis serão processados em produção

            $reference = (string)$item->ref;
            if (empty($reference)) continue;

            $activeReferences[] = $reference;

            $title = (string)$item->titulo;
            $description = (string)$item->txtpublicitario1_pt;
            
            $type = isset($item->tipo) ? (string)$item->tipo : 'Apartamento';
            $status = isset($item->objectivo) ? (string)$item->objectivo : 'Venda';
            
            $city = isset($item->concelho) ? (string)$item->concelho : null;
            $location = isset($item->freguesia) ? (string)$item->freguesia : null;
            $address = isset($item->zona) ? (string)$item->zona : null;

            $price = isset($item->precoweb) ? (float)$item->precoweb : null;
            if ($price == 0 && isset($item->preco)) {
                $price = (float)$item->preco;
            }

            $areaGross = isset($item->areabruta) ? (float)$item->areabruta : null;
            $areaUseful = isset($item->areautil) ? (float)$item->areautil : null;
            $areaLand = isset($item->areaterreno) ? (float)$item->areaterreno : null;

            $bedrooms = isset($item->nquartos) ? (int)$item->nquartos : null;
            $bathrooms = isset($item->wcs) ? (int)$item->wcs : null;
            $builtYear = isset($item->anoconstrucao) ? (int)$item->anoconstrucao : null;
            $energyRating = isset($item->energiaclasse) ? (string)$item->energiaclasse : null;

            $coverImage = null;
            if (isset($item->multimedia->imagem) && count($item->multimedia->imagem) > 0) {
                $coverImage = $this->downloadImage((string)$item->multimedia->imagem[0]->url, $reference);
            }

            // Update or Create
            $property = Property::updateOrCreate(
                ['reference_code' => $reference],
                [
                    'user_id' => $userId,
                    'title' => $title,
                    'slug' => Str::slug($reference . '-' . $title),
                    'description' => $description,
                    'type' => $type,
                    'status' => $status,
                    'city' => $city,
                    'location' => $location,
                    'address' => $address,
                    'price' => $price,
                    'area_gross' => $areaGross,
                    'area_useful' => $areaUseful,
                    'area_land' => $areaLand,
                    'bedrooms' => $bedrooms,
                    'bathrooms' => $bathrooms,
                    'built_year' => $builtYear,
                    'energy_rating' => $energyRating,
                    'cover_image' => $coverImage,
                    'is_visible' => true,
                ]
            );

            // Sync images
            if (isset($item->multimedia->imagem)) {
                $existingImages = $property->images()->pluck('path')->toArray();
                $xmlImages = [];
                
                $order = 1;
                foreach ($item->multimedia->imagem as $img) {
                    $imgUrl = (string)$img->url;
                    if (!empty($imgUrl)) {
                        $localPath = $this->downloadImage($imgUrl, $reference);
                        if ($localPath) {
                            $xmlImages[] = $localPath;
                            
                            // Create if not exists
                            if (!in_array($localPath, $existingImages)) {
                                PropertyImage::create([
                                    'property_id' => $property->id,
                                    'path' => $localPath,
                                    'order' => $order
                                ]);
                            }
                        }
                    }
                    $order++;
                }

                // Delete images that are no longer in the XML
                PropertyImage::where('property_id', $property->id)
                    ->whereNotIn('path', $xmlImages)
                    ->delete();
            }

            $count++;
            $this->output->write('.');
        }
        
        $this->info("\nImported $count properties temporarily.");

        $this->info("Updating visibility for properties... Deactivating sold/removed properties.");

        // Desativar (is_visible = false) os imóveis deste utilizador que já não vieram no XML
        Property::where('user_id', $userId)
            ->whereNotIn('reference_code', $activeReferences)
            ->update(['is_visible' => false]);
            
        // Garantir que os imóveis que estão no XML ficam visíveis (caso estivessem desativados)
        Property::where('user_id', $userId)
            ->whereIn('reference_code', $activeReferences)
            ->update(['is_visible' => true]);

        $this->info("XML Synchronization completed successfully.");
    }
}
