<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Backoffice | José Carvalho</title>

    {{-- FAVICON --}}
    <link rel="icon" href="{{ asset('public/img/favicon.png') }}" type="image/png">

    {{-- ASSETS (Vite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- FONTES --}}
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- ALPINE.JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .font-didot { font-family: 'GFS Didot', serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">

        {{-- SIDEBAR --}}
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-brand-primary text-white transition-transform duration-300 transform lg:translate-x-0 lg:static lg:inset-0 flex flex-col shadow-2xl"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            
            {{-- Logo Area --}}
            <div class="flex items-center justify-center h-24 border-b border-white/10 bg-brand-charcoal">
                <div class="text-center">
                    <h1 class="font-didot text-2xl tracking-widest text-white">JOSÉ CARVALHO</h1>
                    <p class="text-[9px] uppercase tracking-[0.3em] text-brand-premium mt-1">Private Office</p>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                
                <p class="px-4 text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2 mt-2">Geral</p>
                
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-brand-premium text-brand-primary font-bold shadow-md' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    <span>Dashboard</span>
                </a>

                <p class="px-4 text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2 mt-6">Gestão</p>

                <a href="{{ route('admin.properties.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.properties*') ? 'bg-brand-premium text-brand-primary font-bold shadow-md' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span>Imóveis</span>
                </a>

                {{-- Link para o Site Público --}}
                <div class="pt-6 mt-6 border-t border-white/10">
                    <a href="{{ route('home') }}" target="_blank" 
                       class="flex items-center gap-3 px-4 py-3 text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        <span>Ver Site Público</span>
                    </a>
                </div>
            </nav>

            {{-- User / Logout --}}
            <div class="p-4 border-t border-white/10 bg-brand-charcoal">
                <div class="flex items-center gap-3 mb-3 px-2">
                    <div class="w-8 h-8 rounded-full bg-brand-premium/20 flex items-center justify-center text-brand-premium font-bold text-xs border border-brand-premium/50">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-[10px] text-gray-400 truncate">{{ Auth::user()->email ?? '' }}</p>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-xs uppercase tracking-widest text-red-300 hover:text-red-100 hover:bg-red-900/30 rounded transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Terminar Sessão
                    </button>
                </form>
            </div>
        </aside>

        {{-- MOBILE OVERLAY --}}
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak class="fixed inset-0 z-40 bg-black/50 lg:hidden backdrop-blur-sm"></div>

        {{-- MAIN CONTENT --}}
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
            
            {{-- Mobile Header --}}
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200 lg:hidden">
                <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <span class="font-didot text-xl text-brand-primary">JOSÉ CARVALHO</span>
                <div class="w-6"></div> {{-- Spacer --}}
            </header>

            {{-- Content Area --}}
            <main class="w-full flex-grow p-6 lg:p-10">
                
                {{-- Flash Messages --}}
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
                         class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded shadow-sm flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div class="text-green-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></div>
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" 
                         class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-sm">
                        <div class="flex items-center gap-3">
                            <div class="text-red-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>