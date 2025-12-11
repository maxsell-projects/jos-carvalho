<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diogo Maia | Real Estate</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
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
    </style>
</head>
<body class="font-sans antialiased text-brand-black bg-white selection:bg-brand-gold selection:text-white">

    <nav class="fixed w-full z-50 transition-all duration-500 ease-in-out" 
         x-data="{ isOpen: false, isScrolled: false }"
         @scroll.window="isScrolled = (window.pageYOffset > 50)"
         :class="isScrolled ? 'bg-black/95 backdrop-blur-md border-b border-white/10 py-4 shadow-lg' : 'bg-transparent border-b border-transparent py-8'">
         
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center">
                
                <a href="{{ route('home') }}" class="text-2xl font-serif text-white tracking-widest hover:text-brand-gold transition-colors">
                    DIOGO MAIA
                </a>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-xs uppercase tracking-[0.2em] text-white hover:text-brand-gold transition-colors {{ request()->routeIs('home') ? 'text-brand-gold' : '' }}">Home</a>
                    <a href="{{ route('about') }}" class="text-xs uppercase tracking-[0.2em] text-white hover:text-brand-gold transition-colors {{ request()->routeIs('about') ? 'text-brand-gold' : '' }}">Sobre</a>
                    <a href="{{ route('portfolio') }}" class="text-xs uppercase tracking-[0.2em] text-white hover:text-brand-gold transition-colors {{ request()->routeIs('portfolio') ? 'text-brand-gold' : '' }}">Imóveis</a>
                    
                    <div class="relative group">
                        <button class="text-xs uppercase tracking-[0.2em] text-white group-hover:text-brand-gold transition-colors flex items-center gap-1 focus:outline-none py-2">
                            Ferramentas
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 transition-transform duration-300 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="absolute left-1/2 -translate-x-1/2 top-full mt-0 w-56 bg-brand-charcoal border border-white/10 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top pt-2">
                            <div class="bg-brand-charcoal py-2">
                                <a href="{{ route('tools.credit') }}" class="block px-6 py-3 text-[10px] uppercase tracking-widest text-gray-300 hover:text-white hover:bg-white/5 transition-colors">Simulador de Crédito</a>
                                <a href="{{ route('tools.gains') }}" class="block px-6 py-3 text-[10px] uppercase tracking-widest text-gray-300 hover:text-white hover:bg-white/5 transition-colors">Simulador Mais Valias</a>
                                <a href="{{ route('tools.imt') }}" class="block px-6 py-3 text-[10px] uppercase tracking-widest text-gray-300 hover:text-white hover:bg-white/5 transition-colors">Simulador IMT</a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('blog') }}" class="text-xs uppercase tracking-[0.2em] text-white hover:text-brand-gold transition-colors {{ request()->routeIs('blog') ? 'text-brand-gold' : '' }}">Blog</a>
                    
                    <a href="{{ route('contact') }}" class="px-6 py-3 border border-brand-gold text-brand-gold text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-brand-gold hover:text-white transition-all duration-300 rounded-sm">
                        Contacte-me
                    </a>
                </div>

                <button @click="isOpen = !isOpen" class="md:hidden text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="isOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div x-show="isOpen" x-cloak 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-4"
                 class="md:hidden mt-4 pb-4 space-y-4 border-t border-white/10 pt-4 bg-black/95 absolute left-0 w-full px-6 shadow-xl h-screen overflow-y-auto">
                
                <a href="{{ route('home') }}" class="block text-white text-sm uppercase tracking-widest hover:text-brand-gold">Home</a>
                <a href="{{ route('about') }}" class="block text-white text-sm uppercase tracking-widest hover:text-brand-gold">Sobre</a>
                <a href="{{ route('portfolio') }}" class="block text-white text-sm uppercase tracking-widest hover:text-brand-gold">Imóveis</a>
                
                <div x-data="{ openTools: false }" class="border-l border-white/10 pl-4">
                    <button @click="openTools = !openTools" class="flex items-center justify-between w-full text-white text-sm uppercase tracking-widest hover:text-brand-gold">
                        Ferramentas
                        <svg class="w-3 h-3" :class="openTools ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div x-show="openTools" x-collapse class="mt-3 space-y-3">
                        <a href="{{ route('tools.credit') }}" class="block text-gray-400 text-xs uppercase tracking-widest hover:text-white">Simulador Crédito</a>
                        <a href="{{ route('tools.gains') }}" class="block text-gray-400 text-xs uppercase tracking-widest hover:text-white">Mais Valias</a>
                        <a href="{{ route('tools.imt') }}" class="block text-gray-400 text-xs uppercase tracking-widest hover:text-white">Simulador IMT</a>
                    </div>
                </div>

                <a href="{{ route('blog') }}" class="block text-white text-sm uppercase tracking-widest hover:text-brand-gold">Blog</a>
                <a href="{{ route('contact') }}" class="block text-brand-gold text-sm uppercase tracking-widest font-bold">Contacte-me</a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-brand-black text-white py-16 border-t border-white/10">
        <div class="container mx-auto px-6 text-center md:text-left">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div>
                    <h4 class="text-2xl font-serif mb-6">DIOGO MAIA</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Consultoria imobiliária especializada em ativos de luxo e investimentos estratégicos em Portugal.
                    </p>
                </div>
                <div>
                    <h5 class="text-xs font-bold uppercase tracking-widest mb-6 text-brand-gold">Navegação</h5>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">Sobre</a></li>
                        <li><a href="{{ route('portfolio') }}" class="hover:text-white transition">Imóveis</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-xs font-bold uppercase tracking-widest mb-6 text-brand-gold">Contato</h5>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li>+351 912 345 678</li>
                        <li>contacto@diogomaia.pt</li>
                        <li>Lisboa, Portugal</li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-xs font-bold uppercase tracking-widest mb-6 text-brand-gold">Social</h5>
                    <div class="flex justify-center md:justify-start gap-4">
                        <a href="#" class="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center hover:bg-white hover:text-black transition-all">IN</a>
                        <a href="#" class="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center hover:bg-white hover:text-black transition-all">IG</a>
                    </div>
                </div>
            </div>
            <div class="mt-16 pt-8 border-t border-white/10 text-center text-xs text-gray-600 uppercase tracking-widest">
                &copy; 2025 Diogo Maia Real Estate. Todos os direitos reservados.
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 50,
        });
    </script>
</body>
</html>