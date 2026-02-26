<footer class="bg-brand-primary text-white pt-20 pb-10 border-t border-white/10 relative z-10 text-sm">
    <div class="container mx-auto px-6">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            
            {{-- IDENTIDADE --}}
            <div class="flex flex-col items-center md:items-start">
                <a href="{{ route('home') }}" class="block font-didot text-2xl mb-6 hover:opacity-80 transition-opacity">
                    JOSÉ CARVALHO
                </a>
                <div class="text-gray-400 space-y-2 mb-6 text-center md:text-left">
                    <p>Consultoria Imobiliária de Excelência.</p>
                    <p class="text-xs text-gray-300">Investimentos Estratégicos & Ativos Premium.</p>
                </div>
                <div class="bg-white/5 p-4 rounded-lg w-full text-center md:text-left border border-white/5">
                    <p class="text-xs text-brand-premium font-bold uppercase tracking-widest mb-2">Dados Legais</p>
                    <ul class="space-y-1 text-xs text-gray-300 font-mono">
                        <li>AMI: <span class="text-white">nº 17445</span></li>
                        <li>NIF: <span class="text-white">515054259</span></li>
                    </ul>
                </div>
            </div>

            {{-- LEGAL & NAVEGAÇÃO --}}
            <div class="text-center md:text-left">
                <h5 class="text-xs font-bold uppercase tracking-widest mb-6 text-brand-premium">Informação Legal</h5>
                <ul class="space-y-3 text-gray-400">
                    <li>
                        <button @click="showPrivacyModal = true; activeTab = 'privacy'" class="hover:text-white transition text-left">
                            Política de Privacidade
                        </button>
                    </li>
                    <li>
                        <button @click="showPrivacyModal = true; activeTab = 'cookies'" class="hover:text-white transition text-left">
                            Política de Cookies
                        </button>
                    </li>
                    <li><a href="{{ route('terms') }}" class="hover:text-white transition">Termos e Condições</a></li>
                    <li><a href="https://www.cniacc.pt/pt/" target="_blank" class="hover:text-white transition">Resolução de Litígios (RAL)</a></li>
                </ul>
            </div>

            {{-- CONTACTOS & HORÁRIO --}}
            <div class="text-center md:text-left">
                <h5 class="text-xs font-bold uppercase tracking-widest mb-6 text-brand-premium">Contactos</h5>
                <div class="space-y-6">
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex flex-col md:block">
                            <span class="text-xs uppercase text-gray-400 block mb-1">Atelier</span>
                            <span>R. Fernando Lopes Graça 8A<br>1600-067 Lisboa</span>
                            <span class="block mt-2">Av. Cidade de Hayward 6<br>8000-170 Faro</span>
                        </li>
                        <li class="flex flex-col md:block">
                            <span class="text-xs uppercase text-gray-400 block mb-1">Telefone</span>
                            <a href="tel:+351917000301" class="hover:text-white transition">+351 917 000 301</a>
                        </li>
                        <li class="flex flex-col md:block">
                            <span class="text-xs uppercase text-gray-400 block mb-1">Email</span>
                            <a href="mailto:josecarvalho@tophousers.pt" class="hover:text-white transition">josecarvalho@tophousers.pt</a>
                        </li>
                        {{-- Horário --}}
                        <li class="flex flex-col md:block pt-2 border-t border-white/5">
                            <span class="text-xs uppercase text-gray-400 block mb-1">Horário de Atendimento</span>
                            <span>10h00 - 18h30</span>
                            <span class="block text-xs text-brand-premium mt-1 italic">(Fechado Sáb. e Dom.)</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- SOCIAL & LIVRO --}}
            <div class="flex flex-col items-center md:items-start justify-between">
                <div>
                    <h5 class="text-xs font-bold uppercase tracking-widest mb-6 text-brand-premium text-center md:text-left">Redes Sociais</h5>
                    <div class="flex gap-4 mb-8">
                        {{-- Instagram --}}
                        <a aria-label="Siga-nos no Instagram" href="https://www.instagram.com/josecarvalhotophousers/" target="_blank" rel="noopener noreferrer" class="w-10 h-10 border border-white/20 flex items-center justify-center hover:bg-brand-premium hover:text-brand-primary hover:border-brand-premium transition-all duration-300 rounded-full group">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        {{-- Facebook --}}
                        <a aria-label="Siga-nos no Facebook" href="https://www.facebook.com/profile.php?id=100077207780775" target="_blank" rel="noopener noreferrer" class="w-10 h-10 border border-white/20 flex items-center justify-center hover:bg-brand-premium hover:text-brand-primary hover:border-brand-premium transition-all duration-300 rounded-full group">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                        </a>
                        {{-- LinkedIn --}}
                        <a aria-label="Siga-nos no LinkedIn" href="https://www.linkedin.com/in/jos%C3%A9-carvalho-92798227b/" target="_blank" rel="noopener noreferrer" class="w-10 h-10 border border-white/20 flex items-center justify-center hover:bg-brand-premium hover:text-brand-primary hover:border-brand-premium transition-all duration-300 rounded-full group">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z"/></svg>
                        </a>
                    </div>
                </div>

                <div class="mt-2">
                    <a href="https://www.livroreclamacoes.pt" target="_blank" class="text-[10px] uppercase tracking-widest text-gray-400 hover:text-white border-b border-gray-600 hover:border-white pb-1 transition-all">
                        Livro de Reclamações Eletrónico
                    </a>
                </div>
            </div>
        </div>

        {{-- COPYRIGHT & CREDITS (MAXSELL) --}}
        <div class="mt-12 pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-500 uppercase tracking-widest">
            <p>&copy; {{ date('Y') }} José Carvalho Real Estate.</p>
            
            <div class="flex items-center gap-3 opacity-80 hover:opacity-100 transition-opacity">
                <span class="font-light text-[10px]">Desenvolvido por</span>
                <a href="https://www.maxselladvisor.com" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 group">
                    <img width="223" height="42" src="{{ asset('img/maxsell.png') }}" alt="Maxsell Advisor" class="h-6 w-auto grayscale group-hover:grayscale-0 transition-all duration-500">
                </a>
            </div>
        </div>
    </div>
</footer>