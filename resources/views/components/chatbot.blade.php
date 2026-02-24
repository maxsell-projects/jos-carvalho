<div x-data="chatbot()" x-init="initBot()" 
     class="fixed z-[60] flex flex-col items-end print:hidden
            bottom-4 right-4 left-4 md:left-auto md:bottom-6 md:right-6">
    
    {{-- JANELA DO CHAT --}}
    <div x-show="open" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 scale-95"
         {{-- Largura Responsiva: Full no mobile, fixa no desktop --}}
         class="mb-4 w-full md:w-[380px] h-[70vh] md:h-[550px] bg-white rounded-2xl shadow-2xl border border-gray-200 flex flex-col overflow-hidden font-sans">
        
        {{-- HEADER --}}
        <div class="bg-brand-primary p-4 text-white flex justify-between items-center shadow-md relative overflow-hidden flex-shrink-0">
            <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="flex items-center gap-3 relative z-10">
                <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse shadow-[0_0_8px_rgba(74,222,128,0.8)]"></div>
                <div>
                    <h3 class="font-didot text-sm tracking-widest uppercase">José Carvalho</h3>
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider">Private Assistant AI</p>
                </div>
            </div>
            <button @click="open = false" class="p-2 hover:bg-white/10 rounded-full transition relative z-10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
        </div>

        {{-- AREA DE MENSAGENS --}}
        <div id="chat-messages" class="flex-1 p-4 overflow-y-auto bg-[#F5F7FA] space-y-4 scroll-smooth scrollbar-hide">
            <template x-for="(msg, index) in messages" :key="index">
                <div :class="msg.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                    <div :class="msg.role === 'user' 
                        ? 'bg-brand-primary text-white rounded-br-none shadow-md' 
                        : 'bg-white border border-gray-100 text-gray-700 rounded-bl-none shadow-sm'"
                        class="max-w-[85%] rounded-2xl px-4 py-3 text-sm leading-relaxed relative">
                        
                        <p x-html="msg.content"></p>
                        
                        {{-- CARDS DE IMÓVEIS --}}
                        <template x-if="msg.data && msg.data.length > 0">
                            <div class="mt-3 space-y-2">
                                <template x-for="prop in msg.data">
                                    <a :href="prop.link" target="_blank" class="block bg-white hover:bg-gray-50 border border-gray-200 rounded-lg p-2 flex gap-3 transition group">
                                        <img :src="prop.image" class="w-16 h-12 object-cover rounded-sm grayscale group-hover:grayscale-0 transition-all">
                                        <div class="flex-1 min-w-0 flex flex-col justify-center">
                                            <p class="text-[10px] font-bold text-brand-primary truncate uppercase tracking-wider" x-text="prop.title"></p>
                                            <p class="text-xs text-brand-premium font-serif italic" x-text="prop.price"></p>
                                        </div>
                                    </a>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
            
            {{-- LOADING INDICATOR --}}
            <div x-show="isLoading" class="flex justify-start">
                <div class="bg-white border border-gray-100 rounded-2xl rounded-bl-none px-4 py-3 flex gap-1 shadow-sm">
                    <div class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce"></div>
                    <div class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce delay-75"></div>
                    <div class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce delay-150"></div>
                </div>
            </div>
        </div>

        {{-- INPUT --}}
        <div class="p-3 bg-white border-t border-gray-100 flex-shrink-0">
            <div class="flex items-center gap-2 bg-gray-50 rounded-full px-4 py-2 border border-gray-200 focus-within:border-brand-primary/30 transition shadow-inner">
                <input type="text" x-model="userInput" @keydown.enter="sendMessage()" 
                    placeholder="Como posso ajudar hoje?" 
                    :disabled="isLoading"
                    class="flex-1 bg-transparent border-none focus:ring-0 text-sm text-gray-700 placeholder-gray-400 px-0">

                <button @click="sendMessage()" :disabled="!userInput.trim() || isLoading" 
                    class="text-brand-primary hover:text-brand-premium disabled:opacity-30 disabled:cursor-not-allowed transition">
                    <svg class="w-5 h-5 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- BOTÃO FLUTUANTE (TRIGGER) --}}
    <button @click="open = !open" 
        class="bg-brand-primary hover:bg-brand-charcoal text-white p-4 rounded-full shadow-2xl transition-all hover:scale-105 flex items-center justify-center group relative border-2 border-brand-premium/20">
        <span x-show="!open" class="absolute top-0 right-0 flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-premium opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-brand-premium"></span>
        </span>
        
        <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
        <svg x-show="open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path></svg>
    </button>

    <script>
        function chatbot() {
            return {
                open: false,
                userInput: '',
                messages: [
                    { role: 'assistant', content: "Olá. Sou o assistente virtual do Private Office. Procuro oferecer-lhe um atendimento exclusivo. Procura algum imóvel específico ou deseja agendar uma consultoria?" }
                ],
                isLoading: false,

                initBot() {
                    this.$watch('messages', () => {
                        this.$nextTick(() => {
                            const container = document.getElementById('chat-messages');
                            if(container) container.scrollTop = container.scrollHeight;
                        });
                    });
                },

                async sendMessage() {
                    if (!this.userInput.trim()) return;
                    
                    const textToSend = this.userInput;
                    this.messages.push({ role: 'user', content: textToSend });
                    this.userInput = '';
                    this.isLoading = true;

                    try {
                        const response = await fetch('{{ route("chatbot.send") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                message: textToSend,
                                history: this.messages.slice(-6)
                            })
                        });

                        const data = await response.json();

                        if (data.status === 'success') {
                            this.messages.push({ 
                                role: 'assistant', 
                                content: data.reply,
                                data: data.data 
                            });

                            if (data.audio) {
                                const audio = new Audio("data:audio/mp3;base64," + data.audio);
                                audio.play().catch(e => console.log("Audio block:", e));
                            }
                        } else {
                            this.messages.push({ role: 'assistant', content: 'Lamento, ocorreu um erro. Tente novamente.' });
                        }
                    } catch (error) {
                        this.messages.push({ role: 'assistant', content: 'Erro de conexão.' });
                    } finally {
                        this.isLoading = false;
                    }
                }
            }
        }
    </script>
</div>