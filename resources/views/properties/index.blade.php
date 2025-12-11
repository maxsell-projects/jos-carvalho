@extends('layouts.app')

@section('content')

<section class="bg-brand-black text-white py-32 text-center relative overflow-hidden">
    <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    <div class="container mx-auto px-6 relative z-10">
        <p class="text-brand-gold text-xs uppercase tracking-[0.4em] mb-4">Portfólio Exclusivo</p>
        <h1 class="text-4xl md:text-6xl font-serif">Encontre o Seu Legado</h1>
    </div>
</section>

<section class="py-20 bg-neutral-50">
    <div class="container mx-auto px-6 md:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
            
            <aside class="lg:col-span-1">
                <div class="bg-white p-8 shadow-sm border border-gray-100 sticky top-32">
                    <h3 class="font-serif text-xl mb-6 pb-4 border-b border-gray-100 flex justify-between items-center">
                        Filtros
                        <a href="{{ route('portfolio') }}" class="text-[10px] text-gray-400 uppercase hover:text-brand-gold tracking-widest">Limpar</a>
                    </h3>
                    
                    <form action="{{ route('portfolio') }}" method="GET" class="space-y-6">
                        <div>
                            <label class="text-xs uppercase tracking-widest text-gray-500 mb-2 block">Localização / Palavra-chave</label>
                            <input type="text" name="location" value="{{ request('location') }}" placeholder="Ex: Cascais, Piscina..." 
                                   class="w-full bg-gray-50 border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:border-brand-gold transition-colors">
                        </div>

                        <div>
                            <label class="text-xs uppercase tracking-widest text-gray-500 mb-2 block">Tipo de Imóvel</label>
                            <select name="type" class="w-full bg-gray-50 border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:border-brand-gold">
                                <option value="">Todos</option>
                                <option value="Apartamento" {{ request('type') == 'Apartamento' ? 'selected' : '' }}>Apartamento</option>
                                <option value="Moradia" {{ request('type') == 'Moradia' ? 'selected' : '' }}>Moradia / Villa</option>
                                <option value="Terreno" {{ request('type') == 'Terreno' ? 'selected' : '' }}>Terreno</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-xs uppercase tracking-widest text-gray-500 mb-2 block">Finalidade</label>
                            <div class="flex gap-4">
                                <label class="flex items-center text-sm text-gray-600 gap-2 cursor-pointer">
                                    <input type="radio" name="status" value="Venda" {{ request('status') == 'Venda' ? 'checked' : '' }} class="accent-brand-gold"> Venda
                                </label>
                                <label class="flex items-center text-sm text-gray-600 gap-2 cursor-pointer">
                                    <input type="radio" name="status" value="Arrendamento" {{ request('status') == 'Arrendamento' ? 'checked' : '' }} class="accent-brand-gold"> Alugar
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="text-xs uppercase tracking-widest text-gray-500 mb-2 block">Preço (€)</label>
                            <div class="flex gap-2">
                                <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Min" class="w-full bg-gray-50 border border-gray-200 px-3 py-3 text-sm">
                                <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Max" class="w-full bg-gray-50 border border-gray-200 px-3 py-3 text-sm">
                            </div>
                        </div>

                        <div>
                            <label class="text-xs uppercase tracking-widest text-gray-500 mb-2 block">Quartos</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach(['1', '2', '3', '4+'] as $bed)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="bedrooms" value="{{ $bed }}" {{ request('bedrooms') == $bed ? 'checked' : '' }} class="peer sr-only">
                                        <span class="block w-10 h-10 leading-10 text-center border border-gray-200 text-sm peer-checked:bg-brand-black peer-checked:text-white peer-checked:border-brand-black hover:border-brand-gold transition-colors">
                                            {{ $bed }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-brand-gold text-white font-bold uppercase tracking-widest text-xs py-4 hover:bg-[#b08d4b] transition-colors mt-4">
                            Filtrar Resultados
                        </button>
                    </form>
                </div>
            </aside>

            <div class="lg:col-span-3">
                <div class="flex justify-between items-center mb-8">
                    <p class="text-gray-500 text-sm">{{ $properties->total() }} imóveis encontrados</p>
                    <div class="hidden md:block text-xs uppercase tracking-widest text-gray-400">
                        Ordenação: Mais Recentes
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($properties as $property)
                        <a href="{{ route('properties.show', $property) }}" class="group bg-white border border-gray-100 hover:shadow-lg transition-all duration-300 block">
                            <div class="relative h-64 overflow-hidden bg-gray-200">
                                <img src="{{ $property->cover_image ? asset('storage/' . $property->cover_image) : asset('img/porto.jpg') }}" 
                                     alt="{{ $property->title }}" 
                                     class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                                <div class="absolute top-4 left-4 bg-brand-black text-white text-[10px] uppercase tracking-widest px-3 py-1">
                                    {{ $property->type }}
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-[10px] uppercase tracking-widest text-gray-500">{{ $property->location ?? 'Portugal' }}</span>
                                    <span class="text-brand-gold font-serif italic">{{ $property->status }}</span>
                                </div>
                                <h4 class="text-lg font-serif text-brand-black mb-4 leading-tight group-hover:text-brand-gold transition-colors">
                                    {{ $property->title }}
                                </h4>
                                <div class="flex items-center gap-4 text-xs text-gray-400 border-t border-gray-100 pt-4 mt-auto">
                                    @if($property->bedrooms)
                                        <span class="flex items-center gap-1"><i class="text-brand-gold">🛏</i> {{ $property->bedrooms }}</span>
                                    @endif
                                    @if($property->area_gross)
                                        <span class="flex items-center gap-1"><i class="text-brand-gold">📐</i> {{ number_format($property->area_gross, 0) }} m²</span>
                                    @endif
                                </div>
                                <div class="mt-4 pt-2">
                                    <p class="text-xl font-light text-brand-black">
                                        {{ $property->price ? '€ ' . number_format($property->price, 0, ',', '.') : 'Sob Consulta' }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-3 text-center py-20 bg-white border border-gray-100">
                            <p class="text-gray-400 text-lg font-serif italic mb-4">Nenhum imóvel encontrado com estes critérios.</p>
                            <a href="{{ route('portfolio') }}" class="text-xs uppercase tracking-widest font-bold text-brand-gold border-b border-brand-gold pb-1">Limpar Filtros</a>
                        </div>
                    @endforelse
                </div>

                <div class="mt-12">
                    {{ $properties->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection