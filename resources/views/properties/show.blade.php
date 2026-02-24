@extends('layouts.app')

@section('content')

{{-- GALERIA IMERSIVA (ALPINE.JS) --}}
<div x-data="{ 
    activeImage: '{{ $property->cover_image ? asset('storage/' . $property->cover_image) : asset('img/placeholder.jpg') }}',
    images: [
        '{{ $property->cover_image ? asset('storage/' . $property->cover_image) : asset('img/placeholder.jpg') }}',
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
}" class="relative h-[85vh] min-h-[600px] bg-brand-primary group overflow-hidden">
    
    {{-- Imagem Principal --}}
    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out">
        <img :src="activeImage" class="w-full h-full object-cover opacity-90 transition-transform duration-[20s] hover:scale-105" alt="{{ $property->title }}">
        {{-- Gradiente Cinematográfico --}}
        <div class="absolute inset-0 bg-gradient-to-t from-brand-primary via-transparent to-black/20"></div>
    </div>

    {{-- Navegação --}}
    <button @click="prev()" class="absolute left-6 top-1/2 -translate-y-1/2 w-12 h-12 flex items-center justify-center border border-white/20 hover:bg-white hover:text-brand-primary text-white rounded-full transition-all opacity-0 group-hover:opacity-100 z-20 backdrop-blur-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button @click="next()" class="absolute right-6 top-1/2 -translate-y-1/2 w-12 h-12 flex items-center justify-center border border-white/20 hover:bg-white hover:text-brand-primary text-white rounded-full transition-all opacity-0 group-hover:opacity-100 z-20 backdrop-blur-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/></svg>
    </button>

    {{-- Conteúdo Sobreposto (Hero) --}}
    <div class="absolute bottom-0 left-0 w-full z-20 p-8 md:p-16">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
                <div class="max-w-3xl" data-aos="fade-up">
                    <div class="flex flex-wrap items-center gap-3 mb-6">
                        <span class="bg-brand-cta text-white px-4 py-1 text-[10px] uppercase tracking-[0.2em] font-bold shadow-lg">
                            {{ $property->type }} • {{ $property->status === 'available' ? 'Disponível' : 'Reservado' }}
                        </span>
                        
                        @if($property->reference_code)
                            <span class="bg-white/10 backdrop-blur-md text-white px-4 py-1 text-[10px] uppercase tracking-widest font-bold border-l-2 border-brand-premium">
                                Ref. {{ $property->reference_code }}
                            </span>
                        @endif
                    </div>

                    <h1 class="text-4xl md:text-6xl font-didot text-white mb-4 leading-none tracking-tight">{{ $property->title }}</h1>
                    
                    <p class="text-gray-300 text-lg flex items-center gap-2 font-light tracking-wide">
                        <svg class="w-5 h-5 text-brand-premium" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $property->location }} {{ $property->city ? '— ' . $property->city : '' }}
                    </p>
                </div>
                
                {{-- Thumbnails --}}
                <div class="hidden md:flex gap-3 overflow-x-auto max-w-md pb-2 scrollbar-hide">
                    <template x-for="(img, index) in images" :key="index">
                        <button @click="setImage(index)" class="flex-shrink-0 w-24 h-16 border-2 transition-all cursor-pointer relative"
                                :class="currentIndex === index ? 'border-brand-premium scale-105 z-10' : 'border-white/20 opacity-60 hover:opacity-100 hover:border-white'">
                            <img :src="img" class="w-full h-full object-cover">
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- DETALHES DO IMÓVEL --}}
<div class="bg-brand-background py-20 relative">
    {{-- Decoração de Fundo --}}
    <div class="absolute top-0 right-0 w-1/3 h-full bg-white skew-x-12 transform translate-x-1/2 opacity-50 pointer-events-none"></div>

    <div class="container mx-auto px-6 md:px-12 grid grid-cols-1 lg:grid-cols-12 gap-16 relative z-10">
        
        {{-- COLUNA PRINCIPAL (ESQUERDA) --}}
        <div class="lg:col-span-8 space-y-16">
            
            {{-- Quick Stats (Grid Clean) --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center p-6 bg-white shadow-sm border-t-2 border-brand-premium group hover:-translate-y-1 transition-transform duration-300">
                    <span class="block text-4xl font-didot text-brand-primary mb-2 group-hover:text-brand-cta transition-colors">{{ $property->bedrooms ?? '-' }}</span>
                    <span class="text-[10px] uppercase tracking-[0.2em] text-gray-400">Quartos</span>
                </div>
                <div class="text-center p-6 bg-white shadow-sm border-t-2 border-brand-premium group hover:-translate-y-1 transition-transform duration-300">
                    <span class="block text-4xl font-didot text-brand-primary mb-2 group-hover:text-brand-cta transition-colors">{{ $property->bathrooms ?? '-' }}</span>
                    <span class="text-[10px] uppercase tracking-[0.2em] text-gray-400">Casas de Banho</span>
                </div>
                <div class="text-center p-6 bg-white shadow-sm border-t-2 border-brand-premium group hover:-translate-y-1 transition-transform duration-300">
                    <span class="block text-4xl font-didot text-brand-primary mb-2 group-hover:text-brand-cta transition-colors">{{ number_format($property->area_gross ?? 0, 0) }}</span>
                    <span class="text-[10px] uppercase tracking-[0.2em] text-gray-400">m² Área Útil</span>
                </div>
                <div class="text-center p-6 bg-white shadow-sm border-t-2 border-brand-premium group hover:-translate-y-1 transition-transform duration-300">
                    <span class="block text-4xl font-didot text-brand-primary mb-2 group-hover:text-brand-cta transition-colors">{{ $property->garages ?? '-' }}</span>
                    <span class="text-[10px] uppercase tracking-[0.2em] text-gray-400">Lugares</span>
                </div>
            </div>

            {{-- Descrição Editorial --}}
            <div data-aos="fade-up">
                <h3 class="text-sm font-bold uppercase tracking-widest text-brand-cta mb-6 flex items-center gap-4">
                    Sobre o Imóvel
                    <span class="h-[1px] flex-grow bg-gray-200"></span>
                </h3>
                <div class="prose prose-lg max-w-none text-gray-600 font-light leading-relaxed text-justify first-letter:text-5xl first-letter:font-didot first-letter:text-brand-primary first-letter:float-left first-letter:mr-3 first-letter:mt-[-10px]">
                    {!! nl2br(e($property->description)) !!}
                </div>
            </div>

            {{-- Características --}}
            <div data-aos="fade-up">
                <h3 class="text-sm font-bold uppercase tracking-widest text-brand-cta mb-8 flex items-center gap-4">
                    Especificações & Comodidades
                    <span class="h-[1px] flex-grow bg-gray-200"></span>
                </h3>
                
                <div class="grid grid-cols-2 md:grid-cols-3 gap-y-4 gap-x-8">
                    @php
                        $features = [
                            ['label' => 'Piscina Privada', 'active' => $property->has_pool],
                            ['label' => 'Jardim Exclusivo', 'active' => $property->has_garden],
                            ['label' => 'Elevador', 'active' => $property->has_lift],
                            ['label' => 'Terraço / Varanda', 'active' => $property->has_terrace],
                            ['label' => 'Ar Condicionado', 'active' => $property->has_air_conditioning],
                            ['label' => 'Mobilado', 'active' => $property->is_furnished],
                            ['label' => 'Cozinha Equipada', 'active' => $property->is_kitchen_equipped],
                        ];
                    @endphp

                    @foreach($features as $feature)
                        @if($feature['active'])
                            <div class="flex items-center gap-3 text-gray-700 font-light group">
                                <span class="text-brand-premium group-hover:scale-125 transition-transform duration-300">✦</span> 
                                {{ $feature['label'] }}
                            </div>
                        @endif
                    @endforeach
                    
                    @if($property->floor) <div class="flex items-center gap-3 text-gray-700 font-light"><span class="text-brand-premium">▪</span> Andar: {{ $property->floor }}</div> @endif
                    @if($property->orientation) <div class="flex items-center gap-3 text-gray-700 font-light"><span class="text-brand-premium">▪</span> Orientação: {{ $property->orientation }}</div> @endif
                    @if($property->energy_rating) <div class="flex items-center gap-3 text-gray-700 font-light"><span class="text-brand-premium">▪</span> Cert. Energética: <span class="font-bold border px-1 border-gray-300">{{ $property->energy_rating }}</span></div> @endif
                </div>
            </div>

            {{-- Vídeo --}}
            @if($property->video_url)
                <div class="pt-8" data-aos="fade-up">
                    <h3 class="text-sm font-bold uppercase tracking-widest text-brand-cta mb-8 flex items-center gap-4">
                        Experiência Virtual
                        <span class="h-[1px] flex-grow bg-gray-200"></span>
                    </h3>
                    
                    @php
                        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $property->video_url, $match);
                        $youtube_id = $match[1] ?? null;
                    @endphp

                    @if($youtube_id)
                        <div class="relative w-full aspect-video shadow-2xl overflow-hidden group">
                            <iframe 
                                src="https://www.youtube.com/embed/{{ $youtube_id }}" 
                                title="YouTube video player" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen
                                class="absolute inset-0 w-full h-full grayscale group-hover:grayscale-0 transition-all duration-1000">
                            </iframe>
                        </div>
                    @else
                        <a href="{{ $property->video_url }}" target="_blank" class="inline-flex items-center gap-4 bg-brand-primary text-white px-8 py-5 text-xs font-bold uppercase tracking-widest hover:bg-brand-cta transition-colors group">
                            <span>Assistir Vídeo do Imóvel</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    @endif
                </div>
            @endif

        </div>

        {{-- SIDEBAR FLUTUANTE (DIREITA) --}}
        <div class="lg:col-span-4">
            <div class="sticky top-32">
                <div class="bg-white p-10 shadow-2xl border-t-4 border-brand-premium relative overflow-hidden" data-aos="fade-left">
                    {{-- Marca d'água sutil --}}
                    <div class="absolute -top-10 -right-10 text-[150px] text-gray-50 opacity-10 font-didot select-none">€</div>

                    <div class="relative z-10">
                        <div class="flex justify-between items-end mb-4 border-b border-gray-100 pb-4">
                            <p class="text-[10px] text-gray-400 uppercase tracking-[0.2em]">Investimento</p>
                            @if($property->reference_code)
                                <p class="text-[10px] font-bold text-brand-premium uppercase tracking-widest">Ref: {{ $property->reference_code }}</p>
                            @endif
                        </div>
                        
                        <p class="text-5xl font-didot text-brand-primary mb-10">
                            {{ $property->price ? '€ ' . number_format($property->price, 0, ',', '.') : 'Sob Consulta' }}
                        </p>

                        <div class="space-y-4">
                            <a href="{{ route('contact') }}" class="block w-full bg-brand-primary text-white text-center py-4 text-xs font-bold uppercase tracking-widest hover:bg-brand-cta transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                Agendar Visita Privada
                            </a>

                            @php
                                $msg = "Olá, tenho interesse no imóvel: " . $property->title;
                                if($property->reference_code) {
                                    $msg .= " (Ref: " . $property->reference_code . ")";
                                }
                                $encodedMsg = urlencode($msg);
                                $whatsapp = $property->whatsapp_number ?? '351917000301'; // Default se não tiver no imóvel
                            @endphp

                            <a href="https://wa.me/{{ $whatsapp }}?text={{ $encodedMsg }}" target="_blank" class="block w-full border border-[#25D366] text-[#25D366] text-center py-4 text-xs font-bold uppercase tracking-widest hover:bg-[#25D366] hover:text-white transition duration-300 flex items-center justify-center gap-2 group">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                WhatsApp Direto
                            </a>
                        </div>

                        <div class="mt-8 pt-8 border-t border-gray-100 text-center">
                            <p class="text-[10px] text-gray-400 uppercase tracking-widest mb-4">Partilhar Oportunidade</p>
                            <div class="flex justify-center gap-6">
                                <a href="#" class="text-gray-300 hover:text-brand-primary transition transform hover:scale-110"><i class="fab fa-facebook text-xl"></i></a>
                                <a href="#" class="text-gray-300 hover:text-brand-primary transition transform hover:scale-110"><i class="fab fa-linkedin text-xl"></i></a>
                                <a href="#" class="text-gray-300 hover:text-brand-primary transition transform hover:scale-110"><i class="fab fa-whatsapp text-xl"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Consultor Info (Mini Profile) --}}
                <div class="mt-8 flex items-center gap-4 p-4 border border-gray-100 bg-white/50" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 bg-brand-primary rounded-full flex items-center justify-center text-white font-serif">JC</div>
                    <div>
                        <p class="text-xs font-bold text-brand-primary uppercase">José Carvalho</p>
                        <p class="text-[10px] text-gray-500">Consultor Premium</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection