@extends('layouts.app')

@section('content')

{{-- Cabeçalho com ajuste de espaçamento (pt-32) para a Navbar Fixa --}}
<div class="bg-brand-black text-white pt-32 pb-12 text-center relative overflow-hidden">
    <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    <div class="container mx-auto px-6 relative z-10">
        <h1 class="text-3xl font-serif text-white">Simulador de Crédito Habitação</h1>
        <p class="text-gray-400 text-sm mt-2 font-light">Calcule a sua prestação mensal com taxas Euribor atualizadas de 2025.</p>
    </div>
</div>

<section class="py-12 bg-gray-50" x-data="creditCalculator()" x-init="calculate()">
    <div class="container mx-auto px-4 md:px-8 max-w-6xl">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            {{-- ÁREA DO FORMULÁRIO --}}
            <div class="lg:col-span-7 space-y-6">
                
                {{-- 1. Dados do Imóvel e Financiamento --}}
                <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 border-b pb-2 flex items-center gap-2">
                        <span class="bg-brand-gold text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">1</span>
                        Valores e Prazos
                    </h3>
                    
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Valor do Imóvel --}}
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Valor do Imóvel (€)</label>
                                <input type="number" x-model.number="propertyValue" @input="updateLoanAmount()" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-brand-gold text-lg font-medium">
                            </div>

                            {{-- Entrada Inicial --}}
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Entrada Inicial (€)</label>
                                <input type="number" x-model.number="downPayment" @input="updateLoanAmount()" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-brand-gold text-lg font-medium">
                            </div>
                        </div>

                        {{-- Montante de Empréstimo (Auto-calculado) --}}
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100 flex justify-between items-center">
                            <div>
                                <span class="block text-xs font-bold text-blue-800 uppercase">Montante a Financiar</span>
                                <span class="text-xs text-blue-600" x-text="'LTV: ' + ltv.toFixed(1) + '%'"></span>
                            </div>
                            <div class="text-2xl font-bold text-blue-900">
                                <span x-text="formatMoney(loanAmount)"></span> €
                            </div>
                        </div>
                        <div x-show="ltv > 90" class="text-red-500 text-xs font-bold">
                            ⚠️ Atenção: O financiamento máximo para HPP é geralmente 90%.
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Prazo --}}
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Prazo (Anos)</label>
                                <select x-model.number="years" @change="calculate()" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-brand-gold">
                                    @foreach(range(40, 5) as $y)
                                        <option value="{{ $y }}">{{ $y }} Anos ({{ $y * 12 }} meses)</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            {{-- Idade do Titular Mais Velho --}}
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Idade (+ Velho)</label>
                                <input type="number" x-model.number="age" @input="checkMaxTerm()" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-brand-gold" placeholder="Ex: 35">
                            </div>
                        </div>
                        <div x-show="ageWarning" class="text-amber-600 text-xs font-bold" x-text="ageWarning"></div>

                    </div>
                </div>

                {{-- 2. Taxas de Juro --}}
                <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 border-b pb-2 flex items-center gap-2">
                        <span class="bg-brand-gold text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">2</span>
                        Taxas de Juro (Euribor + Spread)
                    </h3>

                    <div class="space-y-6">
                        
                        {{-- Tipo de Taxa --}}
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-3">Tipo de Taxa</label>
                            <div class="flex gap-4">
                                <label class="cursor-pointer flex-1">
                                    <input type="radio" name="rateType" value="variable" x-model="rateType" @change="calculate()" class="peer sr-only">
                                    <div class="p-3 rounded border border-gray-200 peer-checked:border-brand-gold peer-checked:bg-brand-gold/10 peer-checked:text-brand-black hover:bg-gray-50 transition-all text-center text-sm font-bold">
                                        Variável
                                    </div>
                                </label>
                                <label class="cursor-pointer flex-1">
                                    <input type="radio" name="rateType" value="fixed" x-model="rateType" @change="calculate()" class="peer sr-only">
                                    <div class="p-3 rounded border border-gray-200 peer-checked:border-brand-gold peer-checked:bg-brand-gold/10 peer-checked:text-brand-black hover:bg-gray-50 transition-all text-center text-sm font-bold">
                                        Fixa
                                    </div>
                                </label>
                            </div>
                        </div>

                        {{-- Seleção Euribor (Se Variável) --}}
                        <div x-show="rateType === 'variable'" x-transition>
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Indexante (Euribor)</label>
                            <select x-model.number="euriborRate" @change="calculate()" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-brand-gold bg-gray-50">
                                <option value="2.31">Euribor 12 Meses (2.31%)</option>
                                <option value="2.17">Euribor 6 Meses (2.17%)</option>
                                <option value="2.07">Euribor 3 Meses (2.07%)</option>
                            </select>
                            <p class="text-[10px] text-gray-400 mt-1">*Valores referência de Dez/2025.</p>
                        </div>

                        {{-- Taxa Fixa Manual (Se Fixa) --}}
                        <div x-show="rateType === 'fixed'" x-transition>
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Taxa Fixa Anual (%)</label>
                            <input type="number" step="0.01" x-model.number="fixedRate" @input="calculate()" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-brand-gold" placeholder="Ex: 4.0">
                        </div>

                        {{-- Spread --}}
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Spread (%)</label>
                            <div class="relative">
                                <input type="number" step="0.01" x-model.number="spread" @input="calculate()" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-brand-gold" placeholder="Ex: 0.85">
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">%</span>
                            </div>
                        </div>

                        {{-- TAN Total --}}
                        <div class="flex justify-between items-center border-t border-gray-100 pt-4">
                            <span class="text-sm font-bold text-gray-600">TAN (Taxa Anual Nominal)</span>
                            <span class="text-xl font-bold text-brand-black" x-text="tan.toFixed(3) + '%'"></span>
                        </div>

                    </div>
                </div>

            </div>

            {{-- ÁREA DE RESULTADOS (Sticky) --}}
            <div class="lg:col-span-5" id="results-area">
                <div class="sticky top-24 space-y-6">
                    
                    {{-- Cartão Principal: Mensalidade --}}
                    <div class="bg-brand-charcoal text-white p-8 rounded-xl shadow-2xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-10">
                            <svg class="w-24 h-24 text-brand-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0-2.08.402-2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>

                        <h3 class="text-lg font-serif text-brand-gold mb-1">Prestação Crédito (Capital + Juros)</h3>
                        <div class="text-4xl font-bold mb-6">
                            € <span x-text="formatMoney(monthlyPayment)"></span>
                        </div>

                        <div class="space-y-3 text-sm font-light border-t border-white/10 pt-4">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Prestação Crédito (Capital + Juros)</span>
                                <span>€ <span x-text="formatMoney(monthlyPayment)"></span></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">IS Juros (1º Mês) *4%</span>
                                <span>€ <span x-text="formatMoney(monthlyStampDuty)"></span></span>
                            </div>
                        </div>
                    </div>

                    {{-- Cartão Secundário: Custos Iniciais e Totais --}}
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                        <h4 class="font-bold text-gray-800 mb-4 border-b pb-2">Custos Iniciais do Processo</h4>
                        <div class="space-y-3 text-sm mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Entrada Inicial</span>
                                <span class="font-medium">€ <span x-text="formatMoney(downPayment)"></span></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Imposto Selo Abertura (0.6%)</span>
                                <span class="font-medium text-red-600">€ <span x-text="formatMoney(openingStampDuty)"></span></span>
                            </div>
                            <div class="flex justify-between border-t border-gray-100 pt-2 font-bold">
                                <span>Total Necessário (Cash)</span>
                                <span>€ <span x-text="formatMoney(upfrontTotal)"></span></span>
                            </div>
                        </div>

                        <h4 class="font-bold text-gray-800 mb-4 border-b pb-2">Análise Financeira (Fim do Contrato)</h4>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Capital Reembolsado</span>
                                <span class="font-medium">€ <span x-text="formatMoney(loanAmount)"></span></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Total de Juros</span>
                                <span class="font-medium text-orange-600">€ <span x-text="formatMoney(totalInterest)"></span></span>
                            </div>
                            <div class="flex justify-between border-t border-gray-100 pt-2">
                                <span class="font-bold text-gray-800">MTIC (Custo Total Aproximado)</span>
                                <span class="font-bold text-brand-black">€ <span x-text="formatMoney(mtic)"></span></span>
                            </div>
                        </div>
                    </div>

                    {{-- Botão CTA --}}
                    <div class="text-center">
                           <a href="{{ route('contact') }}" class="block w-full bg-brand-gold text-brand-black font-bold uppercase tracking-widest py-4 rounded-xl shadow-lg hover:bg-yellow-500 transition-all text-xs">
                                Pedir Aprovação Bancária
                            </a>
                            <p class="text-[10px] text-gray-400 mt-2">Valores meramente indicativos. Não dispensa proposta oficial.</p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<script>
    function creditCalculator() {
        return {
            propertyValue: 250000,
            downPayment: 50000,
            loanAmount: 200000,
            years: 30,
            age: 30,
            rateType: 'variable', // variable, fixed
            euriborRate: 2.17, // 6M Default
            fixedRate: 4.0, // <-- NOVO VALOR PADRÃO
            spread: 0.85,
            tan: 0,
            
            // Outputs
            monthlyPayment: 0,
            monthlyStampDuty: 0,
            monthlyTotal: 0,
            
            openingStampDuty: 0,
            bankFees: 0, // Estimativa dossiê + avaliação (0 conforme solicitado)
            upfrontTotal: 0,
            
            totalInterest: 0,
            mtic: 0,
            
            ltv: 0,
            ageWarning: '',

            formatMoney(value) {
                return new Intl.NumberFormat('pt-PT', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(value);
            },

            updateLoanAmount() {
                if (this.downPayment > this.propertyValue) this.downPayment = this.propertyValue;
                this.loanAmount = this.propertyValue - this.downPayment;
                this.calculate();
            },

            checkMaxTerm() {
                if (!this.age) {
                    this.ageWarning = '';
                    return;
                }
                const maxAge = 75;
                const projectedAge = this.age + this.years;
                
                // Regras BP
                let maxTermAllowed = 40;
                if (this.age > 30 && this.age <= 35) maxTermAllowed = 37;
                if (this.age > 35) maxTermAllowed = 35;

                if (this.years > maxTermAllowed) {
                    this.ageWarning = `Pela sua idade (${this.age} anos), o prazo máximo recomendado é de ${maxTermAllowed} anos.`;
                } else if (projectedAge > maxAge) {
                    this.ageWarning = `O crédito deve terminar antes dos 75 anos. Reduza o prazo para ${maxAge - this.age} anos.`;
                } else {
                    this.ageWarning = '';
                }
            },

            calculate() {
                // 1. Validar LTV
                if(this.propertyValue > 0) {
                    this.ltv = (this.loanAmount / this.propertyValue) * 100;
                } else {
                    this.ltv = 0;
                }

                this.checkMaxTerm();

                // 2. Definir Taxa Anual Nominal (TAN)
                if (this.rateType === 'variable') {
                    this.tan = this.euriborRate + this.spread;
                } else {
                    this.tan = this.fixedRate; 
                }

                // 3. Cálculo da Prestação (PMT)
                let i = (this.tan / 100) / 12;
                let n = this.years * 12;

                if (i === 0) {
                    this.monthlyPayment = this.loanAmount / n;
                } else {
                    this.monthlyPayment = (this.loanAmount * i) / (1 - Math.pow(1 + i, -n));
                }

                // 4. Imposto de Selo Mensal sobre Juros (4%)
                let firstMonthInterest = this.loanAmount * i;
                this.monthlyStampDuty = firstMonthInterest * 0.04;

                // 5. Total Mensal
                this.monthlyTotal = this.monthlyPayment + this.monthlyStampDuty;

                // 6. Custos Iniciais
                this.openingStampDuty = this.loanAmount * 0.006;
                this.upfrontTotal = this.downPayment + this.openingStampDuty;

                // 7. Totais Finais
                let totalPayments = this.monthlyPayment * n;
                this.totalInterest = totalPayments - this.loanAmount;
                
                let totalStampOnInterest = this.totalInterest * 0.04;
                
                this.mtic = totalPayments + totalStampOnInterest + this.openingStampDuty;
            }
        }
    }
</script>

@endsection