@extends('layouts.app')

@section('content')

{{-- HERO SECTION: EDITORIAL --}}
<section class="bg-brand-primary text-white py-32 text-center relative overflow-hidden">
    {{-- Padrão de Fundo Sutil --}}
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    
    <div class="container mx-auto px-6 relative z-10" data-aos="fade-up">
        <p class="text-brand-premium font-mono text-xs uppercase tracking-[0.4em] mb-6">
            Portfólio Exclusivo
        </p>
        <h1 class="text-5xl md:text-7xl font-didot leading-tight">
            Encontre o Seu <span class="italic text-brand-premium">Imóvel.</span>
        </h1>
    </div>
</section>

<section class="py-20 bg-brand-background text-brand-text">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
            
            {{-- SIDEBAR DE FILTROS (Sticky) --}}
            <aside class="lg:col-span-1">
                <div class="bg-white p-8 shadow-sm border-t-4 border-brand-premium sticky top-32" data-aos="fade-right">
                    <div class="flex justify-between items-center mb-8 border-b border-gray-100 pb-4">
                        <h3 class="font-serif text-xl text-brand-primary">Refinar Busca</h3>
                        <a href="{{ route('portfolio') }}" class="text-[10px] text-gray-400 uppercase hover:text-brand-cta tracking-widest transition-colors">
                            Limpar
                        </a>
                    </div>
                    
                    <form action="{{ route('portfolio') }}" method="GET" class="space-y-6">
                        
                        {{-- Busca Livre --}}
                        <div class="group">
                            <label class="text-xs font-bold uppercase tracking-widest text-brand-primary mb-2 block">Localização</label>
                            <div class="relative">
                                <input type="text" name="location" value="{{ request('location') }}" placeholder="Ex: Estoril, Vista Mar..." 
                                       class="w-full bg-gray-50 border-b border-gray-200 px-0 py-3 text-sm focus:outline-none focus:border-brand-cta transition-colors placeholder-gray-400">
                                <svg class="w-4 h-4 text-gray-400 absolute right-0 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                        </div>

                        {{-- Tipo --}}
                        <div>
                            <label class="text-xs font-bold uppercase tracking-widest text-brand-primary mb-2 block">Tipo de Imóvel</label>
                            <select name="type" class="w-full bg-gray-50 border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:border-brand-cta text-gray-600">
                                <option value="">Todos os Tipos</option>
                                <option value="Apartamento" {{ request('type') == 'Apartamento' ? 'selected' : '' }}>Apartamento</option>
                                <option value="Moradia" {{ request('type') == 'Moradia' ? 'selected' : '' }}>Moradia / Villa</option>
                                <option value="Terreno" {{ request('type') == 'Terreno' ? 'selected' : '' }}>Terreno</option>
                                <option value="Comercial" {{ request('type') == 'Comercial' ? 'selected' : '' }}>Comercial</option>
                            </select>
                        </div>

                        {{-- Finalidade --}}
                        <div>
                            <label class="text-xs font-bold uppercase tracking-widest text-brand-primary mb-3 block">Finalidade</label>
                            <div class="flex gap-6">
                                <label class="flex items-center text-sm text-gray-600 gap-2 cursor-pointer group">
                                    <div class="relative flex items-center">
                                        <input type="radio" name="status" value="Venda" {{ request('status') == 'Venda' ? 'checked' : '' }} class="peer sr-only">
                                        <div class="w-4 h-4 border border-gray-300 rounded-full peer-checked:border-brand-cta peer-checked:bg-brand-cta transition-all"></div>
                                    </div>
                                    <span class="group-hover:text-brand-primary transition-colors">Comprar</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-600 gap-2 cursor-pointer group">
                                    <div class="relative flex items-center">
                                        <input type="radio" name="status" value="Arrendamento" {{ request('status') == 'Arrendamento' ? 'checked' : '' }} class="peer sr-only">
                                        <div class="w-4 h-4 border border-gray-300 rounded-full peer-checked:border-brand-cta peer-checked:bg-brand-cta transition-all"></div>
                                    </div>
                                    <span class="group-hover:text-brand-primary transition-colors">Arrendar</span>
                                </label>
                            </div>
                        </div>

                        {{-- Preço --}}
                        <div>
                            <label class="text-xs font-bold uppercase tracking-widest text-brand-primary mb-2 block">Investimento (€)</label>
                            <div class="grid grid-cols-2 gap-4">
                                <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Min" 
                                       class="w-full bg-gray-50 border border-gray-200 px-3 py-3 text-sm focus:border-brand-cta outline-none transition-colors">
                                <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Max" 
                                       class="w-full bg-gray-50 border border-gray-200 px-3 py-3 text-sm focus:border-brand-cta outline-none transition-colors">
                            </div>
                        </div>

                        {{-- Quartos --}}
                        <div>
                            <label class="text-xs font-bold uppercase tracking-widest text-brand-primary mb-2 block">Tipologia (Quartos)</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach(['1', '2', '3', '4+'] as $bed)
                                    <label class="cursor-pointer flex-1">
                                        <input type="radio" name="bedrooms" value="{{ $bed }}" {{ request('bedrooms') == $bed ? 'checked' : '' }} class="peer sr-only">
                                        <span class="block w-full py-2 text-center border border-gray-200 text-sm peer-checked:bg-brand-primary peer-checked:text-white peer-checked:border-brand-primary hover:border-brand-premium transition-all">
                                            {{ $bed }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-brand-cta text-white font-bold uppercase tracking-widest text-xs py-4 hover:bg-brand-primary transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                            Filtrar Resultados
                        </button>
                    </form>
                </div>
            </aside>

            {{-- GRID DE IMÓVEIS --}}
            <div class="lg:col-span-3">
                <div class="flex justify-between items-end mb-8 border-b border-gray-200 pb-4">
                    <div>
                        <h2 class="font-didot text-3xl text-brand-primary">Resultados</h2>
                        <p class="text-gray-500 text-xs mt-1">{{ $properties->total() }} imóveis premium encontrados</p>
                    </div>
                    
                    {{-- Ordenação (Visual Only por enquanto) --}}
                    <div class="hidden md:flex items-center gap-2 text-xs uppercase tracking-widest text-gray-400">
                        <span>Ordenar por:</span>
                        <select class="bg-transparent border-none text-brand-primary font-bold focus:ring-0 cursor-pointer">
                            <option>Mais Recentes</option>
                            <option>Preço (Maior)</option>
                            <option>Preço (Menor)</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($properties as $property)
                        <div class="group bg-white hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 flex flex-col h-full" data-aos="fade-up">
                            
                            {{-- Capa --}}
                            <div class="relative h-64 overflow-hidden">
                                <a href="{{ route('properties.show', $property->slug) }}" class="block h-full w-full">
                                    <img src="{{ $property->cover_image ? asset('storage/' . $property->cover_image) : asset('img/placeholder.jpg') }}" 
                                         alt="{{ $property->title }}" 
                                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-1000">
                                </a>
                                
                                {{-- Badges --}}
                                <div class="absolute top-4 left-4 flex flex-col gap-2">
                                    <span class="bg-brand-primary text-white text-[10px] uppercase tracking-widest px-3 py-1 shadow-md">
                                        {{ $property->type }}
                                    </span>
                                    @if($property->is_featured)
                                        <span class="bg-brand-premium text-white text-[10px] uppercase tracking-widest px-3 py-1 shadow-md">
                                            Destaque
                                        </span>
                                    @endif
                                </div>

                                <div class="absolute bottom-0 right-0 bg-brand-cta text-white px-4 py-2 font-serif text-lg">
                                    {{ $property->price ? '€ ' . number_format($property->price, 0, ',', '.') : 'Sob Consulta' }}
                                </div>
                            </div>

                            {{-- Info --}}
                            <div class="p-6 flex flex-col flex-grow border border-gray-100 border-t-0">
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-brand-secondary">
                                        {{ $property->location ?? 'Portugal' }}
                                    </span>
                                    <span class="text-[10px] text-gray-400 uppercase tracking-widest">
                                        {{ $property->status === 'available' ? 'Disponível' : 'Reservado' }}
                                    </span>
                                </div>

                                <h3 class="text-lg font-serif text-brand-primary mb-4 leading-tight group-hover:text-brand-cta transition-colors">
                                    <a href="{{ route('properties.show', $property->slug) }}">
                                        {{ $property->title }}
                                    </a>
                                </h3>

                                <div class="mt-auto pt-6 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500 font-medium">
                                    @if($property->bedrooms)
                                        <span class="flex items-center gap-2" title="Quartos">
                                            <svg class="w-4 h-4 text-brand-premium" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                            {{ $property->bedrooms }}
                                        </span>
                                    @endif
                                    
                                    @if($property->bathrooms)
                                        <span class="flex items-center gap-2" title="Casas de Banho">
                                            <svg class="w-4 h-4 text-brand-premium" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            {{ $property->bathrooms }}
                                        </span>
                                    @endif

                                    @if($property->area_gross)
                                        <span class="flex items-center gap-2" title="Área Bruta">
                                            <svg class="w-4 h-4 text-brand-premium" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                                            {{ number_format($property->area_gross, 0) }} m²
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-20 bg-white border border-dashed border-gray-300 rounded-lg">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                            <h3 class="font-serif text-xl text-gray-900 mb-2">Sem Resultados</h3>
                            <p class="text-gray-500 mb-6 text-sm">Não encontramos imóveis com os filtros selecionados.</p>
                            <a href="{{ route('portfolio') }}" class="inline-block px-6 py-3 bg-brand-primary text-white text-xs font-bold uppercase tracking-widest hover:bg-brand-cta transition-colors">
                                Ver Todo o Portfólio
                            </a>
                        </div>
                    @endforelse
                </div>

                <div class="mt-16">
                    {{ $properties->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection