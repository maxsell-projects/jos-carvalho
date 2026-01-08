<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diogo Maia | Real Estate</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                        didot: ['GFS Didot', 'serif'],
                    },
                    colors: {
                        'brand-black': '#0a0a0a',
                        'brand-charcoal': '#1a1a1a',
                        'brand-gold': '#c5a059', 
                        'brand-gray': '#f5f5f5',
                    }
                }
            }
        }
    </script>
    
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .prose h3 { margin-top: 1.5rem; margin-bottom: 0.75rem; font-weight: 700; color: #1a1a1a; }
        .prose p { margin-bottom: 1rem; line-height: 1.6; }
        .prose ul { list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1rem; }
        .prose li { margin-bottom: 0.5rem; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="font-sans antialiased text-brand-black bg-white selection:bg-brand-gold selection:text-white"
      x-data="{ 
          showConsent: false,
          showPrivacyModal: false,
          showExitPopup: false,
          init() {
              if (!localStorage.getItem('cookie_consent')) {
                  setTimeout(() => this.showConsent = true, 1000);
              }
          },
          acceptCookies() {
              localStorage.setItem('cookie_consent', 'true');
              this.showConsent = false;
          },
          handleExitIntent(e) {
              if (e.clientY <= 0 && !sessionStorage.getItem('exit_popup_shown')) {
                  this.showExitPopup = true;
                  sessionStorage.setItem('exit_popup_shown', 'true');
              }
          }
      }"
      @mouseleave.document="handleExitIntent($event)">

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    {{-- FOOTER CORRIGIDO --}}
    <footer class="bg-brand-black text-white py-16 border-t border-white/10 relative z-10">
        <div class="container mx-auto px-6 text-center md:text-left">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                
                {{-- Coluna 1: Logo e Descrição --}}
                <div class="flex flex-col items-center md:items-start">
                    <a href="{{ route('home') }}" class="block w-48 mb-6 transition-opacity hover:opacity-80">
                        <img src="{{ asset('img/Ativo 1.png') }}" 
                             alt="Diogo Maia" 
                             class="w-full h-auto brightness-0 invert">
                    </a>

                    <p class="text-gray-500 text-sm leading-relaxed">
                        Consultoria imobiliária especializada em ativos de luxo e investimentos estratégicos em Portugal.
                    </p>
                </div>

                {{-- Coluna 2: Navegação --}}
                <div>
                    <h5 class="text-xs font-bold uppercase tracking-widest mb-6 text-brand-gold">Navegação</h5>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">Sobre</a></li>
                        <li><a href="{{ route('portfolio') }}" class="hover:text-white transition">Imóveis</a></li>
                        <li>
                            <button type="button" @click="showPrivacyModal = true" class="hover:text-white transition cursor-pointer text-left focus:outline-none">
                                Privacidade
                            </button>
                        </li>
                    </ul>
                </div>

                {{-- Coluna 3: Contato --}}
                <div>
                    <h5 class="text-xs font-bold uppercase tracking-widest mb-6 text-brand-gold">Contato</h5>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li>+351 910 739 610</li>
                        <li>dmgmaia@remax.pt</li>
                        <li>Av. Casal Ribeiro 12B</li>
                    </ul>
                </div>

                {{-- Coluna 4: Social --}}
                <div>
                    <h5 class="text-xs font-bold uppercase tracking-widest mb-6 text-brand-gold">Social</h5>
                    <div class="flex justify-center md:justify-start gap-4">
                        <a href="https://www.facebook.com/diogo.maia.161" target="_blank" class="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center hover:bg-white hover:text-brand-black hover:border-white transition-all group">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path></svg>
                        </a>
                        <a href="https://www.instagram.com/diogomaia.consultor/" target="_blank" class="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center hover:bg-white hover:text-brand-black hover:border-white transition-all group">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="https://www.tiktok.com/@diogomaia.consultor" target="_blank" class="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center hover:bg-white hover:text-brand-black hover:border-white transition-all group">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/></svg>
                        </a>
                        <a href="https://pt.linkedin.com/in/diogomaiaconsultor" target="_blank" class="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center hover:bg-white hover:text-brand-black hover:border-white transition-all group">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="mt-16 pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-600 uppercase tracking-widest">
                <p>&copy; {{ date('Y') }} Diogo Maia Real Estate. Todos os direitos reservados.</p>
                <div class="flex items-center gap-3 opacity-80 hover:opacity-100 transition-opacity">
                    <span class="text-[10px] font-light">Developed by</span>
                    <a href="https://www.maxselladvisor.com" target="_blank" class="flex items-center gap-1 group">
                        <img src="{{ asset('img/maxsell.png') }}" 
                             alt="Maxsell" 
                             class="h-5 brightness-0 invert drop-shadow-[0_0_2px_rgba(255,255,255,0.8)] transition-all duration-300 hover:drop-shadow-[0_0_5px_rgba(255,255,255,1)]">
                    </a>
                </div>
            </div>
        </div>
    </footer>

    {{-- BARRA DE AWARDS FLUTUANTE --}}
    <x-fixed-awards />

    {{-- WHATSAPP - AJUSTADO PARA MOBILE --}}
    <div class="fixed bottom-24 md:bottom-6 left-6 z-40">
        <a href="https://wa.me/351910739610" target="_blank"
           class="w-12 h-12 bg-[#25D366] text-white shadow-lg rounded-full flex items-center justify-center hover:bg-[#128C7E] transition-all duration-300 hover:scale-110"
           title="WhatsApp">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
        </a>
    </div>

    {{-- NAVEGAÇÃO / TOPO --}}
    <div class="fixed bottom-28 right-6 z-40 flex flex-col gap-3" 
         x-data="{ showTop: false }" 
         @scroll.window="showTop = (window.pageYOffset > 300)">
        
        <button @click="window.history.back()" 
                class="w-12 h-12 bg-white text-brand-black shadow-lg rounded-full flex items-center justify-center hover:bg-brand-black hover:text-brand-gold transition-all duration-300 border border-gray-100 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </button>

        <button @click="window.scrollTo({top: 0, behavior: 'smooth'})" 
                x-show="showTop" 
                x-cloak
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-4"
                class="w-12 h-12 bg-brand-gold text-white shadow-lg rounded-full flex items-center justify-center hover:bg-brand-black transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </button>
    </div>

    {{-- EXIT POPUP --}}
    <div x-show="showExitPopup" 
         x-cloak
         style="display: none;"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[70] flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
        
        <div @click.outside="showExitPopup = false" 
             class="bg-white w-full max-w-md rounded-lg shadow-2xl relative overflow-hidden text-center p-8">
            <button @click="showExitPopup = false" class="absolute top-4 right-4 text-gray-400 hover:text-brand-black transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <div class="mb-6">
                <div class="w-16 h-16 bg-brand-gold/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-brand-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-serif text-brand-black mb-2">Não vá embora com dúvidas!</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Se precisar de uma análise personalizada ou tiver dúvidas sobre algum imóvel, estou à disposição no WhatsApp.</p>
            </div>
            <a href="https://wa.me/351910739610" target="_blank" @click="showExitPopup = false"
               class="flex items-center justify-center gap-2 w-full bg-[#25D366] hover:bg-[#128C7E] text-white font-bold uppercase tracking-widest py-4 rounded-lg transition-all shadow-lg hover:scale-105">
                Contactar WhatsApp
            </a>
        </div>
    </div>

    @include('partials.privacy-consent')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 50,
        });
    </script>

    <script type="text/javascript">
      (function(d, t) {
          var v = d.createElement(t), s = d.getElementsByTagName(t)[0];
          v.onload = function() {
            window.voiceflow.chat.load({
              verify: { projectID: '67138fe9b2c68d6518611df1' },
              url: 'https://general-runtime.voiceflow.com',
              versionID: 'production',
              voice: {
                url: "https://runtime-api.voiceflow.com"
              }
            });
          }
          v.src = "https://cdn.voiceflow.com/widget-next/bundle.mjs"; v.type = "text/javascript"; s.parentNode.insertBefore(v, s);
      })(document, 'script');
    </script>
</body>
</html>