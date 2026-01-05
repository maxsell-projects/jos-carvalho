<?php

namespace App\Console\Commands;

use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImportPropertiesFromCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'properties:import-csv {file=Main.csv : O nome do arquivo CSV na pasta storage/app}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa imóveis de um arquivo CSV e baixa as imagens em alta qualidade.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fileName = $this->argument('file');
        $path = storage_path('app/' . $fileName);

        if (!file_exists($path)) {
            $this->error("Arquivo não encontrado em: {$path}");
            return 1;
        }

        $user = User::first();
        if (!$user) {
            $this->error('Nenhum usuário encontrado. Crie um usuário antes de importar.');
            return 1;
        }

        $this->info("Iniciando importação de: {$fileName}...");

        $file = fopen($path, 'r');
        $headers = fgetcsv($file); 
        $headerMap = array_flip($headers);

        $count = 0;

        while (($row = fgetcsv($file)) !== false) {
            $getVal = fn($key) => $row[$headerMap[$key] ?? -1] ?? null;

            $reference = str_replace('id. ', '', $getVal('ID'));
            $title = $getVal('Title');

            // Pula se já existe
            if (Property::where('reference_code', $reference)->exists()) {
                $this->warn("Imóvel {$reference} já existe. Pulando...");
                continue;
            }

            $this->info("Processando: {$title} ({$reference})");

            // --- TRATAMENTO DE DADOS ---
            $price = (float) preg_replace('/[^0-9]/', '', $getVal('Price'));
            $area = (float) preg_replace('/[^0-9]/', '', $getVal('Area'));
            $bedrooms = (int) preg_replace('/[^0-9]/', '', $getVal('Bedrooms'));
            $bathrooms = (int) preg_replace('/[^0-9]/', '', $getVal('Bathrooms'));
            
            $type = 'apartment';
            if (Str::contains(Str::lower($title), ['moradia', 'casa', 'vivenda'])) $type = 'house';
            if (Str::contains(Str::lower($title), ['terreno', 'lote'])) $type = 'land';
            if (Str::contains(Str::lower($title), ['loja', 'comercial'])) $type = 'store';

            // --- DOWNLOAD CAPA (HD) ---
            $rawCoverUrl = $getVal('Main Image');
            $coverPath = null;
            
            if ($rawCoverUrl) {
                // O PULO DO GATO: Troca 'ds-l' por 'l-feat' para pegar a imagem HD
                $hdCoverUrl = str_replace('/ds-l/', '/l-feat/', $rawCoverUrl);
                $coverPath = $this->downloadImage($hdCoverUrl, $reference, 'cover');
            }

            // --- CRIAR PROPERTY ---
            $property = Property::create([
                'user_id' => $user->id,
                'title' => $title,
                'slug' => Str::slug($title . '-' . $reference),
                'description' => $getVal('Description'),
                'price' => $price,
                'location' => $getVal('Location'),
                'type' => $type,
                'status' => 'available',
                'bedrooms' => $bedrooms,
                'bathrooms' => $bathrooms,
                'area_gross' => $area,
                'energy_rating' => $getVal('Energy Class'),
                'reference_code' => $reference,
                'cover_image' => $coverPath,
                'features' => [],
            ]);

            // --- DOWNLOAD GALERIA (HD) ---
            for ($i = 1; $i <= 24; $i++) {
                $rawImgUrl = $getVal("Image{$i}");
                if ($rawImgUrl) {
                    // O PULO DO GATO: Troca 'ds-l' por 'l-feat' aqui também
                    $hdImgUrl = str_replace('/ds-l/', '/l-feat/', $rawImgUrl);
                    
                    $imgPath = $this->downloadImage($hdImgUrl, $reference, "gallery_{$i}");
                    
                    if ($imgPath) {
                        PropertyImage::create([
                            'property_id' => $property->id,
                            'path' => $imgPath, // Campo correto 'path'
                            'order' => $i
                        ]);
                    }
                }
            }

            $count++;
        }

        fclose($file);
        $this->info("Sucesso! {$count} imóveis importados em alta qualidade.");
        return 0;
    }

    private function downloadImage($url, $reference, $suffix)
    {
        try {
            // Timeout maior (15s) pois imagens HD demoram mais
            $response = Http::timeout(15)->get($url);
            
            if ($response->failed()) {
                // Fallback: Se falhar a HD (l-feat), tenta a original (ds-l)
                // Isso evita erro se alguma imagem antiga não tiver versão HD
                $fallbackUrl = str_replace('/l-feat/', '/ds-l/', $url);
                $response = Http::timeout(15)->get($fallbackUrl);
            }

            if ($response->failed() || !$response->body()) return null;

            $extension = 'jpg'; // Forçamos JPG pois a maioria vem assim
            $filename = "properties/{$reference}/{$reference}_{$suffix}.{$extension}";

            Storage::disk('public')->put($filename, $response->body());

            return $filename; 
        } catch (\Exception $e) {
            $this->error("Erro na imagem {$url}: " . $e->getMessage());
            return null;
        }
    }
}