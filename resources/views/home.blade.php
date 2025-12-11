@extends('layouts.app')

@section('content')

<section class="relative h-screen min-h-[800px] flex items-center justify-center bg-fixed bg-cover bg-center" 
         style="background-image: url('{{ asset('img/porto.jpg') }}');">
    
    <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/40 to-black/90"></div>

    <div class="relative z-10 container mx-auto px-6 text-center" data-aos="fade-up">
        <p class="text-white/60 text-[10px] md:text-xs uppercase tracking-[0.5em] mb-6 font-light">Real Estate & Investments</p>
        <h1 class="text-5xl md:text-8xl font-serif text-white mb-10 leading-none tracking-tight">
            Elegância & <br> <span class="italic text-brand-gold">Exclusividade</span>
        </h1>

        <form action="{{ route('portfolio') }}" method="GET" class="mt-16 inline-flex flex-col md:flex-row items-center border border-white/20 bg-black/30 backdrop-blur-md p-1 rounded-full">
            <input type="text" name="location" placeholder="Localização, condomínio ou palavra-chave..." 
                   class="bg-transparent text-white placeholder-white/50 px-8 py-4 outline-none w-64 md:w-96 text-sm font-light rounded-full md:rounded-l-full md:rounded-r-none">
            
            <button type="submit" class="bg-white text-black hover:bg-brand-gold hover:text-white transition-colors duration-500 px-10 py-4 text-[10px] uppercase tracking-widest font-bold rounded-full">
                Buscar
            </button>
        </form>
    </div>
</section>

<section class="py-32 bg-white text-center relative">
    <div class="container mx-auto px-6 max-w-4xl" data-aos="fade-up">
        <span class="text-xs font-bold tracking-[0.2em] text-gray-500 uppercase mb-4 block">
            IMÓVEIS DE LUXO | ELEGÂNCIA & EXCLUSIVIDADE
        </span>
        
        <h2 class="text-2xl md:text-4xl font-serif text-brand-black mb-10 leading-relaxed">
            <span class="font-bold">DIOGO MAIA</span> – O acesso privilegiado aos imóveis mais exclusivos do mercado, para quem procura <span class="italic text-brand-gold">excelência</span>, <span class="italic text-brand-gold">privacidade</span> e <span class="italic text-brand-gold">distinção</span>.
        </h2>
        
        <div class="w-[1px] h-20 bg-brand-gold mx-auto opacity-50"></div>
    </div>
</section>

<section class="py-24 bg-brand-gray text-brand-black">
    <div class="container mx-auto px-6 md:px-12">
        <div class="flex flex-col md:flex-row justify-between items-end mb-20 border-b border-black/10 pb-8" data-aos="fade-right">
            <div>
                <h3 class="text-5xl font-serif text-brand-black mb-2">Coleção Privada</h3>
                <p class="text-gray-500 text-xs uppercase tracking-widest">Seleção Curada</p>
            </div>
            <a href="{{ route('portfolio') }}" class="mt-6 md:mt-0 text-xs font-bold uppercase tracking-widest border border-black px-6 py-3 hover:bg-black hover:text-white transition duration-300">
                Ver Portfólio Completo
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-16">
            @forelse($properties as $index => $property)
                <a href="{{ route('properties.show', $property) }}" class="group block cursor-pointer" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="relative h-[500px] overflow-hidden bg-gray-200 mb-6">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition duration-700 z-10"></div>
                        
                        <img src="{{ $property->cover_image ? asset('storage/' . $property->cover_image) : asset('img/porto.jpg') }}" 
                             alt="{{ $property->title }}" 
                             class="w-full h-full object-cover transform scale-100 group-hover:scale-105 transition duration-[1.2s] ease-out grayscale-[20%] group-hover:grayscale-0">
                        
                        <div class="absolute top-0 left-0 bg-black text-white text-[9px] uppercase tracking-widest px-4 py-3">
                            {{ $property->type }}
                        </div>
                        
                        <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur text-brand-black text-[9px] uppercase tracking-widest px-3 py-1 font-bold">
                            {{ $property->status }}
                        </div>
                    </div>

                    <div class="pr-4">
                        <div class="flex items-center gap-3 text-gray-500 text-[10px] uppercase tracking-widest mb-3 border-b border-gray-300 pb-3">
                            <span>{{ $property->location ?? 'Portugal' }}</span>
                            <span class="ml-auto">{{ $property->area_gross ? number_format($property->area_gross, 0) . ' m²' : '' }}</span>
                        </div>
                        <h4 class="text-2xl font-serif text-brand-black mb-2 leading-tight group-hover:underline decoration-1 underline-offset-4">
                            {{ $property->title }}
                        </h4>
                        <p class="text-xl font-light text-gray-600">
                            {{ $property->price ? '€ ' . number_format($property->price, 0, ',', '.') : 'Sob Consulta' }}
                        </p>
                    </div>
                </a>
            @empty
                <div class="col-span-3 text-center py-20 text-gray-400 font-serif italic">
                    Acervo em atualização.
                </div>
            @endforelse
        </div>
    </div>
