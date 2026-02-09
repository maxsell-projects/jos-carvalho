@extends('layouts.app')

@section('content')

{{-- 1. HERO: MINIMALISTA & ELEGANTE --}}
<section class="relative h-[60vh] min-h-[500px] flex items-center justify-center bg-brand-primary text-white overflow-hidden">
    {{-- Textura de fundo sutil --}}
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    
    <div class="container mx-auto px-6 relative z-10 text-center" data-aos="fade-up">
        <p class="text-brand-premium font-mono text-xs uppercase tracking-[0.4em] mb-6 animate-pulse">
            Consultoria Privada
        </p>
        <h1 class="text-6xl md:text-8xl font-display font-bold leading-none mb-6">
            José Carvalho
        </h1>
        <div class="w-24 h-[1px] bg-brand-premium mx-auto"></div>
    </div>
</section>

{{-- 2. MANIFESTO (TEXTO DE IMPACTO) --}}
<section class="py-32 bg-white">
    <div class="container mx-auto px-6 max-w-4xl text-center" data-aos="fade-up">
        <h2 class="text-3xl md:text-5xl font-display text-brand-primary leading-tight mb-12">
            "A verdadeira arte da mediação imobiliária não está na transação, mas na <span class="italic text-brand-premium">construção de património.</span>"
        </h2>
        
        <p class="text-gray-500 font-light text-lg leading-relaxed text-justify md:text-center max-w-2xl mx-auto font-sans">
            Num mundo movido pela velocidade, escolho a precisão. O meu compromisso não é apenas fechar negócios, é desenhar estratégias que perdurem. Acredito que cada metro quadrado deve servir um propósito maior: a segurança do seu investimento e o legado da sua família.
        </p>
    </div>
</section>

{{-- 3. A BIO & FOTO --}}
<section class="py-24 bg-white border-y border-gray-100">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            
            {{-- Coluna da Foto (Editorial Style) --}}
            <div class="lg:col-span-5 relative" data-aos="fade-right">
                <div class="relative overflow-hidden aspect-[3/4] group">
                    {{-- PLACEHOLDER FOTO (Trocar pela foto oficial depois) --}}
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=1974&auto=format&fit=crop" 
                         alt="José Carvalho" 
                         class="w-full h-full object-cover grayscale transition-all duration-700 group-hover:grayscale-0">
                    
                    <div class="absolute bottom-0 left-0 bg-white p-6 max-w-[80%] border-t-4 border-brand-premium shadow-lg">
                        <p class="font-display font-bold text-2xl text-brand-primary">15+ Anos</p>
                        <p class="text-[10px] uppercase tracking-widest text-gray-400">De Experiência em Mercado de Luxo</p>
                    </div>
                </div>
                {{-- Elemento Decorativo --}}
                <div class="absolute -z-10 top-10 -right-10 w-full h-full border border-gray-100"></div>
            </div>

            {{-- Coluna de Texto --}}
            <div class="lg:col-span-7 space-y-12">
                <div data-aos="fade-up">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-brand-cta mb-4">O Percurso</h3>
                    <h2 class="text-4xl font-display font-bold text-brand-primary mb-8">Da Banca à Consultoria Exclusiva.</h2>
                    
                    <div class="prose prose-lg text-gray-500 font-light leading-relaxed space-y-6 text-justify font-sans">
                        <p>O meu nome é José Carvalho.</p>
                        
                        <p>Antes de integrar o setor imobiliário, construí uma carreira sólida no setor financeiro, onde desenvolvi uma abordagem analítica orientada para a gestão de risco, leitura de dados e tomada de decisão estratégica.</p>
                        
                        <p>Essa base permite-me hoje encarar cada imóvel não apenas como um bem físico, mas como um ativo patrimonial, com impacto direto na estabilidade financeira, no planeamento fiscal e na qualidade de vida de quem investe ou reside.</p>
                        
                        <p>Ao longo desse percurso, especializei-me no acompanhamento de clientes High Net Worth, um contexto onde a discrição, o rigor e a eficiência não são diferenciais — são pressupostos essenciais.</p>
                        
                        <p>O meu trabalho inicia-se muito antes da primeira visita e prolonga-se para além da escritura. Assenta num processo estruturado, claro e antecipatório, que inclui o acompanhamento de processos de Golden Visa, planeamento fiscal e reinstalação de famílias em Portugal.</p>
                        
                        <p>Cada decisão é conduzida com método, transparência e visão de longo prazo.</p>
                        
                        <p class="font-medium text-brand-primary border-l-2 border-brand-premium pl-4">
                            Mais do que intermediar imóveis, a minha função é proteger património, reduzir risco e assegurar processos bem conduzidos, à altura das expectativas de um mercado de exigência elevada.
                        </p>
                    </div>
                </div>

                {{-- Assinatura (Visual) --}}
                <div data-aos="fade-up" data-aos-delay="200">
                    <p class="font-display italic text-2xl text-brand-premium">José Carvalho</p>
                    <p class="text-xs text-gray-400 uppercase tracking-widest mt-2">Fundador & Senior Consultant</p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- 4. PILARES / VALORES --}}
