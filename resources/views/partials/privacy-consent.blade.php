{{-- BARRA DE CONSENTIMENTO (FIXA NO RODAPÉ) --}}
<div x-show="showConsent" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-700"
     x-transition:enter-start="translate-y-full opacity-0"
     x-transition:enter-end="translate-y-0 opacity-100"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="translate-y-0 opacity-100"
     x-transition:leave-end="translate-y-full opacity-0"
     class="fixed bottom-0 left-0 w-full z-[100] bg-brand-primary/95 backdrop-blur-md border-t border-white/10 p-6 pb-12 md:p-8 shadow-2xl">
    
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="text-center md:text-left">
            <p class="text-sm text-gray-300 leading-relaxed font-light">
                Utilizamos cookies para personalizar a sua experiência exclusiva. Ao continuar a navegar, aceita a nossa 
                <button @click.prevent="showPrivacyModal = true" class="text-brand-premium hover:text-white underline decoration-brand-premium/50 hover:decoration-white transition-all cursor-pointer">Política de Privacidade, Cookies e Litígios</button>.
            </p>
        </div>
        <div class="flex gap-4 w-full md:w-auto justify-center md:justify-end">
            <button @click="acceptCookies()" class="w-full md:w-auto px-8 py-4 md:py-3 bg-brand-premium text-brand-primary text-xs font-bold uppercase tracking-widest hover:bg-white transition-all duration-300 rounded-sm whitespace-nowrap shadow-lg cursor-pointer active:scale-95">
                Aceitar
            </button>
        </div>
    </div>
</div>

