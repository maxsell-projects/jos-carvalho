@extends('layouts.app')

@section('content')

<div class="bg-brand-black text-white py-24 text-center relative overflow-hidden">
    <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    <div class="container mx-auto px-6 relative z-10">
        {{-- [Alterado] Fale Conosco -> Contacte-nos --}}
        <p class="text-brand-gold text-xs uppercase tracking-[0.4em] mb-4">Contacte-nos</p>
        {{-- [Alterado] Estamos à Sua Espera -> Estamos ao seu Dispor --}}
        <h1 class="text-3xl md:text-5xl font-serif">Estamos ao seu Dispor</h1>
        <p class="mt-4 text-gray-400 font-light max-w-2xl mx-auto">
            Seja para comprar, vender ou avaliar o seu imóvel, a nossa equipa está pronta para oferecer um serviço de excelência.
        </p>
    </div>
</div>

<section class="py-20 bg-white relative">
    <div class="container mx-auto px-6 md:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            
            <div class="space-y-12">
                <div>
                    {{-- [Nota] Já estava correto em PT-PT (Contacto com c) --}}
                    <h3 class="text-2xl font-serif text-brand-black mb-6">Informações de Contacto</h3>
                    <p class="text-gray-500 font-light leading-relaxed mb-8">
                        Privilegiamos o contacto direto e personalizado. Visite-nos no nosso escritório ou envie uma mensagem direta.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="p-3 border border-brand-gold/30 rounded-full text-brand-gold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold uppercase tracking-widest text-brand-black mb-1">Escritório</h4>
                                <p class="text-gray-600 font-light">Av. Casal Ribeiro 12B<br>Lisboa, Portugal</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="p-3 border border-brand-gold/30 rounded-full text-brand-gold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold uppercase tracking-widest text-brand-black mb-1">Telefone</h4>
                                <p class="text-gray-600 font-light">+351 910 739 610</p>
                                <p class="text-xs text-gray-400 mt-1">Segunda a Sexta, 09:00 - 18:00</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="p-3 border border-brand-gold/30 rounded-full text-brand-gold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold uppercase tracking-widest text-brand-black mb-1">Email</h4>
                                <p class="text-gray-600 font-light">dmgmaia@remax.pt</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full h-64 bg-gray-200 rounded overflow-hidden grayscale hover:grayscale-0 transition duration-700 shadow-inner">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3112.83968252277!2d-9.147137523455122!3d38.73295847175955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd19331245089309%3A0xc3c544d67362399d!2sAv.%20Casal%20Ribeiro%2012B%2C%201000-092%20Lisboa!5e0!3m2!1spt-PT!2spt!4v1704720000000!5m2!1spt-PT!2spt" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <div class="bg-gray-50 p-8 md:p-10 rounded border border-gray-100 shadow-lg">
                <h3 class="text-2xl font-serif text-brand-black mb-6">Envie uma Mensagem</h3>
                
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Nome</label>
                            {{-- [Alterado] Seu nome -> O seu nome --}}
                            <input type="text" name="name" required class="w-full bg-white border border-gray-200 rounded px-4 py-3 focus:outline-none focus:border-brand-gold transition-colors" placeholder="O seu nome">
                        </div>
                        <div>
                            <label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Telemóvel</label>
                            {{-- [Alterado] Telefone -> Telemóvel (mais comum para pessoal) ou mantém Telefone se for fixo --}}
                            <input type="tel" name="phone" class="w-full bg-white border border-gray-200 rounded px-4 py-3 focus:outline-none focus:border-brand-gold transition-colors" placeholder="+351">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Email</label>
                        {{-- [Alterado] seu@email.com -> o-seu@email.com --}}
                        <input type="email" name="email" required class="w-full bg-white border border-gray-200 rounded px-4 py-3 focus:outline-none focus:border-brand-gold transition-colors" placeholder="o-seu@email.com">
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Assunto</label>
                        <select name="subject" class="w-full bg-white border border-gray-200 rounded px-4 py-3 focus:outline-none focus:border-brand-gold transition-colors text-gray-600">
                            <option value="Interesse em Comprar">Interesse em Comprar</option>
                            <option value="Vender Propriedade">Vender Propriedade</option>
                            <option value="Parcerias / Investimento">Parcerias / Investimento</option>
                            <option value="Outros Assuntos">Outros Assuntos</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Mensagem</label>
                        <textarea name="message" rows="5" required class="w-full bg-white border border-gray-200 rounded px-4 py-3 focus:outline-none focus:border-brand-gold transition-colors resize-none" placeholder="Como podemos ajudar?"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-brand-black text-white font-bold py-4 hover:bg-brand-gold hover:text-white transition-colors uppercase tracking-widest text-xs mt-4 rounded shadow-lg">
                        Enviar Mensagem
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

@endsection