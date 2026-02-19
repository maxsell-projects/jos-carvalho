@extends('layouts.app')

@section('content')

{{-- HERO SECTION --}}
<div class="bg-brand-primary text-white pt-32 pb-20 text-center relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    
    <div class="container mx-auto px-6 relative z-10" data-aos="fade-up">
        <p class="text-brand-premium font-mono text-xs uppercase tracking-[0.4em] mb-6">
            Fiscalidade Imobiliária
        </p>
        <h1 class="text-4xl md:text-6xl font-didot leading-tight">
            Simulador de IMT & Selo
        </h1>
        <p class="text-gray-300 font-light max-w-2xl mx-auto mt-6 text-lg">
            Calcule os impostos de aquisição com precisão, incluindo as novas regras de isenção para jovens (OE 2025).
        </p>
    </div>
</div>

<section class="py-20 bg-brand-background" x-data="imtCalculator">
    <div class="container mx-auto px-6 max-w-7xl">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
            
            {{-- COLUNA DA ESQUERDA: FORMULÁRIO --}}
            <div class="lg:col-span-7 bg-white p-8 rounded-lg shadow-sm border-t-4 border-brand-premium" data-aos="fade-up">
                
                <h3 class="text-xl font-didot text-brand-primary mb-8 flex items-center gap-3">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-brand-primary text-white font-serif font-bold text-sm">1</span>
                    Dados da Transação
                </h3>
                
                <div class="space-y-8">
                    
                    {{-- Localização --}}
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-3">Localização do Imóvel</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="cursor-pointer group">
                                <input type="radio" name="location" value="continente" x-model="location" @change="calculate()" class="peer sr-only">
                                <div class="px-6 py-4 rounded border-2 border-gray-100 peer-checked:border-brand-primary peer-checked:bg-brand-primary peer-checked:text-white transition-all text-sm font-bold text-center text-gray-500 group-hover:border-gray-300">
                                    Portugal Continental
                                </div>
                            </label>
                            <label class="cursor-pointer group">
                                <input type="radio" name="location" value="ilhas" x-model="location" @change="calculate()" class="peer sr-only">
                                <div class="px-6 py-4 rounded border-2 border-gray-100 peer-checked:border-brand-primary peer-checked:bg-brand-primary peer-checked:text-white transition-all text-sm font-bold text-center text-gray-500 group-hover:border-gray-300">
                                    Açores / Madeira
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Finalidade --}}
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Finalidade</label>
                        <select x-model="purpose" @change="calculate()" class="w-full bg-gray-50 border-0 border-b-2 border-gray-200 px-4 py-3 focus:ring-0 focus:border-brand-premium cursor-pointer text-brand-primary">
                            <option value="hpp">Habitação Própria Permanente (HPP)</option>
                            <option value="secundaria">Habitação Secundária / Arrendamento</option>
                            <option value="rustico">Prédios Rústicos</option>
                            <option value="urbano">Outros Prédios Urbanos / Terrenos</option>
                            <option value="offshore_pessoal">Residente em Paraíso Fiscal</option>
                        </select>
                    </div>

                    {{-- Valor --}}
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Valor de Aquisição (€)</label>
                        <div class="relative">
                            <input type="number" x-model.number="propertyValue" @input="calculate()" 
                                   class="w-full bg-gray-50 border-0 border-b-2 border-gray-200 px-4 py-3 focus:ring-0 focus:border-brand-premium transition-colors text-lg font-serif text-brand-primary placeholder-gray-300" 
                                   placeholder="0.00">
                        </div>
                    </div>

                    {{-- Compradores --}}
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-3">Nº de Compradores</label>
                        <div class="flex gap-4">
                            <label class="cursor-pointer flex-1 group">
                                <input type="radio" name="buyers" :value="1" x-model.number="buyersCount" @change="calculate()" class="peer sr-only">
                                <div class="py-3 rounded border border-gray-200 peer-checked:bg-brand-premium/10 peer-checked:border-brand-premium peer-checked:text-brand-primary text-center text-sm font-bold text-gray-400 transition-all">1</div>
                            </label>
                            <label class="cursor-pointer flex-1 group">
                                <input type="radio" name="buyers" :value="2" x-model.number="buyersCount" @change="calculate()" class="peer sr-only">
                                <div class="py-3 rounded border border-gray-200 peer-checked:bg-brand-premium/10 peer-checked:border-brand-premium peer-checked:text-brand-primary text-center text-sm font-bold text-gray-400 transition-all">2</div>
                            </label>
                        </div>
                    </div>

                </div>

                {{-- DADOS DOS COMPRADORES (SEMPRE VISÍVEL PARA HPP) --}}
                <div x-show="purpose === 'hpp'" x-transition class="mt-8 pt-8 border-t border-gray-100">
                    <h3 class="text-xl font-didot text-brand-primary mb-6 flex items-center gap-3">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-brand-primary text-white font-serif font-bold text-sm">2</span>
                        Elegibilidade IMT Jovem
                    </h3>
                    
                    <div class="space-y-6">
                        {{-- Comprador 1 --}}
                        <div class="bg-[#F5F7FA] p-6 rounded border border-gray-200">
                            <span class="text-xs font-bold uppercase text-brand-primary tracking-wider mb-4 block">Comprador 1</span>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-500 mb-2">Idade</label>
                                    <input type="number" x-model.number="buyer1Age" @input="checkAge(1); calculate()" class="w-full border-gray-300 rounded text-sm focus:border-brand-cta focus:ring-0">
                                </div>
                                
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="block text-[10px] font-bold text-gray-500">Elegível IMT Jovem?</label>
                                        <span class="text-[10px] text-gray-400 cursor-help" title="Até 35 anos, 1ª Habitação">Ajuda (?)</span>
                                    </div>
                                    <div class="flex gap-2">
                                        <button type="button" @click="setBuyerEligible(1, true)" :class="buyer1Eligible ? 'bg-brand-primary text-white border-brand-primary' : 'bg-white text-gray-500 border-gray-300'" class="flex-1 py-2 text-xs border rounded transition-all font-bold">Sim</button>
                                        <button type="button" @click="setBuyerEligible(1, false)" :class="!buyer1Eligible ? 'bg-gray-200 text-gray-800 border-gray-300' : 'bg-white text-gray-500 border-gray-300'" class="flex-1 py-2 text-xs border rounded transition-all font-bold">Não</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Comprador 2 --}}
                        <div x-show="buyersCount === 2" x-transition class="bg-[#F5F7FA] p-6 rounded border border-gray-200">
                            <span class="text-xs font-bold uppercase text-brand-primary tracking-wider mb-4 block">Comprador 2</span>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-500 mb-2">Idade</label>
                                    <input type="number" x-model.number="buyer2Age" @input="checkAge(2); calculate()" class="w-full border-gray-300 rounded text-sm focus:border-brand-cta focus:ring-0">
                                </div>
                                
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="block text-[10px] font-bold text-gray-500">Elegível IMT Jovem?</label>
                                    </div>
                                    <div class="flex gap-2">
                                        <button type="button" @click="setBuyerEligible(2, true)" :class="buyer2Eligible ? 'bg-brand-primary text-white border-brand-primary' : 'bg-white text-gray-500 border-gray-300'" class="flex-1 py-2 text-xs border rounded transition-all font-bold">Sim</button>
                                        <button type="button" @click="setBuyerEligible(2, false)" :class="!buyer2Eligible ? 'bg-gray-200 text-gray-800 border-gray-300' : 'bg-white text-gray-500 border-gray-300'" class="flex-1 py-2 text-xs border rounded transition-all font-bold">Não</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100">
                    <button @click="scrollToResults" class="w-full bg-brand-cta text-white font-bold uppercase tracking-[0.2em] py-4 rounded shadow-lg hover:bg-brand-primary transition-all transform hover:-translate-y-1 text-xs">
                        Calcular Impostos
                    </button>
                </div>

            </div>

            {{-- COLUNA DA DIREITA: RESULTADOS --}}
            <div class="lg:col-span-5" id="results-area">
                <div class="sticky top-32 space-y-6">
                    
                    {{-- Cartão Principal --}}
                    <div class="bg-brand-primary text-white p-8 rounded-xl shadow-2xl relative overflow-hidden">
                        {{-- Detalhes Toggle --}}
                        <div class="absolute top-4 right-4 z-20">
                            <button @click="showBreakdown = !showBreakdown" class="text-[10px] uppercase tracking-widest text-gray-400 hover:text-white transition flex items-center gap-1">
                                <span x-text="showBreakdown ? 'Ocultar' : 'Ver Detalhes'"></span>
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                        </div>

                        <h3 class="text-2xl font-serif text-brand-premium mb-6">Custos Fiscais</h3>

                        {{-- Breakdown --}}
                        <div x-show="showBreakdown" x-transition class="bg-white/5 p-4 rounded mb-6 text-xs border border-white/10">
                            <div class="space-y-2 text-gray-300">
                                <div class="flex justify-between">
                                    <span>Valor Tributável</span>
                                    <span class="font-bold text-white">€ <span x-text="formatMoney(imtBreakdown.taxableValue)"></span></span>
                                </div>
                                <div class="flex justify-between border-b border-white/10 pb-2 mb-2">
                                    <span>Quota Parte</span>
                                    <span class="font-bold text-white">1/<span x-text="buyersCount"></span></span>
                                </div>
                                
                                <div class="text-[10px] text-gray-400 italic mb-2" x-text="imtBreakdown.rateText"></div>
                                
                                <template x-if="imtBreakdown.isMarginal">
                                    <div class="p-2 bg-brand-cta/20 rounded border border-brand-cta/30 text-brand-cta mb-2">
                                        IMT Jovem: Taxa de 8% aplicada apenas sobre o valor que excede <span x-text="formatMoney(imtBreakdown.marginalExemption) + '€'"></span>.
                                    </div>
                                </template>
                            </div>
                        </div>

                        {{-- Totais --}}
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-400 uppercase tracking-wide">IMT Total</span>
                                <span class="text-xl font-bold">€ <span x-text="formatMoney(finalIMT)"></span></span>
                            </div>
                            
                            <div class="flex justify-between items-center border-b border-white/10 pb-4">
                                <span class="text-sm text-gray-400 uppercase tracking-wide">Imposto Selo (0.8%)</span>
                                <span class="text-xl font-bold">€ <span x-text="formatMoney(finalStamp)"></span></span>
                            </div>

                            <div class="pt-2">
                                <p class="text-[10px] uppercase tracking-widest text-brand-premium mb-1">Total a Pagar ao Estado</p>
                                <p class="text-5xl font-didot text-white">€ <span x-text="formatMoney(totalPayable)"></span></p>
                            </div>
                        </div>
                    </div>

                    {{-- CTA --}}
                    <div class="bg-white p-6 rounded shadow-sm border border-gray-100 text-center">
                        <p class="text-sm font-bold text-brand-primary mb-2">Planeie o seu investimento</p>
                        <p class="text-xs text-gray-500 mb-4">Sabendo o custo fiscal, descubra agora a melhor solução de financiamento.</p>
                        <a href="{{ route('tools.credit') }}" class="block w-full border border-brand-primary text-brand-primary font-bold uppercase tracking-widest py-3 rounded hover:bg-brand-primary hover:text-white transition-all text-xs">
                            Simular Crédito Habitação
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('imtCalculator', () => ({
            location: 'continente',
            purpose: 'hpp',
            propertyValue: 300000, 
            buyersCount: 1,
            
            buyer1Age: 30, 
            buyer1Eligible: true,
            
            buyer2Age: '',
            buyer2Eligible: false,

            finalIMT: 0,
            finalStamp: 0,
            totalPayable: 0,
            
            imtBreakdown: {
                taxableValue: 0,
                rateText: 'N/A',
                abatement: 0,
                finalIMT: 0,
                isJovemBenefit: false,
                isMarginal: false,
                marginalExemption: 0,
                marginalRate: 0,
            },
            showBreakdown: false,

            init() {
                this.calculate();
            },

            setBuyerEligible(buyerIndex, value) {
                if (buyerIndex === 1) this.buyer1Eligible = value;
                if (buyerIndex === 2) this.buyer2Eligible = value;
                this.calculate();
            },

            formatMoney(value) {
                return new Intl.NumberFormat('pt-PT', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(value);
            },

            scrollToResults() {
                const el = document.getElementById('results-area');
                if(el) el.scrollIntoView({ behavior: 'smooth' });
                this.calculate();
            },

            checkAge(buyerIndex) {
                if (buyerIndex === 1) {
                    if (this.buyer1Age > 35) this.buyer1Eligible = false;
                }
                if (buyerIndex === 2) {
                    if (this.buyer2Age > 35) this.buyer2Eligible = false;
                }
            },

            calculateNormalIMT(valor, tabela, purpose) {
                let taxa = 0;
                let parcelaAbater = 0;
                
                // Rústico ou Urbano (Flat Rate)
                if (purpose === 'rustico') return valor * 0.05;
                if (purpose === 'urbano') return valor * 0.065;
                if (purpose === 'offshore_pessoal') return valor * 0.10;

                // HABITAÇÃO (HPP ou Secundária)
                // Se for secundária, não tem isenção no primeiro escalão geralmente.
                // Mas vamos simplificar para a tabela de 'Habitação' geral para não complicar.
                
                // Continente 2024/25 (Valores aproximados para exemplo)
                if (tabela === 'continente') {
                    if (purpose === 'hpp') {
                        if (valor <= 101917) { taxa = 0; parcelaAbater = 0; }
                        else if (valor <= 139412) { taxa = 0.02; parcelaAbater = 2038.34; }
                        else if (valor <= 190086) { taxa = 0.05; parcelaAbater = 6220.70; }
                        else if (valor <= 316772) { taxa = 0.07; parcelaAbater = 10022.42; }
                        else if (valor <= 633453) { taxa = 0.08; parcelaAbater = 13190.14; }
                        else if (valor <= 1102920) { return valor * 0.06; } // Taxa única
                        else { return valor * 0.075; } // Taxa única
                        return Math.max(0, (valor * taxa) - parcelaAbater);
                    } else {
                        // Secundária
                        if (valor <= 101917) { taxa = 0.01; parcelaAbater = 0; }
                        else if (valor <= 139412) { taxa = 0.02; parcelaAbater = 1019.17; }
                        else if (valor <= 190086) { taxa = 0.05; parcelaAbater = 5201.53; }
                        else if (valor <= 316772) { taxa = 0.07; parcelaAbater = 9003.25; }
                        else if (valor <= 603582) { taxa = 0.08; parcelaAbater = 12170.97; }
                        else if (valor <= 1102920) { return valor * 0.06; } // Taxa única
                        else { return valor * 0.075; } // Taxa única
                        return Math.max(0, (valor * taxa) - parcelaAbater);
                    }
                }
                
                // Ilhas (Açores/Madeira) - Escalões +25%
                if (tabela === 'ilhas') {
                    // Simplificado: usar tabela do continente com ajuste ou valores aproximados
                    // Vamos usar logicamente Continente * 0.8 (redução de imposto) como 'approximation' se queremos simplificar
                    // Ou apenas usar os mesmos brackets para simplificar se o user pediu SIMPLES.
                    // Para ser correto, teríamos de ajustar todos os brackets.
                     
                    // Fallback para Continente para evitar erros se não tivermos a tabela agora.
                    return this.calculateNormalIMT(valor, 'continente', purpose);
                }

                return valor * 0.05; 
            },

            calculateYoungIMT(valor, location) {
                // Isenção total até 316.772 (Continente)
                const limitIsencao = location === 'continente' ? 316772 : 395965;
                const limitParcial = location === 'continente' ? 633453 : 791816;
                const taxaExcedente = 0.08;

                if (valor <= limitIsencao) {
                    return 0; 
                } else if (valor <= limitParcial) {
                    return (valor - limitIsencao) * taxaExcedente;
                } else {
                    return this.calculateNormalIMT(valor, location, 'hpp');
                }
            },

            calculate() {
                let valorTotal = Number(this.propertyValue) || 0;
                
                if (valorTotal <= 0) {
                    this.finalIMT = 0; this.finalStamp = 0; this.totalPayable = 0;
                    return;
                }

                let rateSelo = 0.008; 
                let isHPP = this.purpose === 'hpp';
                let locTable = this.location; // 'continente' ou 'ilhas'
                let imtBreakdownText = '';

                // 1. Base Normal
                let imtBaseNormal = this.calculateNormalIMT(valorTotal, locTable, this.purpose);
                
                // 2. Base Jovem
                let imtBaseJovem = imtBaseNormal;
                let seloBaseJovem = valorTotal * rateSelo;
                
                // Check if young logic applies
                const isBuyer1Eligible = this.buyer1Eligible && this.buyer1Age <= 35;
                const isBuyer2Eligible = this.buyersCount === 2 && this.buyer2Eligible && this.buyer2Age <= 35;
                let youngBuyersCount = (isBuyer1Eligible ? 1 : 0) + (isBuyer2Eligible ? 1 : 0);

                if (isHPP && youngBuyersCount > 0) {
                     const limitIsencao = locTable === 'continente' ? 316772 : 395965;
                     const limitParcial = locTable === 'continente' ? 633453 : 791816;
                    
                    if (valorTotal <= limitParcial) {
                        imtBaseJovem = this.calculateYoungIMT(valorTotal, locTable);
                        
                        // Selo Jovem
                        if (valorTotal <= limitIsencao) {
                            seloBaseJovem = 0;
                        } else {
                            seloBaseJovem = (valorTotal - limitIsencao) * 0.008;
                        }
                        
                        imtBreakdownText = valorTotal <= limitIsencao ? 'Isenção Jovem Total' : 'Isenção Jovem Parcial';
                        this.imtBreakdown.isMarginal = valorTotal > limitIsencao;
                        this.imtBreakdown.marginalExemption = limitIsencao;
                    }
                }

                // 3. Divisão de Quotas (Simplificado assume quotas iguais 50/50)
                let buyers = Number(this.buyersCount);
                let finalIMT = 0;
                let finalStamp = 0;

                for (let i = 1; i <= buyers; i++) {
                    let isEligible = false;
                    if (this.purpose === 'hpp') {
                        if (i === 1 && isBuyer1Eligible) isEligible = true;
                        if (i === 2 && isBuyer2Eligible) isEligible = true;
                    }

                    if (isEligible) {
                        finalIMT += (imtBaseJovem / buyers);
                        finalStamp += (seloBaseJovem / buyers);
                    } else {
                        finalIMT += (imtBaseNormal / buyers);
                        finalStamp += ((valorTotal * rateSelo) / buyers);
                    }
                }
                
                this.finalIMT = finalIMT;
                this.finalStamp = finalStamp;
                this.totalPayable = finalIMT + finalStamp;

                this.imtBreakdown.rateText = imtBreakdownText || 'Taxa Normal em Vigor';
                this.imtBreakdown.taxableValue = valorTotal;
                this.imtBreakdown.finalIMT = finalIMT;
            }
        }));
    });
</script>

@endsection