<section class="py-32 bg-brand-primary text-white">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 divide-y md:divide-y-0 md:divide-x divide-white/10">
            
            <div class="px-6 py-8 md:py-0 text-center md:text-left group" data-aos="fade-up" data-aos-delay="0">
                <span class="text-brand-premium font-display text-5xl mb-6 block group-hover:scale-110 transition-transform">01.</span>
                <h4 class="text-xl font-bold uppercase tracking-widest mb-4">Integridade Inegociável</h4>
                <p class="text-gray-400 font-light leading-relaxed text-sm">
                    A confiança demora anos a construir e segundos a perder. Pauto a minha conduta pela transparência absoluta. Se um negócio não for bom para si, serei o primeiro a desaconselhá-lo.
                </p>
            </div>

            <div class="px-6 py-8 md:py-0 text-center md:text-left group" data-aos="fade-up" data-aos-delay="200">
                <span class="text-brand-premium font-display text-5xl mb-6 block group-hover:scale-110 transition-transform">02.</span>
                <h4 class="text-xl font-bold uppercase tracking-widest mb-4">Inteligência de Mercado</h4>
                <p class="text-gray-400 font-light leading-relaxed text-sm">
                    Não vendo intuição; vendo dados. As minhas recomendações baseiam-se em análises comparativas de mercado, taxas de rentabilidade (yields) e projeções de valorização futura.
                </p>
            </div>

            <div class="px-6 py-8 md:py-0 text-center md:text-left group" data-aos="fade-up" data-aos-delay="400">
                <span class="text-brand-premium font-display text-5xl mb-6 block group-hover:scale-110 transition-transform">03.</span>
                <h4 class="text-xl font-bold uppercase tracking-widest mb-4">Discrição Absoluta</h4>
                <p class="text-gray-400 font-light leading-relaxed text-sm">
                    Compreendo a natureza sensível dos grandes investimentos. Garanto total sigilo em todas as fases do processo, protegendo a sua identidade e os seus interesses negociais.
                </p>
            </div>

        </div>
    </div>
</section>

{{-- 5. CTA EDITORIAL --}}
<section class="py-24 bg-white text-center">
    <div class="container mx-auto px-6" data-aos="zoom-in">
        <h2 class="text-3xl md:text-5xl font-display font-bold text-brand-primary mb-8">
            Um café, uma estratégia.
        </h2>
        <p class="text-gray-500 mb-10 font-light">Vamos discutir o futuro do seu portfólio imobiliário?</p>
        
        <a href="{{ route('contact') }}" class="group relative inline-flex items-center gap-3 px-10 py-5 bg-brand-primary text-white text-xs font-bold uppercase tracking-[0.2em] overflow-hidden hover:bg-brand-cta transition-colors duration-300">
            <span>Agendar Reunião</span>
            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </a>
    </div>
</section>

@endsection