{{-- MODAL DE POLÍTICA DE PRIVACIDADE --}}
<div x-show="showPrivacyModal" 
     style="display: none;"
     x-cloak
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-brand-primary/90 backdrop-blur-sm">
    
    <div @click.outside="showPrivacyModal = false" 
         class="bg-white w-full max-w-5xl max-h-[85vh] flex flex-col rounded shadow-2xl relative overflow-hidden border-t-4 border-brand-premium"
         x-data="{ activeTab: 'privacy' }">
        
        {{-- Header do Modal --}}
        <div class="bg-gray-50 border-b border-gray-200 px-8 pt-8 pb-0 flex-none">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-didot text-brand-primary">Legal & Privacidade</h2>
                    <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">José Carvalho Real Estate</p>
                </div>
                <button @click="showPrivacyModal = false" class="text-gray-400 hover:text-brand-cta transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            
            <div class="flex space-x-8 overflow-x-auto scrollbar-hide">
                <button @click="activeTab = 'privacy'" 
                        :class="activeTab === 'privacy' ? 'border-brand-premium text-brand-primary' : 'border-transparent text-gray-400 hover:text-gray-600'"
                        class="pb-4 border-b-2 text-xs font-bold uppercase tracking-widest transition-colors duration-300 whitespace-nowrap">
                    Política de Privacidade
                </button>
                <button @click="activeTab = 'cookies'" 
                        :class="activeTab === 'cookies' ? 'border-brand-premium text-brand-primary' : 'border-transparent text-gray-400 hover:text-gray-600'"
                        class="pb-4 border-b-2 text-xs font-bold uppercase tracking-widest transition-colors duration-300 whitespace-nowrap">
                    Política de Cookies
                </button>
                <button @click="activeTab = 'ral'" 
                        :class="activeTab === 'ral' ? 'border-brand-premium text-brand-primary' : 'border-transparent text-gray-400 hover:text-gray-600'"
                        class="pb-4 border-b-2 text-xs font-bold uppercase tracking-widest transition-colors duration-300 whitespace-nowrap">
                    Resolução de Litígios (RAL)
                </button>
            </div>
        </div>

        {{-- Conteúdo (Scrollable) --}}
        <div class="flex-1 overflow-y-auto p-8 md:p-12 bg-white scrollbar-hide">
            
            {{-- TAB: PRIVACIDADE --}}
            <div x-show="activeTab === 'privacy'" class="prose prose-sm max-w-none text-gray-600 font-light text-justify">
                <p>A <strong>José Carvalho</strong>, com escritório na <strong>R. Fernando Lopes Graça 8A, 1600-067 Lisboa, Portugal</strong>, é a entidade responsável pelo domínio <strong>josecarvalho.pt</strong>, onde se encontra alojado este WEBSITE.</p>
                <p>ESTAMOS EMPENHADOS EM PROTEGER A PRIVACIDADE E OS DADOS PESSOAIS DOS NOSSOS CLIENTES E UTILIZADORES, PELO QUE ELABORÁMOS E ADOTÁMOS A PRESENTE POLÍTICA, EM CONFORMIDADE COM O RGPD.</p>
                
                <h3 class="text-brand-primary font-bold mt-6 mb-2">1. ÂMBITO DE APLICAÇÃO</h3>
                <p>1.1. Esta Política de Privacidade explica como recolhemos e tratamos os dados pessoais necessários para o fornecimento de serviços de consultoria imobiliária de luxo disponíveis através do WEBSITE.</p>
                
                <h3 class="text-brand-primary font-bold mt-6 mb-2">2. DADOS PESSOAIS</h3>
                <p>2.1. Dados pessoais são todas as informações relativas a uma pessoa que a identificam ou tornam identificável (ex: nome, e-mail, telefone, preferências de investimento).</p>
                
                <h3 class="text-brand-primary font-bold mt-6 mb-2">3. FINALIDADES DO TRATAMENTO</h3>
                <p>3.1. Utilizamos os dados para:</p>
                <ul class="list-disc pl-5 space-y-1">
                    <li>Gestão de pedidos de contacto e agendamento de reuniões;</li>
                    <li>Processos de mediação imobiliária (compra, venda ou arrendamento);</li>
                    <li>Cumprimento de obrigações legais (ex: identificação de beneficiários efetivos);</li>
                    <li>Envio de oportunidades exclusivas (apenas com consentimento explícito).</li>
                </ul>

                <h3 class="text-brand-primary font-bold mt-6 mb-2">4. LEGITIMIDADE</h3>
                <div class="overflow-x-auto my-4 border border-gray-100 rounded">
                    <table class="min-w-full text-xs text-left">
                        <thead class="bg-brand-primary text-white">
                            <tr><th class="p-3 border-b border-white/10">Finalidade</th><th class="p-3 border-b border-white/10">Fundamento</th><th class="p-3 border-b border-white/10">Dados</th></tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr><td class="p-3">Resposta a contactos</td><td class="p-3">Diligências pré-contratuais</td><td class="p-3">Nome, telefone, email</td></tr>
                            <tr><td class="p-3">Marketing / Newsletter</td><td class="p-3">Consentimento</td><td class="p-3">Email</td></tr>
                            <tr><td class="p-3">Segurança do Site</td><td class="p-3">Interesse legítimo</td><td class="p-3">IP, Logs</td></tr>
                        </tbody>
                    </table>
                </div>

                <h3 class="text-brand-primary font-bold mt-6 mb-2">5. PARTILHA DE DADOS</h3>
                <p>Não vendemos os seus dados. Apenas partilhamos informação com terceiros estritamente necessários à prestação do serviço (ex: advogados, solicitadores, instituições bancárias) e sempre com o seu conhecimento.</p>

                <h3 class="text-brand-primary font-bold mt-6 mb-2">6. SEGURANÇA</h3>
                <p>Implementamos medidas técnicas e organizativas rigorosas (protocolo HTTPS, servidores seguros, controlo de acessos) para proteger os seus dados contra perda, uso indevido ou alteração.</p>

                <h3 class="text-brand-primary font-bold mt-6 mb-2">7. DIREITOS DO TITULAR</h3>
                <p>Pode exercer os seus direitos de acesso, retificação, esquecimento, limitação ou oposição contactando-nos diretamente através do e-mail oficial: <strong>josecarvalho@tophousers.pt</strong>.</p>
            </div>

            {{-- TAB: COOKIES --}}
            <div x-show="activeTab === 'cookies'" style="display: none;" class="prose prose-sm max-w-none text-gray-600 font-light text-justify">
                <h3 class="text-brand-primary font-bold mt-0 mb-2">1. O que são cookies?</h3>
                <p>“Cookies” são pequenas etiquetas de software armazenadas no seu navegador, retendo apenas informação relacionada com preferências e navegação, não incluindo dados pessoais sensíveis.</p>

                <h3 class="text-brand-primary font-bold mt-6 mb-2">2. Utilidade</h3>
                <p>Servem para otimizar a sua navegação, permitindo que o website reconheça o seu dispositivo e melhore a experiência de utilizador (ex: não precisar de introduzir dados repetidamente).</p>

                <h3 class="text-brand-primary font-bold mt-6 mb-2">3. Tipologia</h3>
                <ul class="list-disc pl-5 space-y-1">
                    <li><strong>Estritamente necessários:</strong> Essenciais para a segurança e funcionamento básico do site.</li>
                    <li><strong>Analíticos:</strong> Utilizamos para entender como os utilizadores interagem com o site (dados anónimos via Google Analytics).</li>
                    <li><strong>Funcionalidade:</strong> Guardam as suas preferências de idioma ou visualização.</li>
                </ul>

                <h3 class="text-brand-primary font-bold mt-6 mb-2">4. Gestão</h3>
                <p>Pode, a qualquer momento, desativar os cookies nas definições do seu navegador (browser), embora isso possa afetar o funcionamento correto de algumas ferramentas do site.</p>
                
                <p class="text-xs mt-6 pt-4 border-t border-gray-100">Para mais informações técnicas, consulte <a href="https://allaboutcookies.org" target="_blank" class="text-brand-premium hover:underline">allaboutcookies.org</a>.</p>
            </div>

            {{-- TAB: RAL (RESOLUÇÃO DE LITÍGIOS) --}}
            <div x-show="activeTab === 'ral'" style="display: none;" class="prose prose-sm max-w-none text-gray-600 font-light text-justify">
                <h3 class="text-brand-primary font-bold mt-0 mb-2">Resolução Alternativa de Litígios (RAL)</h3>
                
                <p>Nos termos e em cumprimento do disposto na Lei n.º 144/2015, de 08.09, a <strong>José Carvalho</strong> disponibiliza a informação necessária para que o cliente consumidor possa exercer o seu direito de reclamação junto de uma entidade oficial, terceira e imparcial que o ajudará a resolver o litígio em questão.</p>
                
                <p>A resolução alternativa de litígios é a possibilidade que todos os consumidores têm ao seu dispor de recorrer a entidades oficiais que os ajudem na resolução ou orientação, de algum conflito, antes de abrirem processos litigiosos nos Tribunais.</p>
                
                <p>Em regra, o procedimento pode descrever-se conforme segue:</p>
                <ol class="list-decimal pl-5 space-y-1">
                    <li>O cliente consumidor pede a um terceiro imparcial que intervenha como intermediário entre si e o fornecedor ou prestador de serviços que é o alvo da sua reclamação.</li>
                    <li>O intermediário pode sugerir uma solução para a sua reclamação, impor uma solução a ambas as partes ou reunir as partes para encontrar uma solução.</li>
                </ol>
                
                <p>A resolução alternativa de litígios pode traduzir-se em "mediação", "conciliação" ou "arbitragem". A resolução alternativa de litígios é, por norma, menos dispendiosa, menos formal e mais rápida do que a via judicial.</p>
                
                <p>Assim, em caso de litígio, o cliente consumidor pode recorrer a uma Entidade de Resolução Alternativa de Litígios de consumo:</p>
                
                <div class="bg-gray-50 border border-gray-200 p-6 rounded-lg mt-4">
                    <p class="font-bold text-brand-primary mb-1">CNIACC - Centro Nacional de Informação e Arbitragem de Conflitos de Consumo</p>
                    <p class="text-xs text-gray-500 mb-4">Entidade de competência genérica</p>
                    
                    <ul class="text-sm space-y-2">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-brand-premium" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                            <a href="https://www.cniacc.pt" target="_blank" class="hover:text-brand-cta underline">www.cniacc.pt</a>
                        </li>
                    </ul>
                </div>
                
                <p class="text-xs mt-4 italic">Para mais informações consulte o Portal do Consumidor em <a href="https://www.consumidor.gov.pt" target="_blank" class="hover:text-brand-primary underline">www.consumidor.gov.pt</a>.</p>
            </div>

        </div>

        {{-- Footer do Modal --}}
        <div class="bg-gray-50 border-t border-gray-200 p-6 flex justify-end flex-none">
            <button @click="showPrivacyModal = false; acceptCookies()" class="px-8 py-3 bg-brand-primary text-white text-xs font-bold uppercase tracking-widest hover:bg-brand-cta transition-all duration-300 rounded-sm shadow-lg">
                Compreendo e Aceito
            </button>
        </div>
    </div>
</div>