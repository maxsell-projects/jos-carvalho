<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PropertyController extends Controller
{
    /**
     * Listagem Administrativa (Admin)
     */
    public function index()
    {
        $properties = Property::latest()->paginate(10);
        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        return view('admin.properties.create');
    }

    /**
     * Cadastro de novo imóvel (Admin)
     */
    public function store(Request $request)
    {
        $data = $this->validateProperty($request);

        // SEO: Slug único com timestamp
        $data['slug'] = Str::slug($data['title']) . '-' . time();
        
        // Mapeamento automático de checkboxes (booleans)
        $data = $this->mapCheckboxes($request, $data);

        // Upload da Imagem de Capa
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('properties', 'public');
        }

        // Define usuário logado como dono (se não vier da request)
        if (!isset($data['user_id'])) {
            $data['user_id'] = auth()->id(); 
        }

        $property = Property::create($data);

        // Processamento da Galeria
        $this->handleGalleryUpload($request, $property);

        return redirect()->route('admin.properties.index')->with('success', 'Imóvel cadastrado com sucesso!');
    }

    public function edit(Property $property)
    {
        return view('admin.properties.edit', compact('property'));
    }

    /**
     * Atualização de imóvel (Admin)
     */
    public function update(Request $request, Property $property)
    {
        $data = $this->validateProperty($request, $property);

        // Atualiza slug apenas se o título mudar
        if ($property->title !== $data['title']) {
            $data['slug'] = Str::slug($data['title']) . '-' . time();
        }

        $data = $this->mapCheckboxes($request, $data);

        if ($request->hasFile('cover_image')) {
            if ($property->cover_image) {
                Storage::disk('public')->delete($property->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('properties', 'public');
        }

        $property->update($data);

        $this->handleGalleryUpload($request, $property);

        return redirect()->route('admin.properties.index')->with('success', 'Imóvel atualizado com sucesso!');
    }

    /**
     * Remoção de imóvel (Admin)
     */
    public function destroy(Property $property)
    {
        if ($property->cover_image) {
            Storage::disk('public')->delete($property->cover_image);
        }
        
        foreach ($property->images as $image) {
            Storage::disk('public')->delete($image->path);
        }
        
        $property->delete();
        return back()->with('success', 'Imóvel removido.');
    }

    /**
     * -------------------------------------------------------
     * ÁREA PÚBLICA (Onde a mágica dos filtros acontece)
     * -------------------------------------------------------
     */
    public function publicIndex(Request $request)
    {
        // Inicia a query carregando imagens (Eager Loading para performance)
        $query = Property::with('images')->where('is_visible', true);

        // --- FILTROS VIA SCOPES DO MODEL ---
        // Agora o Controller apenas orquestra, quem filtra é o Model.
        
        $properties = $query
            ->search($request->input('location'))     // Busca por Texto (Cidade, Título, etc)
            ->ofType($request->input('type'))         // Filtro de Tipo (Apartamento, etc)
            ->ofCondition($request->input('condition')) // Filtro de Condição (Novo, Usado)
            ->maxPrice($request->input('price_max'))  // Preço Máximo
            
            // Filtros simples que não precisaram de Scopes complexos
            ->when($request->filled('status'), function($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->when($request->filled('bedrooms'), function($q) use ($request) {
                if ($request->bedrooms === '4+') {
                    $q->where('bedrooms', '>=', 4);
                } else {
                    $q->where('bedrooms', (int)$request->bedrooms);
                }
            })
            ->when($request->filled('price_min'), function($q) use ($request) {
                $q->where('price', '>=', $request->price_min);
            })
            
            ->latest() // Mais recentes primeiro
            ->paginate(9) // Paginação de 9 itens (grid 3x3)
            ->withQueryString(); // Mantém os filtros ao mudar de página

        return view('properties.index', compact('properties'));
    }

    public function show(Property $property)
    {
        // Incrementa visualizações se tiver coluna views, senão ignora
        // $property->increment('views'); 
        
        $property->load('images');
        return view('properties.show', compact('property'));
    }

    // --- MÉTODOS PRIVADOS DE SUPORTE ---

    private function validateProperty(Request $request, Property $property = null)
    {
        return $request->validate([
            'reference_code' => [
                'nullable', 'string', 'max:20',
                $property 
                    ? Rule::unique('properties', 'reference_code')->ignore($property->id)
                    : 'unique:properties,reference_code'
            ],
            'title' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'type' => 'required|string',
            'status' => 'required|string',
            'location' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'floor' => 'nullable|string',
            'orientation' => 'nullable|string',
            'area_gross' => 'nullable|numeric',
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'garages' => 'nullable|integer',
            'energy_rating' => 'nullable|string',
            'condition' => 'nullable|string',
            'video_url' => 'nullable|url',
            'whatsapp_number' => 'nullable|string',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:20480', // 20MB
            'gallery.*' => 'image|max:20480',
        ]);
    }

    private function mapCheckboxes(Request $request, array $data)
    {
        $features = [
            'has_pool', 'has_garden', 'has_lift', 'has_terrace', 'has_air_conditioning', 
            'is_furnished', 'is_kitchen_equipped', 'is_visible', 'is_featured'
        ];
        
        foreach ($features as $feature) {
            $data[$feature] = $request->has($feature);
        }
        
        return $data;
    }

    private function handleGalleryUpload(Request $request, Property $property)
    {
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                if ($image->isValid()) {
                    $path = $image->store('properties/gallery', 'public');
                    PropertyImage::create([
                        'property_id' => $property->id,
                        'path' => $path
                    ]);
                }
            }
        }
    }
}