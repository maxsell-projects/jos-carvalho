<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Private Office | José Carvalho</title>
    <link rel="icon" href="{{ asset('public/img/favicon.png') }}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body class="font-sans antialiased text-white bg-brand-primary h-screen flex items-center justify-center relative overflow-hidden selection:bg-brand-premium selection:text-white">

    <div class="absolute inset-0 z-0">
        <img src="{{ asset('img/porto_dark.jpeg') }}" class="w-full h-full object-cover opacity-20">
        <div class="absolute inset-0 bg-gradient-to-b from-brand-primary/50 to-brand-primary"></div>
    </div>

    <div class="w-full max-w-md relative z-10 p-10 border-t-4 border-brand-premium bg-white/5 backdrop-blur-xl shadow-2xl">
        <div class="text-center mb-10">
            <h1 class="font-didot text-4xl mb-2 text-white">JOSÉ CARVALHO</h1>
            <p class="font-mono text-[10px] uppercase tracking-[0.4em] text-brand-premium">Private Office Access</p>
        </div>

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="group">
                <label for="email" class="block text-[10px] uppercase tracking-widest text-gray-400 mb-2 group-focus-within:text-brand-premium transition-colors">Email Corporativo</label>
                <input type="email" name="email" id="email" required autofocus
                       class="w-full bg-white/5 border border-white/10 px-4 py-3 text-white text-sm focus:outline-none focus:border-brand-premium focus:bg-white/10 transition-all placeholder-white/20"
                       placeholder="seuemail@aqui.com">
                @error('email')
                    <span class="text-red-400 text-xs mt-2 block font-light flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="group">
                <label for="password" class="block text-[10px] uppercase tracking-widest text-gray-400 mb-2 group-focus-within:text-brand-premium transition-colors">Palavra-passe</label>
                <input type="password" name="password" id="password" required
                       class="w-full bg-white/5 border border-white/10 px-4 py-3 text-white text-sm focus:outline-none focus:border-brand-premium focus:bg-white/10 transition-all placeholder-white/20">
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="checkbox" name="remember" class="appearance-none w-4 h-4 border border-white/20 bg-transparent checked:bg-brand-premium checked:border-brand-premium transition-all relative cursor-pointer">
                    <span class="text-xs text-gray-400 group-hover:text-white transition-colors">Memorizar sessão</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-brand-premium text-brand-primary font-bold py-4 uppercase tracking-widest text-xs hover:bg-white transition-all duration-300 shadow-lg mt-4">
                Iniciar Sessão
            </button>
        </form>

        <div class="mt-10 text-center border-t border-white/5 pt-6">
            <a href="{{ route('home') }}" class="text-[10px] text-gray-500 hover:text-white transition-colors uppercase tracking-widest flex items-center justify-center gap-2 group">
                <span class="transform group-hover:-translate-x-1 transition-transform">←</span> Voltar ao Site
            </a>
        </div>
    </div>

</body>
</html>