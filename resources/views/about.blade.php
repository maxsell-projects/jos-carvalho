@extends('layouts.app')

@section('content')

{{-- 1. HERO SECTION --}}
<section class="relative h-[60vh] min-h-[500px] flex items-center justify-center bg-fixed bg-cover bg-center" 
         style="background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070&auto=format&fit=crop');">
    {{-- Overlay escuro para garantir leitura --}}
    <div class="absolute inset-0 bg-black/70"></div>
    
    <div class="relative z-10 text-center" data-aos="fade-up">
        <p class="text-white/80 text-xs uppercase tracking-[0.4em] mb-4">Consultor Imobiliário</p>
        <h1 class="text-5xl md:text-7xl font-serif text-white">Diogo Maia</h1>
    </div>
</section>

{{-- 2. TEXTO DE IMPACTO --}}
<section class="py-24 bg-white">
    <div class="container mx-auto px-6 max-w-5xl text-center" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-serif text-brand-black leading-snug mb-8">
            "Reimagino o mercado imobiliário de hoje para <br> <span class="text-brand-gold italic">construir os bairros de amanhã.</span>"
        </h2>
        <div class="w-[1px] h-16 bg-brand-gold mx-auto mb-8 opacity-40"></div>
        <p class="text-gray-500 font-light text-lg leading-relaxed max-w-3xl mx-auto">
            {{-- [Alterado] Removida menção à equipa e ajustado para PT-PT --}}
            O meu compromisso é capacitar os meus clientes e parceiros com o que há de mais moderno em comunicação, tecnologia e estratégia. Vejo oportunidade e promessa onde outros não vêem, e acordo todas as manhãs com um propósito claro: ser ilimitado.
        </p>
    </div>
</section>

{{-- 3. A MINHA HISTÓRIA & FOTO --}}
<section class="py-24 bg-neutral-50 border-t border-gray-200">
    <div class="container mx-auto px-6 md:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-start">
            
            {{-- Coluna da Foto --}}
            <div class="lg:col-span-5 sticky top-24" data-aos="fade-right">
                <div class="relative">
                    <div class="absolute top-4 -left-4 w-full h-full border-2 border-brand-gold/20 pointer-events-none"></div>
                    
                    <img src="{{ asset('img/DiegoMaia.jpg') }}" 
                         alt="Diogo Maia" 
                         class="w-full h-[700px] object-cover shadow-2xl grayscale-[10%] contrast-110">
                </div>
            </div>

            <div class="lg:col-span-7 space-y-16">
                
                {{-- Texto História --}}
                <div data-aos="fade-up">
                    <h3 class="text-4xl font-serif text-brand-black mb-8">A Minha História</h3>
                    <div class="prose prose-lg text-gray-500 font-light leading-relaxed space-y-6">
                        <p>
                            {{-- [Alterado] Meu nome -> O meu nome --}}
                            O meu nome é Diogo Maia e, aos 24 anos, encontrei no mercado imobiliário a arena perfeita para a minha energia e espírito empreendedor. O que me move não é apenas a paixão por imóveis, mas a busca incansável por aprendizagem e crescimento num setor que exige o nosso melhor todos os dias.
                        </p>
                        <p>
                            {{-- [Alterado] PT-PT: Encaram/Vêem e colocação pronominal --}}
                            Muitos encaram a alta competitividade como um obstáculo; eu vejo-a como o combustível que me impulsiona. O meu compromisso é transformar essa energia em resultados para os meus clientes, e faço-o com aquilo a que chamo o meu "superpoder": foco absoluto nos seus objetivos e disponibilidade total para o seu projeto.
                        </p>
                    </div>
                </div>

                {{-- Grid de Valores --}}
                <div data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-2xl font-serif text-brand-black mb-10 flex items-center gap-4">
                        Os Meus Valores
                        <span class="block h-[1px] flex-grow bg-gray-300"></span>
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-12">
                        
                        <div class="group">
                            <span class="text-brand-gold text-xs font-bold uppercase tracking-widest mb-2 block">01.</span>
                            <h4 class="text-xl font-serif text-brand-black mb-3 group-hover:text-brand-gold transition-colors">Compromisso Absoluto</h4>
                            <p class="text-sm text-gray-500 leading-relaxed font-light">
                                Para mim, cada cliente é o meu único cliente. Dedico 100% do meu foco e da minha disponibilidade ao seu projeto, garantindo uma comunicação transparente e um acompanhamento que vai do início ao fim do processo, sem exceções. O seu objetivo é a minha missão.
                            </p>
                        </div>

                        <div class="group">
                            <span class="text-brand-gold text-xs font-bold uppercase tracking-widest mb-2 block">02.</span>
                            <h4 class="text-xl font-serif text-brand-black mb-3 group-hover:text-brand-gold transition-colors">Visão Estratégica</h4>
                            <p class="text-sm text-gray-500 leading-relaxed font-light">
                                {{-- [Alterado] Enxergando -> Visualizando --}}
                                Não me limito a encontrar imóveis; identifico oportunidades. Analiso o mercado com um olhar para o futuro, visualizando o potencial de valorização e a promessa de um bom negócio onde outros vêem apenas o presente. É sobre fazer um investimento inteligente, não apenas uma transação.
                            </p>
                        </div>

                        <div class="group">
                            <span class="text-brand-gold text-xs font-bold uppercase tracking-widest mb-2 block">03.</span>
                            <h4 class="text-xl font-serif text-brand-black mb-3 group-hover:text-brand-gold transition-colors">Evolução Constante</h4>
                            <p class="text-sm text-gray-500 leading-relaxed font-light">
                                {{-- [Alterado] Garantir que você -> Garantir que tenha --}}
                                O mercado imobiliário não para, e eu também não. Estou em constante aprendizagem, a atualizar-me sobre as novas tecnologias, tendências de marketing e estratégias de negociação para garantir que tenha sempre a abordagem mais eficaz e inteligente ao seu lado.
                            </p>
                        </div>

                        <div class="group">
                            <span class="text-brand-gold text-xs font-bold uppercase tracking-widest mb-2 block">04.</span>
                            <h4 class="text-xl font-serif text-brand-black mb-3 group-hover:text-brand-gold transition-colors">Energia e Proatividade</h4>
                            <p class="text-sm text-gray-500 leading-relaxed font-light">
                                {{-- [Alterado] Minha energia -> A minha energia / Eu faço -> Faço --}}
                                A minha energia é o seu maior ativo. Sou proativo, ágil e incansável na busca pelos seus objetivos. Não espero que as coisas aconteçam; faço-as acontecer, garantindo que nenhuma oportunidade seja perdida e que o seu processo seja o mais rápido e dinâmico possível.
                            </p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- 4. CALL TO ACTION --}}
<section class="py-24 bg-brand-charcoal text-white text-center">
    <div class="container mx-auto px-6" data-aos="zoom-in">
        <h2 class="text-3xl md:text-5xl font-serif mb-8">Pronto para o próximo passo?</h2>
        <a href="{{ route('contact') }}" class="inline-block border border-white px-10 py-4 text-xs font-bold uppercase tracking-[0.2em] hover:bg-white hover:text-brand-black transition-all duration-300">
            Agendar Consultoria
        </a>
    </div>
</section>

@endsection