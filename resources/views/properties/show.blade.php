@extends('layouts.app')

@section('content')

{{-- GALERIA HERO COM CARROSSEL (Alpine.js) --}}
<div x-data="{ 
    activeImage: '{{ $property->cover_image ? asset('storage/' . $property->cover_image) : asset('img/porto.jpg') }}',
    images: [
        '{{ $property->cover_image ? asset('storage/' . $property->cover_image) : asset('img/porto.jpg') }}',
        @foreach($property->images as $img)
            '{{ asset('storage/' . $img->path) }}',
        @endforeach
    ],
    currentIndex: 0,
    next() {
        this.currentIndex = (this.currentIndex + 1) % this.images.length;
        this.activeImage = this.images[this.currentIndex];
    },
    prev() {
        this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
        this.activeImage = this.images[this.currentIndex];
    },
    setImage(index) {
        this.currentIndex = index;
        this.activeImage = this.images[index];
    }
}" class="relative h-[70vh] min-h-[500px] bg-black group">
    
    {{-- Imagem Principal --}}
    <div class="absolute inset-0 transition-opacity duration-500 ease-in-out">
        <img :src="activeImage" class="w-full h-full object-cover opacity-90" alt="{{ $property->title }}">
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-black/30"></div>
    </div>

    {{-- Setas de Navegação --}}
    <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20 backdrop-blur-md text-white p-3 rounded-full transition opacity-0 group-hover:opacity-100">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20 backdrop-blur-md text-white p-3 rounded-full transition opacity-0 group-hover:opacity-100">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>

    {{-- Informações Sobrepostas --}}
    <div class="absolute bottom-0 left-0 w-full z-20 p-8 md:p-12">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <span class="bg-brand-gold text-white px-3 py-1 text-[10px] uppercase tracking-[0.2em] font-bold mb-4 inline-block">
                        {{ $property->type }} • {{ $property->status }}
                    </span>
                    <h1 class="text-3xl md:text-5xl font-serif text-white mb-2 leading-tight">{{ $property->title }}</h1>
                    <p class="text-white/80 text-lg flex items-center gap-2 font-light">
                        <svg class="w-5 h-5 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $property->location }} {{ $property->city ? ', ' . $property->city : '' }}
                    </p>
                </div>
                
                {{-- Miniaturas --}}
                <div class="hidden md:flex gap-2 overflow-x-auto max-w-md pb-2">
                    <template x-for="(img, index) in images" :key="index">
                        <button @click="setImage(index)" class="flex-shrink-0 w-20 h-14 border-2 transition-all rounded overflow-hidden"
                                :class="currentIndex === index ? 'border-brand-gold opacity-100' : 'border-transparent opacity-60 hover:opacity-100'">
                            <img :src="img" class="w-full h-full object-cover">
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white py-16">
    <div class="container mx-auto px-6 md:px-12 grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        {{-- COLUNA PRINCIPAL --}}
        <div class="lg:col-span-2 space-y-12">
            
            {{-- Estatísticas --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 border-b border-gray-100 pb-12">
                <div class="text-center p-6 bg-gray-50 border border-gray-100">
                    <span class="block text-3xl font-serif text-brand-black mb-1">{{ $property->bedrooms ?? '-' }}</span>
                    <span class="text-[10px] uppercase tracking-widest text-gray-400">Quartos</span>
                </div>
                <div class="text-center p-6 bg-gray-50 border border-gray-100">
                    <span class="block text-3xl font-serif text-brand-black mb-1">{{ $property->bathrooms ?? '-' }}</span>
                    <span class="text-[10px] uppercase tracking-widest text-gray-400">Banheiros</span>
                </div>
                <div class="text-center p-6 bg-gray-50 border border-gray-100">
                    <span class="block text-3xl font-serif text-brand-black mb-1">{{ number_format($property->area_gross ?? 0, 0) }}</span>
                    <span class="text-[10px] uppercase tracking-widest text-gray-400">m² Úteis</span>
                </div>
                <div class="text-center p-6 bg-gray-50 border border-gray-100">
                    <span class="block text-3xl font-serif text-brand-black mb-1">{{ $property->garages ?? '-' }}</span>
                    <span class="text-[10px] uppercase tracking-widest text-gray-400">Vagas</span>
                </div>
            </div>

            {{-- Descrição --}}
            <div>
                <h3 class="text-2xl font-serif mb-6 text-brand-black">Sobre o Imóvel</h3>
                <div class="prose prose-lg text-gray-500 font-light leading-relaxed text-justify">
                    {!! nl2br(e($property->description)) !!}
                </div>
            </div>

            {{-- Comodidades --}}
            <div>
                <h3 class="text-2xl font-serif mb-6 text-brand-black">Características & Detalhes</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-y-4 gap-x-8">
                    @if($property->has_pool) <div class="flex items-center gap-3 text-gray-600 font-light"><span class="text-brand-gold">✓</span> Piscina</div> @endif
                    @if($property->has_garden) <div class="flex items-center gap-3 text-gray-600 font-light"><span class="text-brand-gold">✓</span> Jardim</div> @endif
                    @if($property->has_lift) <div class="flex items-center gap-3 text-gray-600 font-light"><span class="text-brand-gold">✓</span> Elevador</div> @endif
                    @if($property->has_terrace) <div class="flex items-center gap-3 text-gray-600 font-light"><span class="text-brand-gold">✓</span> Terraço</div> @endif
                    @if($property->has_air_conditioning) <div class="flex items-center gap-3 text-gray-600 font-light"><span class="text-brand-gold">✓</span> Ar Condicionado</div> @endif
                    @if($property->is_furnished) <div class="flex items-center gap-3 text-gray-600 font-light"><span class="text-brand-gold">✓</span> Mobilado</div> @endif
                    @if($property->is_kitchen_equipped) <div class="flex items-center gap-3 text-gray-600 font-light"><span class="text-brand-gold">✓</span> Cozinha Equipada</div> @endif
                    
                    {{-- Campos Extras Idealista --}}
                    @if($property->floor) <div class="flex items-center gap-3 text-gray-600 font-light"><span class="text-brand-gold">▪</span> Andar: {{ $property->floor }}</div> @endif
                    @if($property->orientation) <div class="flex items-center gap-3 text-gray-600 font-light"><span class="text-brand-gold">▪</span> Orientação: {{ $property->orientation }}</div> @endif
                    @if($property->energy_rating) <div class="flex items-center gap-3 text-gray-600 font-light"><span class="text-brand-gold">▪</span> Cert. Energética: {{ $property->energy_rating }}</div> @endif
                </div>
            </div>

            {{-- Vídeo Tour (Embed Inteligente) --}}
            @if($property->video_url)
                <div class="pt-8 border-t border-gray-100">
                    <h3 class="text-2xl font-serif mb-6 text-brand-black">Tour Virtual</h3>
                    
                    @php
                        // Tenta extrair o ID do YouTube
                        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $property->video_url, $match);
                        $youtube_id = $match[1] ?? null;
                    @endphp

                    @if($youtube_id)
                        <div class="relative w-full aspect-video rounded overflow-hidden shadow-lg">
                            <iframe 
                                src="https://www.youtube.com/embed/{{ $youtube_id }}" 
                                title="YouTube video player" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen
                                class="absolute inset-0 w-full h-full">
                            </iframe>
                        </div>
                    @else
                        {{-- Fallback se não for YouTube --}}
                        <a href="{{ $property->video_url }}" target="_blank" class="inline-flex items-center gap-3 bg-brand-black text-white px-8 py-4 rounded hover:bg-brand-gold transition uppercase tracking-widest text-xs font-bold">
                            Assistir Vídeo do Imóvel
                        </a>
                    @endif
                </div>
            @endif

        </div>

        {{-- SIDEBAR STICKY --}}
        <div class="lg:col-span-1">
            <div class="sticky top-32 bg-white border border-gray-100 p-8 shadow-2xl shadow-gray-200/50">
                <p class="text-[10px] text-gray-400 uppercase tracking-[0.2em] mb-2">Valor de Investimento</p>
                <p class="text-4xl font-serif text-brand-black mb-8">
                    {{ $property->price ? '€ ' . number_format($property->price, 0, ',', '.') : 'Sob Consulta' }}
                </p>

                <div class="space-y-4">
                    <a href="{{ route('contact') }}" class="block w-full bg-brand-black text-white text-center py-4 text-xs font-bold uppercase tracking-widest hover:bg-brand-gold transition duration-300">
                        Agendar Visita
                    </a>

                    @if($property->whatsapp_number)
                        <a href="https://wa.me/{{ $property->whatsapp_number }}?text=Olá, tenho interesse no imóvel: {{ $property->title }}" target="_blank" class="block w-full border border-green-600 text-green-600 text-center py-4 text-xs font-bold uppercase tracking-widest hover:bg-green-600 hover:text-white transition duration-300 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            WhatsApp
                        </a>
                    @endif
                </div>

                <div class="mt-8 pt-8 border-t border-gray-100 text-center">
                    <p class="text-xs text-gray-400 mb-2">Compartilhe este imóvel</p>
                    <div class="flex justify-center gap-4">
                        <a href="#" class="text-gray-300 hover:text-brand-gold transition">FB</a>
                        <a href="#" class="text-gray-300 hover:text-brand-gold transition">LN</a>
                        <a href="#" class="text-gray-300 hover:text-brand-gold transition">WA</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection