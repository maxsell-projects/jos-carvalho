@extends('layouts.app')

@section('content')

{{-- HERO SECTION: SÓBRIO & ELEGANTE --}}
<div class="bg-brand-primary text-white py-32 text-center relative overflow-hidden">
    {{-- Textura Sutil --}}
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    
    <div class="container mx-auto px-6 relative z-10" data-aos="fade-up">
        <p class="text-brand-premium font-mono text-xs uppercase tracking-[0.4em] mb-6">
            Canais Oficiais
        </p>
        <h1 class="text-4xl md:text-6xl font-didot leading-tight">
            Estamos ao seu Dispor
        </h1>
        <div class="w-16 h-[1px] bg-brand-premium mx-auto mt-8 mb-6"></div>
        <p class="text-gray-300 font-light max-w-2xl mx-auto text-lg leading-relaxed">
            Seja para comprar, vender ou avaliar o seu património, a nossa equipa está preparada para oferecer um acompanhamento de excelência.
        </p>
    </div>
</div>

<section class="py-24 bg-brand-background relative">
    <div class="container mx-auto px-6 md:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24">
            
            {{-- COLUNA 1: INFORMAÇÕES --}}
            <div class="space-y-12" data-aos="fade-right">
                <div>
                    <h3 class="text-3xl font-didot text-brand-primary mb-6">Informações de Contacto</h3>
                    <p class="text-gray-500 font-light leading-relaxed mb-10 text-justify">
                        Privilegiamos a relação humana e o contacto personalizado. Visite-nos no nosso atelier em Lisboa ou agende uma reunião digital.
                    </p>
                    
                    <div class="space-y-8">
                        {{-- Escritório --}}
                        <div class="flex items-start gap-6 group">
                            <div class="p-4 bg-white border border-gray-100 shadow-sm text-brand-premium group-hover:bg-brand-primary group-hover:text-white transition-colors duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-widest text-brand-primary mb-2">Atelier / Escritório</h4>
                                <p class="text-gray-600 font-light">
                                    R. Fernando Lopes Graça 8A<br>
                                    1600-067 Lisboa, Portugal
                                </p>
                            </div>
                        </div>

                        {{-- Telefone --}}
                        <div class="flex items-start gap-6 group">
                            <div class="p-4 bg-white border border-gray-100 shadow-sm text-brand-premium group-hover:bg-brand-primary group-hover:text-white transition-colors duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-widest text-brand-primary mb-2">Telefone</h4>
                                <a href="tel:+351917000301" class="block text-gray-600 font-light cursor-pointer hover:text-brand-cta transition">
                                    +351 917 000 301
                                </a>
                                <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-wider">
                                    Seg - Sex, 10:00 - 18:30
                                </p>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="flex items-start gap-6 group">
                            <div class="p-4 bg-white border border-gray-100 shadow-sm text-brand-premium group-hover:bg-brand-primary group-hover:text-white transition-colors duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-widest text-brand-primary mb-2">Email Corporativo</h4>
                                <a href="mailto:josecarvalho@tophousers.pt" class="block text-gray-600 font-light cursor-pointer hover:text-brand-cta transition">
                                    josecarvalho@tophousers.pt
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Mapa --}}
                <div class="w-full h-64 bg-gray-200 border border-white shadow-lg overflow-hidden grayscale hover:grayscale-0 transition duration-1000">
                    <iframe 
                        title="Localização do Atelier em Lisboa"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3111.458962657448!2d-9.166316924294065!3d38.75317797175496!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd1932d80c326087%3A0x400ebbde49036d0!2sR.%20Fernando%20Lopes-Gra%C3%A7a%208A%2C%201600-067%20Lisboa!5e0!3m2!1spt-PT!2spt!4v1700000000000!5m2!1spt-PT!2spt" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            {{-- COLUNA 2: FORMULÁRIO --}}
            <div class="bg-white p-8 md:p-12 shadow-2xl border-t-4 border-brand-premium" data-aos="fade-left">
                <h3 class="text-3xl font-didot text-brand-primary mb-8">Envie uma Mensagem</h3>
                
                @if(session('success'))
                    <div class="mb-8 p-4 bg-[#F5F4F1] border-l-4 border-brand-secondary text-brand-primary text-sm flex items-center gap-3">
                        <svg class="w-5 h-5 text-brand-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="group">
                            <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-2 group-focus-within:text-brand-primary transition-colors">Nome Completo</label>
                            <input type="text" name="name" required 
                                   class="w-full bg-gray-50 border-0 border-b border-gray-200 px-0 py-3 focus:ring-0 focus:border-brand-cta transition-colors placeholder-gray-300 text-brand-primary" 
                                   placeholder="Ex: João Silva">
                        </div>
                        <div class="group">
                            <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-2 group-focus-within:text-brand-primary transition-colors">Telemóvel</label>
                            <input type="tel" name="phone" 
                                   class="w-full bg-gray-50 border-0 border-b border-gray-200 px-0 py-3 focus:ring-0 focus:border-brand-cta transition-colors placeholder-gray-300 text-brand-primary" 
                                   placeholder="+351 917 000 301">
                        </div>
                    </div>

                    <div class="group">
                        <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-2 group-focus-within:text-brand-primary transition-colors">Email</label>
                        <input type="email" name="email" required 
                               class="w-full bg-gray-50 border-0 border-b border-gray-200 px-0 py-3 focus:ring-0 focus:border-brand-cta transition-colors placeholder-gray-300 text-brand-primary" 
                               placeholder="exemplo@email.com">
                    </div>

                    <div class="group">
                        <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-2 group-focus-within:text-brand-primary transition-colors">Motivo do Contacto</label>
                        <select aria-label="Motivo do Contacto" name="subject" class="w-full bg-gray-50 border-0 border-b border-gray-200 px-0 py-3 focus:ring-0 focus:border-brand-cta transition-colors text-brand-primary cursor-pointer">
                            <option value="Comprar Imóvel">Interesse em Comprar</option>
                            <option value="Vender Imóvel">Vender a minha Propriedade</option>
                            <option value="Investimento">Consultoria de Investimento</option>
                            <option value="Parcerias">Parcerias</option>
                            <option value="Outros">Outros Assuntos</option>
                        </select>
                    </div>

                    <div class="group">
                        <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-2 group-focus-within:text-brand-primary transition-colors">Mensagem</label>
                        <textarea name="message" rows="4" required 
                                  class="w-full bg-gray-50 border-0 border-b border-gray-200 px-0 py-3 focus:ring-0 focus:border-brand-cta transition-colors resize-none placeholder-gray-300 text-brand-primary" 
                                  placeholder="Como podemos ajudar a realizar os seus objetivos?"></textarea>
                    </div>

                    <div class="flex items-center gap-3">
                        <input type="checkbox" required class="text-brand-cta focus:ring-brand-cta border-gray-300 rounded-sm">
                        <span class="text-xs text-gray-400">Aceito a <a href="#" class="underline hover:text-brand-primary">Política de Privacidade</a>.</span>
                    </div>

                    <button type="submit" class="w-full bg-brand-primary text-white font-bold py-5 hover:bg-brand-cta transition-all duration-300 uppercase tracking-[0.2em] text-xs shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        Enviar Mensagem
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

@endsection