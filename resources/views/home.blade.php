@extends('layouts.app')

@section('content')

<div class="bg-white w-full overflow-hidden">
    
    {{-- 1. HERO COM VÍDEO E BUSCADOR --}}
    <section class="relative h-screen w-full overflow-hidden">
        {{-- Vídeo Background --}}
        <video 
            autoplay muted loop playsinline 
            poster="{{ asset('img/porto_dark.jpeg') }}"
            class="absolute top-0 left-0 w-full h-full object-cover"
        >
            <source src="{{ asset('video/hero-luxury.webm') }}" type="video/webm">
            <img src="{{ asset('img/porto_dark.jpeg') }}" alt="Luxury Real Estate Portugal" class="absolute inset-0 w-full h-full object-cover">
        </video>
        
        {{-- Overlay Escuro --}}
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="container mx-auto px-4 md:px-6 relative z-10 h-full flex flex-col justify-center pt-24 md:pt-0">
            <div class="max-w-5xl text-white">
                <p class="text-white/90 font-mono text-[10px] md:text-xs uppercase tracking-[0.2em] md:tracking-[0.3em] mb-4 md:mb-6 animate-pulse">
                    Luxury Real Estate Portugal
                </p>
                
                <h1 class="font-display font-bold text-4xl md:text-5xl lg:text-8xl leading-[0.95] md:leading-[0.9] tracking-tight mb-6 md:mb-8" data-aos="fade-up">
                    PARA ALÉM <br>
                    <span class="text-brand-premium italic">DO ÓBVIO.</span>
                </h1>
                
                <p class="text-gray-100 font-light text-base md:text-lg lg:text-xl max-w-xl leading-relaxed border-l-2 border-brand-premium pl-4 md:pl-6 mb-8 md:mb-12" data-aos="fade-up" data-aos-delay="200">
                    Não vendemos apenas metros quadrados. Criamos património, desenhamos futuros e asseguramos o seu legado.
                </p>

                {{-- BUSCADOR NA HOME --}}
                <div class="bg-white/10 backdrop-blur-md border border-white/20 p-4 md:p-6 rounded-sm max-w-4xl" data-aos="fade-up" data-aos-delay="400">
                    <form action="{{ route('properties.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3 md:gap-4 items-end">
                        
                        {{-- Localização --}}
                        <div class="md:col-span-1">
                            <label class="block text-[10px] md:text-xs font-bold text-white uppercase tracking-wider mb-2">Localização</label>
                            <input type="text" name="location" placeholder="Cidade ou zona..." 
                                   class="w-full bg-white/90 border-0 text-gray-900 placeholder-gray-500 px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base focus:ring-2 focus:ring-brand-premium rounded-sm">
                        </div>

                        {{-- Tipo --}}
                        <div>
                            <label class="block text-[10px] md:text-xs font-bold text-white uppercase tracking-wider mb-2">Tipo</label>
                            <select name="type" class="w-full bg-white/90 border-0 text-gray-900 px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base focus:ring-2 focus:ring-brand-premium rounded-sm">
                                <option value="">Todos</option>
                                <option value="Apartamento">Apartamento</option>
                                <option value="Moradia">Moradia</option>
                                <option value="Terreno">Terreno</option>
                                <option value="Comercial">Comercial</option>
                            </select>
                        </div>

                        {{-- Preço Máximo --}}
                        <div>
                            <label class="block text-[10px] md:text-xs font-bold text-white uppercase tracking-wider mb-2">Orçamento Máx.</label>
                            <input type="number" name="price_max" placeholder="Ex: 500000" 
                                   class="w-full bg-white/90 border-0 text-gray-900 placeholder-gray-500 px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base focus:ring-2 focus:ring-brand-premium rounded-sm">
                        </div>

                        {{-- Botão Buscar --}}
                        <div>
                            <button type="submit" class="w-full bg-brand-premium hover:bg-white text-brand-primary font-bold uppercase tracking-widest text-[10px] md:text-xs py-3 md:py-3 transition-colors duration-300 rounded-sm">
                                Buscar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        {{-- Scroll Indicator --}}
        <div class="hidden md:flex absolute bottom-10 left-1/2 transform -translate-x-1/2 flex-col items-center gap-2 animate-bounce opacity-70">
            <span class="text-[10px] text-white uppercase tracking-widest">Descobrir</span>
            <div class="w-[1px] h-12 bg-white"></div>
        </div>
    </section>

    {{-- 2. FAIXA MARQUEE --}}
    <div class="bg-brand-premium py-3 md:py-4 overflow-hidden relative z-20">
        <div class="whitespace-nowrap flex animate-marquee">
            @for($i = 0; $i < 10; $i++)
                <span class="text-lg md:text-xl lg:text-2xl font-display font-bold text-white mx-6 md:mx-8 uppercase tracking-widest">
                    Investimento • Exclusividade • Legado •
                </span>
            @endfor
        </div>
    </div>

    {{-- 3. METODOLOGIA --}}
    <section class="py-16 md:py-24 bg-white border-b border-gray-100">
        <div class="container mx-auto px-4 md:px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 items-center">
                <div data-aos="fade-right">
                    <h2 class="text-[10px] md:text-xs font-bold text-brand-cta uppercase tracking-[0.25em] md:tracking-[0.3em] mb-3 md:mb-4">A Nossa Abordagem</h2>
                    <h3 class="font-display text-3xl md:text-4xl lg:text-6xl text-brand-primary leading-tight mb-6 md:mb-8">
                        Método <br><span class="text-brand-premium">Exclusivo.</span>
                    </h3>
                    <p class="text-gray-500 font-light text-base md:text-lg mb-6 md:mb-8 leading-relaxed">
                        Acreditamos que cada cliente exige uma estratégia única. O nosso método foi desenhado para eliminar riscos, garantir privacidade e maximizar o retorno do seu capital.
                    </p>
                    <a href="{{ route('about') }}" class="inline-block border-b border-brand-primary pb-1 text-brand-primary font-bold uppercase tracking-widest text-[10px] md:text-xs hover:text-brand-cta hover:border-brand-cta transition-colors">
                        Conhecer o Consultor
                    </a>
                </div>

                <div class="grid grid-cols-1 gap-6 md:gap-8" data-aos="fade-left">
                    {{-- Passos --}}
                    <div class="flex gap-4 md:gap-6 group">
                        <div class="w-12 h-12 md:w-14 md:h-14 flex-shrink-0 border border-brand-primary/20 flex items-center justify-center text-brand-primary font-display text-lg md:text-xl group-hover:bg-brand-primary group-hover:text-white transition-all duration-300">01</div>
                        <div>
                            <h4 class="font-display text-lg md:text-xl text-brand-primary mb-1 md:mb-2">Diagnóstico e Perfil</h4>
                            <p class="text-gray-500 text-sm font-light">Análise profunda dos objetivos de investimento, estilo de vida e necessidades familiares.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 md:gap-6 group">
                        <div class="w-12 h-12 md:w-14 md:h-14 flex-shrink-0 border border-brand-primary/20 flex items-center justify-center text-brand-primary font-display text-lg md:text-xl group-hover:bg-brand-primary group-hover:text-white transition-all duration-300">02</div>
                        <div>
                            <h4 class="font-display text-lg md:text-xl text-brand-primary mb-1 md:mb-2">Market Intelligence</h4>
                            <p class="text-gray-500 text-sm font-light">Cruzamento de dados para identificar oportunidades reais e ativos subvalorizados ou off-market.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 md:gap-6 group">
                        <div class="w-12 h-12 md:w-14 md:h-14 flex-shrink-0 border border-brand-primary/20 flex items-center justify-center text-brand-primary font-display text-lg md:text-xl group-hover:bg-brand-primary group-hover:text-white transition-all duration-300">03</div>
                        <div>
                            <h4 class="font-display text-lg md:text-xl text-brand-primary mb-1 md:mb-2">Estratégia e Negociação</h4>
                            <p class="text-gray-500 text-sm font-light">Representação assertiva para garantir as melhores condições de fecho e segurança jurídica.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. IMÓVEIS EM DESTAQUE --}}
    <section id="properties" class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 md:mb-12 gap-4">
                <div>
                    <h2 class="text-[10px] md:text-xs font-bold text-brand-cta uppercase tracking-[0.25em] md:tracking-[0.3em] mb-2 md:mb-3">Oportunidades</h2>
                    <h3 class="font-display text-3xl md:text-4xl lg:text-5xl text-brand-primary">Curadoria de Ativos</h3>
                </div>
                <a href="{{ route('portfolio') }}" class="hidden md:block px-6 md:px-8 py-2.5 md:py-3 border border-brand-primary text-brand-primary text-[10px] md:text-xs font-bold uppercase tracking-widest hover:bg-brand-primary hover:text-white transition-all">
                    Ver Portfólio Completo
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mb-8 md:mb-12">
                @foreach($properties as $property)
                    <div class="group block relative bg-white border border-gray-100 hover:shadow-xl transition-all duration-300">
                        <a href="{{ route('properties.show', $property->slug) }}" aria-label="Ver detalhes de {{ $property->title }}">
                            <div class="relative h-[250px] md:h-[300px] overflow-hidden bg-gray-100">
                                <img src="{{ $property->cover_image ? asset('storage/' . $property->cover_image) : asset('img/placeholder.jpg') }}" 
                                     alt="Foto principal do imóvel {{ $property->title }}"
                                     loading="lazy"
                                     width="400"
                                     height="300"
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                
                                <div class="absolute top-3 md:top-4 right-3 md:right-4 bg-white/95 px-2.5 md:px-3 py-1 text-[9px] md:text-[10px] font-bold uppercase tracking-wider text-brand-primary shadow-sm">
                                    {{ $property->type }}
                                </div>
                                <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/60 to-transparent p-4 md:p-6">
                                    <p class="text-white font-bold text-base md:text-lg">{{ number_format($property->price, 0, ',', '.') }} €</p>
                                </div>
                            </div>
                            <div class="p-4 md:p-6">
                                <p class="text-brand-cta text-[9px] md:text-[10px] font-bold uppercase tracking-wider mb-2">{{ $property->location }}</p>
                                <h4 class="font-display text-lg md:text-xl text-brand-primary mb-3 md:mb-4 truncate">{{ $property->title }}</h4>
                                <div class="flex justify-between items-center border-t border-gray-100 pt-3 md:pt-4 text-[11px] md:text-xs text-gray-500 font-medium">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                        {{ $property->bedrooms }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                                        {{ $property->area_gross }}m²
                                    </span>
                                    <span class="text-brand-cta font-bold hidden md:inline">Ver Detalhes →</span>
                                    <span class="text-brand-cta font-bold md:hidden">Ver →</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="text-center md:hidden">
                <a href="{{ route('portfolio') }}" class="inline-block px-8 py-3 bg-brand-primary text-white text-xs font-bold uppercase tracking-widest">
                    Ver Todo o Portfólio
                </a>
            </div>
        </div>
    </section>

    {{-- 5. PRIVATE OFFICE (OFF MARKET) --}}
    <section id="contact" class="py-20 md:py-32 relative overflow-hidden">
        {{-- Fundo Luxo Interior --}}
        <div class="absolute inset-0 bg-cover bg-center fixed-bg" 
             style="background-image: url('https://images.pexels.com/photos/3797991/pexels-photo-3797991.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2');">
        </div>
        
        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black/20"></div>

        <div class="container mx-auto px-4 md:px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 items-center">
                {{-- Texto Off Market --}}
                <div class="text-left text-white drop-shadow-lg">
                    <h2 class="font-display text-4xl md:text-5xl lg:text-6xl mb-4 md:mb-6">Private <span class="italic text-brand-premium">Office.</span></h2>
                    <p class="font-light text-base md:text-lg lg:text-xl leading-relaxed mb-6 md:mb-8">
                        Acesso exclusivo a oportunidades <strong>Off-Market</strong>. 
                        A nossa coleção privada inclui ativos que exigem total confidencialidade.
                    </p>
                </div>

                {{-- Formulário --}}
                <div class="bg-black/40 backdrop-blur-md p-6 md:p-8 border border-white/10 rounded-sm">
                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-5 md:space-y-6">
                        @csrf
                        <div class="space-y-1">
                            <label class="text-[10px] md:text-xs text-brand-premium uppercase tracking-widest ml-1">Nome</label>
                            <input type="text" name="name" required class="w-full bg-transparent border-b border-white/40 py-2.5 md:py-3 text-white text-sm md:text-base focus:outline-none focus:border-brand-premium transition-colors placeholder-white/30" placeholder="Seu nome completo">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] md:text-xs text-brand-premium uppercase tracking-widest ml-1">Email</label>
                            <input type="email" name="email" required class="w-full bg-transparent border-b border-white/40 py-2.5 md:py-3 text-white text-sm md:text-base focus:outline-none focus:border-brand-premium transition-colors placeholder-white/30" placeholder="seu@email.com">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] md:text-xs text-brand-premium uppercase tracking-widest ml-1">Telefone</label>
                            <input type="tel" name="phone" class="w-full bg-transparent border-b border-white/40 py-2.5 md:py-3 text-white text-sm md:text-base focus:outline-none focus:border-brand-premium transition-colors placeholder-white/30" placeholder="+351 ...">
                        </div>
                        <input type="hidden" name="subject" value="Lead Private Office (Off Market)">
                        
                        <button type="submit" class="w-full mt-6 md:mt-8 bg-brand-premium hover:bg-white text-brand-primary font-bold uppercase tracking-widest text-xs md:text-sm py-3.5 md:py-4 transition-all duration-300 rounded-sm">
                            Solicitar Acesso
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- 6. FEEDBACK --}}
    <section class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-[10px] md:text-xs font-bold text-brand-cta uppercase tracking-[0.25em] md:tracking-[0.3em] mb-2 md:mb-3">Feedback</h2>
                <h3 class="font-display text-3xl md:text-4xl lg:text-5xl text-brand-primary">O Que Dizem os Nossos Clientes</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                {{-- Card 1 --}}
                <div class="bg-gray-50 p-6 md:p-10 border border-gray-100 hover:shadow-xl transition-all duration-300" data-aos="fade-up">
                    <div class="text-brand-premium text-5xl md:text-6xl font-serif mb-3 md:mb-4 opacity-50">"</div>
                    <p class="text-gray-600 font-light italic mb-4 md:mb-6 leading-relaxed text-sm md:text-base">"O José transformou a nossa procura por uma casa de férias num investimento sólido. A transparência e o conhecimento de mercado foram inigualáveis."</p>
                    <div class="flex items-center gap-3 md:gap-4 pt-3 md:pt-4 border-t border-gray-200">
                        <div class="w-9 h-9 md:w-10 md:h-10 bg-brand-primary rounded-full flex items-center justify-center text-white font-bold text-xs">A</div>
                        <div>
                            <p class="text-xs md:text-sm font-bold text-brand-primary">André S.</p>
                            <p class="text-[9px] md:text-[10px] text-brand-secondary uppercase tracking-wider">Investidor, Brasil</p>
                        </div>
                    </div>
                </div>

                {{-- Card 2 --}}
                <div class="bg-gray-50 p-6 md:p-10 border border-gray-100 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-brand-premium text-5xl md:text-6xl font-serif mb-3 md:mb-4 opacity-50">"</div>
                    <p class="text-gray-600 font-light italic mb-4 md:mb-6 leading-relaxed text-sm md:text-base">"Processo irrepreensível. Desde a seleção dos imóveis até ao fecho do negócio, senti-me acompanhada por um verdadeiro parceiro."</p>
                    <div class="flex items-center gap-3 md:gap-4 pt-3 md:pt-4 border-t border-gray-200">
                        <div class="w-9 h-9 md:w-10 md:h-10 bg-brand-primary rounded-full flex items-center justify-center text-white font-bold text-xs">M</div>
                        <div>
                            <p class="text-xs md:text-sm font-bold text-brand-primary">Maria C.</p>
                            <p class="text-[9px] md:text-[10px] text-brand-secondary uppercase tracking-wider">Médica, Lisboa</p>
                        </div>
                    </div>
                </div>

                {{-- Card 3 --}}
                <div class="bg-gray-50 p-6 md:p-10 border border-gray-100 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-brand-premium text-5xl md:text-6xl font-serif mb-3 md:mb-4 opacity-50">"</div>
                    <p class="text-gray-600 font-light italic mb-4 md:mb-6 leading-relaxed text-sm md:text-base">"Profissionalismo raro. O acesso a imóveis off-market fez toda a diferença na nossa decisão final de investimento."</p>
                    <div class="flex items-center gap-3 md:gap-4 pt-3 md:pt-4 border-t border-gray-200">
                        <div class="w-9 h-9 md:w-10 md:h-10 bg-brand-primary rounded-full flex items-center justify-center text-white font-bold text-xs">J</div>
                        <div>
                            <p class="text-xs md:text-sm font-bold text-brand-primary">James W.</p>
                            <p class="text-[9px] md:text-[10px] text-brand-secondary uppercase tracking-wider">CEO, Londres</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 7. PERGUNTAS FREQUENTES (FAQ) --}}
    <section class="py-16 md:py-24 bg-gray-50">
        <div class="container mx-auto px-4 md:px-6 max-w-4xl">
            <div class="text-center mb-10 md:mb-12">
                <h2 class="text-[10px] md:text-xs font-bold text-brand-cta uppercase tracking-[0.25em] md:tracking-[0.3em] mb-2 md:mb-3">Dúvidas</h2>
                <h3 class="font-display text-2xl md:text-3xl lg:text-4xl text-brand-primary">Perguntas Frequentes</h3>
            </div>

            <div class="space-y-3 md:space-y-4" x-data="{ active: null }">
                <div class="bg-white border border-gray-200 rounded-sm">
                    <button @click="active = (active === 1 ? null : 1)" class="w-full text-left px-4 md:px-6 py-4 md:py-5 flex justify-between items-center focus:outline-none">
                        <span class="font-bold text-brand-primary text-xs md:text-sm lg:text-base pr-4">Como funciona o processo de Golden Visa?</span>
                        <span class="text-xl md:text-2xl text-brand-cta font-light flex-shrink-0" x-text="active === 1 ? '-' : '+'"></span>
                    </button>
                    <div x-show="active === 1" x-collapse class="px-4 md:px-6 pb-4 md:pb-6 text-gray-500 text-xs md:text-sm font-light leading-relaxed border-t border-gray-100 pt-3 md:pt-4">
                        Apoiamos em todo o processo burocrático, desde a seleção de fundos de investimento elegíveis até à gestão imobiliária para fins de visto, trabalhando em parceria com advogados especializados.
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-sm">
                    <button @click="active = (active === 2 ? null : 2)" class="w-full text-left px-4 md:px-6 py-4 md:py-5 flex justify-between items-center focus:outline-none">
                        <span class="font-bold text-brand-primary text-xs md:text-sm lg:text-base pr-4">Trabalham com imóveis fora do mercado (Off-Market)?</span>
                        <span class="text-xl md:text-2xl text-brand-cta font-light flex-shrink-0" x-text="active === 2 ? '-' : '+'"></span>
                    </button>
                    <div x-show="active === 2" x-collapse class="px-4 md:px-6 pb-4 md:pb-6 text-gray-500 text-xs md:text-sm font-light leading-relaxed border-t border-gray-100 pt-3 md:pt-4">
                        Sim. Grande parte do nosso portfólio de luxo não é listado publicamente para proteger a privacidade dos proprietários e compradores. Entre em contacto para acesso exclusivo.
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-sm">
                    <button @click="active = (active === 3 ? null : 3)" class="w-full text-left px-4 md:px-6 py-4 md:py-5 flex justify-between items-center focus:outline-none">
                        <span class="font-bold text-brand-primary text-xs md:text-sm lg:text-base pr-4">Faz gestão de arrendamento pós-compra?</span>
                        <span class="text-xl md:text-2xl text-brand-cta font-light flex-shrink-0" x-text="active === 3 ? '-' : '+'"></span>
                    </button>
                    <div x-show="active === 3" x-collapse class="px-4 md:px-6 pb-4 md:pb-6 text-gray-500 text-xs md:text-sm font-light leading-relaxed border-t border-gray-100 pt-3 md:pt-4">
                        Sim, oferecemos um serviço chave-na-mão para investidores que desejam rentabilizar os seus ativos sem preocupações operacionais (Short-term ou Long-term rental).
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 8. ÚLTIMA DOBRA: MAPA (COMPACTO EM CAIXINHA) --}}
    <section class="py-12 md:py-16 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-6 md:mb-8">
                    <h2 class="text-[10px] md:text-xs font-bold text-brand-cta uppercase tracking-[0.25em] md:tracking-[0.3em] mb-2 md:mb-3">Localização</h2>
                    <h3 class="font-display text-2xl md:text-3xl lg:text-4xl text-brand-primary">Visite-nos</h3>
                </div>

                <div class="bg-white border border-gray-200 shadow-lg overflow-hidden rounded-sm">
                    <div class="relative h-[220px] md:h-[280px] w-full bg-gray-100">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3181.769974591465!2d-7.927233823486338!3d37.0113823721867!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0552d7e63b0a7b%3A0x6c6e752945281577!2sAv.%20Cidade%20de%20Hayward%206%2C%208000-170%20Faro!5e0!3m2!1spt-PT!2spt!4v1707436000000!5m2!1spt-PT!2spt" 
                            width="100%" 
                            height="100%" 
                            style="border:0; filter: grayscale(100%) contrast(1.1);" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                    
                    <div class="p-4 md:p-6 bg-gray-50 border-t border-gray-200">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 md:gap-4">
                            <div>
                                <h4 class="font-display text-lg md:text-xl text-brand-primary mb-1">Faro, Algarve</h4>
                                <p class="text-[9px] md:text-[10px] text-brand-secondary uppercase tracking-widest mb-2">Sede Operacional</p>
                            </div>
                            <div class="text-left md:text-right">
                                <p class="text-brand-text font-bold text-xs md:text-sm">Av. Cidade de Hayward 6</p>
                                <p class="text-gray-500 text-xs md:text-sm">8000-170 Faro, Portugal</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<style>
    @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
    .animate-marquee { animation: marquee 40s linear infinite; }
    .fixed-bg { background-attachment: fixed; }
    @media (max-width: 768px) {
        .fixed-bg { background-attachment: scroll; }
    }
</style>

@endsection