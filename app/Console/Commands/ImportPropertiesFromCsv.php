<?php

namespace App\Console\Commands;

use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImportPropertiesFromCsv extends Command
{
    protected $signature = 'properties:import-csv {file=Main.csv : O nome do arquivo CSV na pasta storage/app} {--force : Força o download das imagens mesmo se o imóvel já existir}';

    protected $description = 'Importa imóveis do arquivo CSV (Main.csv) mapeando colunas e baixando imagens.';

    public function handle()
    {
        $fileName = $this->argument('file');
        $path = storage_path('app/' . $fileName);

        if (!file_exists($path)) {
            $this->error("Arquivo não encontrado: {$path}");
            return 1;
        }

        // Garante um usuário para atrelar os imóveis (Regra de Negócio)
        $user = User::first();
        if (!$user) {
            $this->error('ERRO CRÍTICO: Nenhum usuário encontrado no banco. Rode as seeds primeiro.');
            return 1;
        }

        $this->info("Lendo arquivo: {$fileName}...");

        // Abre o arquivo para leitura
        $file = fopen($path, 'r');
        $headers = fgetcsv($file);
        
        // Remove BOM se existir (comum em arquivos do Excel/Windows)
        $headers[0] = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $headers[0]);
        
        // Cria um mapa de cabeçalhos { 'Title' => 0, 'Price' => 1, ... }
        $headerMap = array_flip($headers);

        // Conta linhas para a barra de progresso (opcional, mas bom para UX)
        $totalLines = count(file($path)) - 1;
        $bar = $this->output->createProgressBar($totalLines);
        $bar->start();

        // Volta o ponteiro para o início e pula o header
        rewind($file);
        fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {
            try {
                // Helper para pegar valor seguro
                $get = fn($key) => $row[$headerMap[$key] ?? -1] ?? null;

                $reference = $get('ID');
                $title = $get('Title');

                if (!$reference || !$title) {
                    $bar->advance();
                    continue;
                }

                DB::transaction(function () use ($get, $reference, $title, $user) {
                    $this->processRow($get, $reference, $title, $user);
                });

            } catch (\Exception $e) {
                Log::error("Erro ao importar linha: " . $e->getMessage());
                // Não para o loop, apenas loga
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("Importação concluída com sucesso!");

        fclose($file);
        return 0;
    }

    /**
     * Processa uma única linha do CSV dentro de uma transação.
     */
    private function processRow($get, $reference, $title, $user)
    {
        // 1. Tratamento de Dados
        $price = $this->cleanCurrency($get('Price'));
        
        // Mapeia Areas
        $areaUseful = $this->cleanArea($get('Area util'));
        $areaGross = $this->cleanArea($get('Area Bruta'));
        $areaLand = $this->cleanArea($get('Area do terreno'));

        // Se area util for 0 e gross tiver valor, usa gross (fallback)
        if ($areaUseful == 0 && $areaGross > 0) $areaUseful = $areaGross;

        // Mapeia Quartos/Banheiros
        $bedrooms = (int) filter_var($get('Bedrooms'), FILTER_SANITIZE_NUMBER_INT);
        $bathrooms = (int) filter_var($get('Bathrooms'), FILTER_SANITIZE_NUMBER_INT);
        $garages = (int) filter_var($get('Garage'), FILTER_SANITIZE_NUMBER_INT);
        
        // Mapeia Localização
        $concelho = $get('concelho');
        $freguesia = $get('freguesia');
        $fullLocation = implode(', ', array_filter([$freguesia, $concelho, $get('distrito')]));
        
        // Mapeia Tipo e Condição
        $type = $this->mapPropertyType($get('Tipo de imovel') ?? $get('Tipologia'), $title);
        $condition = $this->mapCondition($get('Estado'));

        // 2. Criação ou Atualização do Imóvel
        $property = Property::updateOrCreate(
            ['reference_code' => $reference],
            [
                'user_id' => $user->id,
                'title' => $title,
                'slug' => Str::slug($title . '-' . $reference),
                'description' => $get('Description'),
                'price' => $price,
                'type' => $type,
                'status' => 'Venda', // Assumindo Venda, ou mapear coluna 'Tipo de Negocio'
                'location' => $fullLocation,
                'city' => $concelho,
                'address' => $freguesia,
                'area_useful' => $areaUseful,
                'area_gross' => $areaGross,
                'area_land' => $areaLand,
                'bedrooms' => $bedrooms,
                'bathrooms' => $bathrooms,
                'garages' => $garages,
                'energy_rating' => $get('certificado energetico'),
                'built_year' => (int) $get('Ano de construcao'),
                'condition' => $condition,
                'is_visible' => true,
            ]
        );

        // 3. Processamento de Imagens
        // Verifica se precisa baixar imagens (se for update e não tiver flag force, talvez pular)
        // Aqui vamos sempre tentar preencher se estiver vazio ou se for force
        
        $this->processImages($property, $get);
    }

    /**
     * Itera sobre as colunas de imagem e baixa.
     */
    private function processImages(Property $property, $get)
    {
        // Se já tem imagens e não é para forçar, retorna (evita download lento)
        if ($property->images()->exists() && !$this->option('force')) {
            return;
        }

        // Imagem de Capa (Imagem 1)
        $coverUrl = $get('Imagem 1');
        if ($coverUrl) {
            $path = $this->downloadImage($coverUrl, $property->reference_code, 'cover');
            if ($path) {
                $property->update(['cover_image' => $path]);
            }
        }

        // Galeria (Imagem 2 até 15 conforme headers do CSV novo)
        // O código anterior ia até 24, mas o snippet mostra até 15. Ajuste conforme necessidade.
        for ($i = 2; $i <= 15; $i++) {
            $url = $get("Imagem {$i}");
            
            // Verifica se a URL é válida e não está vazia
            if (empty($url) || $url === 'Array') continue;

            // Verifica se essa imagem já existe para não duplicar no banco
            // (Download ainda ocorre para garantir arquivo, mas pode ser otimizado)
            $existing = PropertyImage::where('property_id', $property->id)
                ->where('order', $i)
                ->first();

            if (!$existing || $this->option('force')) {
                $path = $this->downloadImage($url, $property->reference_code, "gallery_{$i}");
                
                if ($path) {
                    PropertyImage::updateOrCreate(
                        [
                            'property_id' => $property->id,
                            'order' => $i
                        ],
                        [
                            'path' => $path
                        ]
                    );
                }
            }
        }
    }

    /**
     * Baixa a imagem e salva no Storage.
     */
    private function downloadImage($url, $reference, $suffix)
    {
        try {
            // Tenta obter o conteúdo da imagem
            // Timeout de 10s para não travar muito
            $response = Http::timeout(10)->get($url);

            if ($response->failed()) return null;

            // Define caminho: properties/REF-123/REF-123_cover.jpg
            // Assume JPG/WEBP. Se o mime type for importante, pode checar $response->header('Content-Type')
            $extension = 'jpg'; 
            $filename = "properties/{$reference}/{$reference}_{$suffix}.{$extension}";

            Storage::disk('public')->put($filename, $response->body());

            return $filename;
        } catch (\Exception $e) {
            // Silencia erro de imagem individual para não parar importação
            // Log::warning("Falha ao baixar imagem {$url}: " . $e->getMessage());
            return null;
        }
    }

    // --- Helpers de Limpeza ---

    private function cleanCurrency($value)
    {
        if (!$value) return 0;
        // Remove '€', espaços, e converte vírgula para ponto
        // Ex: "35 000 €" -> "35000"
        $clean = preg_replace('/[^0-9,]/', '', $value); // mantém numeros e virgula
        $clean = str_replace(',', '.', $clean); // troca virgula por ponto se houver decimal
        // Se o formato for 35.000 (milhar com ponto), a logica muda.
        // O CSV parece usar espaço para milhar "35 000".
        
        return (float) $clean;
    }

    private function cleanArea($value)
    {
        if (!$value) return 0;
        // Ex: "5120 m²" -> 5120
        $clean = preg_replace('/[^0-9,.]/', '', $value);
        return (float) str_replace(',', '.', $clean);
    }

    private function mapPropertyType($typeString, $title)
    {
        $typeString = Str::lower($typeString);
        $title = Str::lower($title);

        if (Str::contains($typeString, 'terreno') || Str::contains($title, 'terreno')) return 'Terreno';
        if (Str::contains($typeString, 'apartamento') || Str::contains($title, 'apartamento')) return 'Apartamento';
        if (Str::contains($typeString, 'moradia') || Str::contains($title, 'casa') || Str::contains($title, 'vivenda')) return 'Moradia';
        if (Str::contains($typeString, 'loja') || Str::contains($typeString, 'comercial')) return 'Comercial';
        if (Str::contains($typeString, 'garagem')) return 'Garagem';

        return 'Outro';
    }

    private function mapCondition($condition)
    {
        $condition = Str::lower($condition);
        
        return match (true) {
            Str::contains($condition, 'usado') => 'used',
            Str::contains($condition, 'novo') => 'new',
            Str::contains($condition, 'renovar') || Str::contains($condition, 'recuperar') => 'to_renovate',
            Str::contains($condition, 'construção') => 'under_construction',
            default => 'used',
        };
    }
}