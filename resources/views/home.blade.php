@extends('layouts.app')

@section('content')

<div class="bg-brand-primary text-white overflow-hidden">
    
    {{-- HERO: ASSIMÉTRICO & EDITORIAL --}}
    <section class="relative min-h-screen flex flex-col justify-center pt-32 pb-24 md:pt-0 md:pb-0">
        
        <div class="absolute top-0 right-0 w-full md:w-[45%] h-full bg-cover bg-center opacity-40 md:opacity-100 transition-all duration-1000 ease-out transform scale-105"
             style="background-image: url('{{ asset('img/porto_dark.jpeg') }}'); clip-path: polygon(15% 0, 100% 0, 100% 100%, 0% 100%);">
            <div class="absolute inset-0 bg-brand-primary/30 md:bg-transparent"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-4xl">
                <p class="text-brand-premium font-mono text-xs uppercase tracking-[0.3em] mb-6 animate-pulse" data-aos="fade-right">
                    Real Estate & Investment Strategy
                </p>
                
                <h1 class="font-didot text-5xl md:text-9xl leading-[0.85] tracking-tight mb-8" data-aos="fade-up" data-aos-duration="1200">
                    PARA ALÉM <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-premium to-white italic pr-4">DO ÓBVIO.</span>
                </h1>
                
                <div class="flex flex-col md:flex-row gap-8 items-start md:items-center max-w-2xl" data-aos="fade-up" data-aos-delay="300">
                    <p class="text-gray-300 font-light text-base md:text-xl leading-relaxed border-l border-brand-premium/50 pl-6">
                        Não vendemos apenas metros quadrados. Criamos património, desenhamos futuros e asseguramos o seu legado em Portugal.
                    </p>
                </div>

                <div class="mt-12 flex flex-col sm:flex-row gap-4 md:gap-6" data-aos="fade-up" data-aos-delay="500">
                    <a href="#portfolio-start" class="group relative px-8 py-4 bg-white text-brand-primary font-bold uppercase tracking-widest text-center overflow-hidden">
                        <span class="relative z-10 group-hover:text-white transition-colors duration-300">Explorar Portfólio</span>
                        <div class="absolute inset-0 bg-brand-cta transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300 ease-in-out"></div>
                    </a>
                    <a href="#contact-form" class="px-8 py-4 border border-white/20 hover:border-brand-premium text-white font-bold uppercase tracking-widest text-center transition-all">
                        Consultoria Privada
                    </a>
                </div>
            </div>
        </div>

        {{-- SCROLL INDICATOR: Corrigido para esconder no mobile --}}
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 hidden md:flex flex-col items-center gap-2 opacity-50 animate-bounce">
            <span class="text-[10px] uppercase tracking-widest">Descobrir</span>
            <div class="w-[1px] h-12 bg-white"></div>
        </div>
    </section>

    {{-- MARQUEE INFINITO --}}
    <div class="border-y border-white/10 bg-brand-primary py-6 overflow-hidden relative z-20">
        <div class="whitespace-nowrap flex animate-marquee">
            @for($i = 0; $i < 10; $i++)
                <span class="text-4xl md:text-6xl font-didot text-white/5 mx-8 uppercase">Investimento • Exclusividade • Legado •</span>
            @endfor
        </div>
    </div>

    {{-- A AUTORIDADE --}}
    <section class="py-32 relative">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 items-center">
                <div class="md:col-span-5 relative" data-aos="fade-right">
                    <div class="relative z-10 aspect-[3/4] overflow-hidden grayscale hover:grayscale-0 transition-all duration-700">
                        <div class="w-full h-full bg-gray-800 flex items-center justify-center border border-white/10">
                            <span class="text-brand-premium font-mono text-xs uppercase text-center">
                                [FOTO JOSÉ CARVALHO]<br>PB / Alto Contraste
                            </span>
                        </div>
                    </div>
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 border border-brand-premium rounded-full animate-spin-slow opacity-30"></div>
                </div>

                <div class="md:col-span-7 md:pl-12">
                    <h2 class="text-xs font-bold text-brand-cta uppercase tracking-[0.3em] mb-6">O Consultor</h2>
                    <h3 class="font-didot text-5xl md:text-7xl mb-8 leading-none">
                        A Estratégia <br>
                        <span class="text-brand-gray-500 opacity-50">Por Detrás do Negócio.</span>
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-gray-400 font-light leading-relaxed mb-12">
                        <p>Num mercado saturado de intermediários, destaco-me como o seu parceiro estratégico. A minha abordagem combina análise de dados rigorosa e inteligência de mercado.</p>
                        <p>O meu foco não reside na transação isolada, mas sim na valorização do seu portfólio a longo prazo. Especialista em vistos Gold e propriedades de alto rendimento.</p>
                    </div>
                    <div class="flex gap-12 border-t border-white/10 pt-8">
                        <div>
                            <span class="block text-4xl font-didot text-white">15+</span>
                            <span class="text-[10px] uppercase tracking-widest text-gray-500">Anos de Exp.</span>
                        </div>
                        <div>
                            <span class="block text-4xl font-didot text-white">€35M</span>
                            <span class="text-[10px] uppercase tracking-widest text-gray-500">Transacionados</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- PORTFOLIO --}}
    <section id="portfolio-start" class="py-32 bg-[#F5F4F1] text-brand-primary">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-20">
                <h2 class="font-didot text-5xl md:text-6xl leading-none">Curadoria <br>de Ativos</h2>
                <a href="{{ route('portfolio') }}" class="group flex items-center gap-4 text-xs font-bold uppercase tracking-widest mt-8 md:mt-0">
                    Ver Coleção Completa
                    <span class="w-12 h-[1px] bg-brand-primary group-hover:w-20 transition-all duration-300"></span>
                </a>
            </div>

            <div class="space-y-32">
                @foreach($properties as $index => $property)
                    <div class="group grid grid-cols-1 md:grid-cols-12 gap-8 items-center {{ $index % 2 == 1 ? 'md:flex-row-reverse' : '' }}" data-aos="fade-up">
                        <div class="{{ $index % 2 == 1 ? 'md:col-start-6 md:col-span-7' : 'md:col-span-7' }} relative overflow-hidden">
                            <a href="{{ route('properties.show', $property->slug) }}" class="block overflow-hidden">
                                <img src="{{ $property->cover_image ? asset('storage/' . $property->cover_image) : asset('img/placeholder.jpg') }}" 
                                     class="w-full h-[400px] md:h-[500px] object-cover transition-transform duration-1000 group-hover:scale-110 grayscale group-hover:grayscale-0">
                            </a>
                            <div class="absolute top-6 right-6 bg-white/90 backdrop-blur px-4 py-2">
                                <span class="font-mono text-xs font-bold">{{ number_format($property->price, 0, ',', '.') }} €</span>
                            </div>
                        </div>

                        <div class="{{ $index % 2 == 1 ? 'md:col-start-1 md:col-span-4 md:row-start-1' : 'md:col-start-9 md:col-span-4' }}">
                            <span class="text-brand-cta text-[10px] font-bold uppercase tracking-[0.2em] mb-4 block">{{ $property->location }}</span>
                            <h3 class="text-3xl font-serif mb-6 group-hover:text-brand-cta transition-colors">
                                <a href="{{ route('properties.show', $property->slug) }}">{{ $property->title }}</a>
                            </h3>
                            <p class="text-gray-500 font-light text-sm leading-relaxed mb-8 line-clamp-3">{{ $property->description }}</p>
                            <ul class="flex gap-6 text-xs font-bold text-brand-primary border-t border-brand-primary/10 pt-6">
                                <li>{{ $property->bedrooms }} Quartos</li>
                                <li>{{ $property->area_gross }}m²</li>
                                <li>{{ $property->type }}</li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CONTACT FORM --}}
    <section id="contact-form" class="py-32 bg-brand-primary relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-5xl mx-auto border border-white/10 bg-white/5 backdrop-blur-md p-8 md:p-16">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                    <div>
                        <h2 class="font-didot text-4xl md:text-5xl text-white mb-6">Private <span class="text-brand-premium italic">Office.</span></h2>
                        <p class="text-gray-400 font-light mb-8">Acesso exclusivo e consultoria personalizada.</p>
                        <div class="space-y-4 text-sm text-gray-300">
                            <p class="flex items-center gap-4"><span class="w-2 h-2 bg-brand-cta rounded-full"></span>Análise de Perfil</p>
                            <p class="flex items-center gap-4"><span class="w-2 h-2 bg-brand-cta rounded-full"></span>Ativos Off-Market</p>
                        </div>
                    </div>

                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="group relative">
                            <input type="text" name="name" required placeholder=" " class="peer w-full bg-transparent border-b border-white/20 py-3 text-white focus:outline-none focus:border-brand-premium transition-colors placeholder-transparent">
                            <label class="absolute left-0 -top-3.5 text-xs text-brand-premium transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-placeholder-shown:top-3 peer-focus:-top-3.5 peer-focus:text-xs">Nome Completo</label>
                        </div>
                        <div class="group relative">
                            <input type="email" name="email" required placeholder=" " class="peer w-full bg-transparent border-b border-white/20 py-3 text-white focus:outline-none focus:border-brand-premium transition-colors placeholder-transparent">
                            <label class="absolute left-0 -top-3.5 text-xs text-brand-premium transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-placeholder-shown:top-3 peer-focus:-top-3.5 peer-focus:text-xs">Email</label>
                        </div>
                        <input type="hidden" name="subject" value="Lead via Homepage Bold">
                        <button type="submit" class="w-full bg-brand-premium hover:bg-white text-brand-primary font-bold uppercase tracking-widest py-4 transition-all duration-300">Solicitar Acesso</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
    .animate-marquee { animation: marquee 30s linear infinite; }
    .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
</style>

@endsection