</section>

<section class="py-32 bg-white text-brand-black border-t border-gray-100">
    <div class="container mx-auto px-6 md:px-12">
        <div class="text-center max-w-4xl mx-auto mb-20" data-aos="fade-up">
            <h3 class="text-4xl font-serif mb-6">Excelência, Exclusividade e Discrição: <br> A Visão de Diogo Maia</h3>
            <p class="text-gray-500 font-light leading-relaxed text-lg">
                Descubra análises estratégicas, tendências do mercado imobiliário e oportunidades reservadas a investidores criteriosos. Mais do que informação — <span class="text-black font-medium">inteligência aplicada</span> para decisões que elevam e preservam <span class="text-black font-medium">patrimónios</span>.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <article class="group flex flex-col h-full" data-aos="fade-up" data-aos-delay="0">
                <div class="h-64 overflow-hidden mb-6 bg-gray-100">
                    <img src="{{ asset('img/DiogoMaia2.jpg') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-105 grayscale group-hover:grayscale-0" alt="Investidor">
                </div>
                <div class="border-t border-black pt-6 flex-grow flex flex-col">
                    <h4 class="text-xl font-serif mt-3 mb-4 leading-snug group-hover:text-brand-gold transition">
                        <a href="{{ route('blog.show') }}">
                            O Novo Perfil do Investidor de Luxo: Discrição, Património e Propósito
                        </a>
                    </h4>
                    <p class="text-sm text-gray-500 font-light leading-relaxed mb-6 flex-grow">
                        O mercado de luxo está a mudar. Já não se define apenas pelo preço, pelo tamanho do imóvel ou pelo prestígio da localização. O verdadeiro investidor de luxo em 2025 procura algo mais profundo...
                    </p>
                    <a href="{{ route('blog.show') }}" class="text-[10px] uppercase tracking-widest font-bold hover:text-brand-gold mt-auto inline-block">Continuar Lendo »</a>
                </div>
            </article>

            <article class="group flex flex-col h-full" data-aos="fade-up" data-aos-delay="100">
                <div class="h-64 overflow-hidden mb-6 bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1480714378408-67cf0d13bc1b?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover transition duration-700 group-hover:scale-105 grayscale group-hover:grayscale-0" alt="Dados">
                </div>
                <div class="border-t border-black pt-6 flex-grow flex flex-col">
                    <h4 class="text-xl font-serif mt-3 mb-4 leading-snug group-hover:text-brand-gold transition">
                        <a href="{{ route('blog.show-intelligence') }}">
                            Como a Inteligência de Mercado Redefine o Investimento Imobiliário
                        </a>
                    </h4>
                    <p class="text-sm text-gray-500 font-light leading-relaxed mb-6 flex-grow">
                        O investimento imobiliário de luxo deixou de depender apenas da intuição ou da localização privilegiada. Atualmente, a diferença entre uma compra promissora e uma oportunidade perdida...
                    </p>
                    <a href="{{ route('blog.show-intelligence') }}" class="text-[10px] uppercase tracking-widest font-bold hover:text-brand-gold mt-auto inline-block">Continuar Lendo »</a>
                </div>
            </article>

            <article class="group flex flex-col h-full" data-aos="fade-up" data-aos-delay="200">
                <div class="h-64 overflow-hidden mb-6 bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover transition duration-700 group-hover:scale-105 grayscale group-hover:grayscale-0" alt="Portugal">
                </div>
                <div class="border-t border-black pt-6 flex-grow flex flex-col">
                    <h4 class="text-xl font-serif mt-3 mb-4 leading-snug group-hover:text-brand-gold transition">
                        <a href="{{ route('blog.show-locations') }}">
                            Lisboa, Cascais e Algarve: Os Três Eixos de Valor em 2025
                        </a>
                    </h4>
                    <p class="text-sm text-gray-500 font-light leading-relaxed mb-6 flex-grow">
                        O mercado imobiliário de luxo em Portugal vive uma fase de maturidade e expansão. Zonas como Lisboa, Cascais e Algarve destacam-se como três eixos de valor...
                    </p>
                    <a href="{{ route('blog.show-locations') }}" class="text-[10px] uppercase tracking-widest font-bold hover:text-brand-gold mt-auto inline-block">Continuar Lendo »</a>
                </div>
            </article>
        </div>
    </div>
