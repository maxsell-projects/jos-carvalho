<div x-show="showConsent" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-700"
     x-transition:enter-start="translate-y-full opacity-0"
     x-transition:enter-end="translate-y-0 opacity-100"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="translate-y-0 opacity-100"
     x-transition:leave-end="translate-y-full opacity-0"
     class="fixed bottom-0 left-0 w-full z-50 bg-brand-charcoal/95 backdrop-blur-md border-t border-white/10 p-6 md:p-8 shadow-2xl">
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="text-center md:text-left">
            <p class="text-sm text-gray-300 leading-relaxed">
                Utilizamos cookies para melhorar a sua experiência. Ao continuar a navegar, aceita a nossa 
                <button @click="showPrivacyModal = true" class="text-brand-gold hover:text-white underline decoration-brand-gold/50 hover:decoration-white transition-all">Política de Privacidade e Cookies</button>.
            </p>
        </div>
        <div class="flex gap-4">
            <button @click="acceptCookies()" class="px-8 py-3 bg-brand-gold text-white text-xs font-bold uppercase tracking-widest hover:bg-white hover:text-brand-black transition-all duration-300 rounded-sm whitespace-nowrap">
                Aceitar
            </button>
        </div>
    </div>
</div>

<div x-show="showPrivacyModal" 
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
    
    <div @click.outside="showPrivacyModal = false" 
         class="bg-white w-full max-w-5xl max-h-[85vh] flex flex-col rounded shadow-2xl relative overflow-hidden"
         x-data="{ activeTab: 'privacy' }">
        
        <div class="bg-gray-50 border-b border-gray-200 px-8 pt-8 pb-0 flex-none">
            <div class="flex justify-between items-start mb-6">
                <h2 class="text-2xl font-didot text-brand-black">Políticas e Privacidade</h2>
                <button @click="showPrivacyModal = false" class="text-gray-400 hover:text-brand-black transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            
            <div class="flex space-x-8">
                <button @click="activeTab = 'privacy'" 
                        :class="activeTab === 'privacy' ? 'border-brand-gold text-brand-black' : 'border-transparent text-gray-500 hover:text-gray-700'"
                        class="pb-4 border-b-2 text-xs font-bold uppercase tracking-widest transition-colors duration-300">
                    Política de Privacidade
                </button>
                <button @click="activeTab = 'cookies'" 
                        :class="activeTab === 'cookies' ? 'border-brand-gold text-brand-black' : 'border-transparent text-gray-500 hover:text-gray-700'"
                        class="pb-4 border-b-2 text-xs font-bold uppercase tracking-widest transition-colors duration-300">
                    Política de Cookies
                </button>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto p-8 md:p-12 bg-white">
            
            <div x-show="activeTab === 'privacy'" class="prose prose-sm max-w-none text-gray-600">
                <p>A <strong>Diogo Maia | Real Estate</strong>, com sede na Av. Casal Ribeiro 12B, Lisboa, Portugal<strong></strong> é a proprietária do domínio <strong>https://diogomaia.duckdns.org</strong>, onde se encontra alojado o seu WEBSITE.</p>
                <p>ESTAMOS EMPENHADOS EM PROTEGER A PRIVACIDADE E OS DADOS PESSOAIS DOS NOSSOS CLIENTES E UTILIZADORES, PELO QUE ELABORÁMOS E ADOTÁMOS A PRESENTE POLÍTICA.</p>
                
                <h3>1. DO QUE TRATA ESTA POLÍTICA?</h3>
                <p>1.1. Esta Política de Privacidade explica como recolhemos e tratamos os dados pessoais necessários para o fornecimento de serviços disponíveis através do WEBSITE (ex: subscrição de newsletters, formulários de contacto, candidaturas).</p>
                
                <h3>2. O QUE SÃO DADOS PESSOAIS?</h3>
                <p>2.1. Dados pessoais são todas as informações relativas a uma pessoa que a identificam ou tornam identificável (ex: nome, e-mail, telefone).</p>
                
                <h3>3. COMO UTILIZAMOS OS SEUS DADOS?</h3>
                <p>3.1. Utilizamos os dados para:</p>
                <ul>
                    <li>Analisar e responder a mensagens e pedidos de informação;</li>
                    <li>Processos de compra, venda ou arrendamento de imóveis;</li>
                    <li>Envio de newsletters (se solicitado);</li>
                    <li>Gestão do website e prevenção de fraudes.</li>
                </ul>

                <h3>4. FUNDAMENTOS PARA TRATAMENTO</h3>
                <div class="overflow-x-auto my-4 border border-gray-200 rounded">
                    <table class="min-w-full text-xs text-left">
                        <thead class="bg-gray-50 font-bold text-brand-black">
                            <tr><th class="p-3 border-b">Finalidade</th><th class="p-3 border-b">Fundamento</th><th class="p-3 border-b">Dados</th></tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr><td class="p-3">Resposta a contactos</td><td class="p-3">Consentimento</td><td class="p-3">Nome, telefone, email</td></tr>
                            <tr><td class="p-3">Newsletters</td><td class="p-3">Consentimento</td><td class="p-3">Email</td></tr>
                            <tr><td class="p-3">Gestão do site</td><td class="p-3">Interesse legítimo / Cookies</td><td class="p-3">IP, Cookies</td></tr>
                        </tbody>
                    </table>
                </div>

                <h3>5. RECOLHA DE DADOS</h3>
                <p>Recolhemos dados através de formulários no site, e-mails enviados e navegação (cookies/IP). Não vendemos nem partilhamos os seus dados com terceiros para fins comerciais sem consentimento.</p>

                <h3>7. SEGURANÇA</h3>
                <p>7.3. Os dados são mantidos em servidores seguros. <strong></strong>Que oferece garantias de segurança adequadas.</p>
                <p>7.4. Utilizamos protocolo HTTPS (encriptação) para proteger a comunicação.</p>

                <h3>8. SEUS DIREITOS</h3>
                <p>Pode exercer os seus direitos de acesso, retificação, apagamento ou oposição contactando-nos através do e-mail: <strong>dmgmaia@remax.pt</strong>.</p>

                <h3>15. CONTACTO</h3>
                <p>Para dúvidas sobre esta política, contacte: <strong>dmgmaia@remax.pt</strong>.</p>
            </div>

            <div x-show="activeTab === 'cookies'" style="display: none;" class="prose prose-sm max-w-none text-gray-600">
                <h3>1. O que são cookies?</h3>
                <p>“Cookies” são pequenas etiquetas de software armazenadas no seu navegador, retendo apenas informação relacionada com preferências, não incluindo dados pessoais diretos.</p>

                <h3>2. Para que servem?</h3>
                <p>Servem para ajudar a determinar a utilidade, interesse e número de utilizações dos websites, permitindo uma navegação mais rápida e eficiente.</p>

                <h3>3. Tipos de cookies utilizados</h3>
                <ul>
                    <li><strong>Cookies permanentes:</strong> Armazenados no navegador, usados sempre que faz uma nova visita para personalizar o serviço.</li>
                    <li><strong>Cookies de sessão:</strong> Temporários, permanecem apenas até sair do website. Servem para analisar tráfego e identificar problemas.</li>
                </ul>

                <h3>4. Validade</h3>
                <p>Podem ser de sessão (apagados ao fechar o browser) ou persistentes (permanecem até expirarem ou serem apagados manualmente).</p>

                <h3>5. Localização dos dados</h3>
                <p>As informações podem ser processadas pela equipa interna ou por parceiros tecnológicos, sempre garantindo a segurança e proteção dos dados.</p>

                <h3>6. Gestão de Cookies</h3>
                <p>Pode alterar as preferências de cookies nas definições do seu navegador a qualquer momento.</p>

                <h3>7. Categorias de Cookies</h3>
                <ul>
                    <li><strong>7.1. Estritamente necessários:</strong> Essenciais para navegar e aceder a áreas seguras.</li>
                    <li><strong>7.2. Analíticos:</strong> Criação e análise de estatísticas anónimas.</li>
                    <li><strong>7.3. Funcionalidade:</strong> Guardam preferências do utilizador.</li>
                    <li><strong>7.4. Terceiros/Publicidade:</strong> Medem eficácia de publicidade e direcionam anúncios conforme interesses.</li>
                </ul>
                
                <p class="text-xs mt-4">Para mais informações gerais, visite <a href="https://allaboutcookies.org" target="_blank" class="text-brand-gold hover:underline">allaboutcookies.org</a>.</p>
            </div>

        </div>

        <div class="bg-gray-50 border-t border-gray-200 p-6 flex justify-end flex-none">
            <button @click="showPrivacyModal = false; acceptCookies()" class="px-8 py-3 bg-brand-black text-white text-xs font-bold uppercase tracking-widest hover:bg-brand-gold transition-all duration-300 rounded-sm shadow-lg">
                Entendi e Aceito
            </button>
        </div>
    </div>
</div>