</section>

<section class="py-24 bg-brand-charcoal text-white relative">
    <div class="container mx-auto px-6 md:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div data-aos="fade-right">
                <h3 class="text-3xl md:text-5xl font-serif mb-6">Entre em Contacto</h3>
                <p class="text-gray-400 mb-10 text-lg font-light">
                    Estamos à disposição para apresentar as propriedades mais exclusivas ou discutir a gestão do seu património imobiliário.
                </p>
                <div class="space-y-8">
                    <div class="flex items-center gap-6">
                        <div class="p-4 border border-white/20 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-brand-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-1">Telefone</p>
                            <p class="text-xl font-serif">+351 912 345 678</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="p-4 border border-white/20 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-brand-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-1">Email</p>
                            <p class="text-xl font-serif">contacto@diogomaia.pt</p>
                        </div>
                    </div>
                </div>
            </div>
            <form action="#" method="POST" class="space-y-6 bg-white/5 p-8 md:p-12 border border-white/10" data-aos="fade-left">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] uppercase tracking-widest text-gray-500">Nome</label>
                        <input type="text" name="name" class="w-full bg-transparent border-b border-white/20 py-3 text-white focus:border-brand-gold focus:outline-none transition-colors" placeholder="Seu nome">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] uppercase tracking-widest text-gray-500">Telemóvel</label>
                        <input type="tel" name="phone" class="w-full bg-transparent border-b border-white/20 py-3 text-white focus:border-brand-gold focus:outline-none transition-colors" placeholder="+351">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] uppercase tracking-widest text-gray-500">Email</label>
                    <input type="email" name="email" class="w-full bg-transparent border-b border-white/20 py-3 text-white focus:border-brand-gold focus:outline-none transition-colors" placeholder="seu@email.com">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] uppercase tracking-widest text-gray-500">Mensagem</label>
                    <textarea name="message" rows="3" class="w-full bg-transparent border-b border-white/20 py-3 text-white focus:border-brand-gold focus:outline-none transition-colors resize-none" placeholder="Como podemos ajudar?"></textarea>
                </div>
                <button type="submit" class="w-full bg-white text-black font-bold py-4 hover:bg-brand-gold hover:text-white transition-colors uppercase tracking-widest text-xs mt-4">
                    Enviar Mensagem
                </button>
            </form>
        </div>
    </div>
</section>

@endsection