@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen pt-24 pb-12">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="gainsForm()">
        
        <div class="text-center mb-12">
            <h1 class="text-4xl font-black text-brand-black mb-2">Simulador de Mais-Valia Imobiliária</h1>
            <p class="text-gray-500 font-medium">Calcule o imposto (IRS) aproximado sobre a venda do seu imóvel em Portugal.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <div class="lg:col-span-8 space-y-8">
                
                {{-- 1. Valor de Aquisição --}}
                <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-800 border-b border-gray-100 pb-3 mb-6 flex items-center gap-3">
                        <span class="bg-brand-gold text-white w-7 h-7 rounded-full flex items-center justify-center text-xs font-black">1</span>
                        Valor de Aquisição (Compra Original)
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Valor (€)</label>
                            <input type="number" step="0.01" x-model="form.acquisition_value" class="w-full rounded-lg border-gray-300 focus:border-brand-gold focus:ring-brand-gold text-lg" placeholder="Ex: 150000,00">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Ano</label>
                                <select x-model="form.acquisition_year" class="w-full rounded-lg border-gray-300 focus:border-brand-gold focus:ring-brand-gold text-sm">
                                    @foreach(range(2025, 1901) as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Mês</label>
                                <select x-model="form.acquisition_month" class="w-full rounded-lg border-gray-300 focus:border-brand-gold focus:ring-brand-gold text-sm">
                                    @foreach(['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'] as $month)
                                        <option value="{{ $month }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        {{-- CONSTRUÇÃO PRÓPRIA (Movido para cá para ficar igual à lógica corrigida) --}}
                        <div class="md:col-span-2 pt-4 border-t border-gray-50">
                             <label class="block text-sm font-medium text-gray-700 mb-3">A habitação foi construída por si?</label>
                             <div class="flex gap-6">
                                 <label class="inline-flex items-center cursor-pointer"><input type="radio" value="Sim" x-model="form.self_built" class="text-brand-gold focus:ring-brand-gold w-5 h-5"><span class="ml-2 text-sm text-gray-600">Sim</span></label>
                                 <label class="inline-flex items-center cursor-pointer"><input type="radio" value="Não" x-model="form.self_built" class="text-brand-gold focus:ring-brand-gold w-5 h-5"><span class="ml-2 text-sm text-gray-600">Não</span></label>
                             </div>
                             <p class="text-[10px] text-gray-400 mt-1">*Afeta a data considerada para o coeficiente de desvalorização.</p>
                        </div>
                    </div>
                </div>

                {{-- 2. Valor de Venda --}}
                <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-800 border-b border-gray-100 pb-3 mb-6 flex items-center gap-3">
                        <span class="bg-brand-gold text-white w-7 h-7 rounded-full flex items-center justify-center text-xs font-black">2</span>
                        Valor de Venda (Realização)
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Valor (€)</label>
                            <input type="number" step="0.01" x-model="form.sale_value" class="w-full rounded-lg border-gray-300 focus:border-brand-gold focus:ring-brand-gold text-lg" placeholder="Ex: 300000,00">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Ano</label>
                                <select x-model="form.sale_year" class="w-full rounded-lg border-gray-300 focus:border-brand-gold focus:ring-brand-gold text-sm">
                                    @foreach(range(2025, 1901) as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Mês</label>
                                <select x-model="form.sale_month" class="w-full rounded-lg border-gray-300 focus:border-brand-gold focus:ring-brand-gold text-sm">
                                    @foreach(['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'] as $month)
                                        <option value="{{ $month }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 3. Despesas --}}
                <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-800 border-b border-gray-100 pb-3 mb-6 flex items-center gap-3">
                        <span class="bg-brand-gold text-white w-7 h-7 rounded-full flex items-center justify-center text-xs font-black">3</span>
                        Despesas e Encargos
                    </h3>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Teve despesas ou encargos (obras, IMT, comissões, etc.)?</label>
                        <div class="flex gap-6">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="radio" value="Sim" x-model="form.has_expenses" class="text-brand-gold focus:ring-brand-gold w-5 h-5">
                                <span class="ml-2 font-medium text-gray-700">Sim</span>
                            </label>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="radio" value="Não" x-model="form.has_expenses" class="text-brand-gold focus:ring-brand-gold w-5 h-5">
                                <span class="ml-2 font-medium text-gray-700">Não</span>
                            </label>
                        </div>
                    </div>

                    <div x-show="form.has_expenses === 'Sim'" x-transition class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 mb-1">Obras e melhorias (€)</label>
                            <input type="number" step="0.01" x-model="form.expenses_works" class="w-full rounded border-gray-300 text-sm focus:border-brand-gold focus:ring-brand-gold">
                            {{-- AVISO LEGAL --}}
                            <p class="text-[10px] text-gray-400 mt-1">*Apenas obras realizadas nos últimos 12 anos.</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 mb-1">IMT e Imposto do Selo (Aquisição) (€)</label>
                            <input type="number" step="0.01" x-model="form.expenses_imt" class="w-full rounded border-gray-300 text-sm focus:border-brand-gold focus:ring-brand-gold">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 mb-1">Comissão Imobiliária (Venda) (€)</label>
                            <input type="number" step="0.01" x-model="form.expenses_commission" class="w-full rounded border-gray-300 text-sm focus:border-brand-gold focus:ring-brand-gold">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 mb-1">Outros Encargos (€)</label>
                            <input type="number" step="0.01" x-model="form.expenses_other" class="w-full rounded border-gray-300 text-sm focus:border-brand-gold focus:ring-brand-gold">
                        </div>
                    </div>
                </div>

                {{-- 4. Tipo de Imóvel e Isenções --}}
                <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100 space-y-6">
                    <h3 class="text-xl font-bold text-gray-800 border-b border-gray-100 pb-3 mb-6 flex items-center gap-3">
                        <span class="bg-brand-gold text-white w-7 h-7 rounded-full flex items-center justify-center text-xs font-black">4</span>
                        Finalidade e Tributação
                    </h3>

                    {{-- Venda ao Estado --}}
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                        <label class="block text-sm font-medium text-gray-900 mb-3 leading-relaxed">
                            A venda deste imóvel foi feita ao Estado, Regiões Autónomas ou Autarquias?
                        </label>
                        <div class="flex gap-6">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="radio" value="Sim" x-model="form.sold_to_state" @change="resetHPPFields" class="text-brand-gold focus:ring-brand-gold w-5 h-5">
                                <span class="ml-2 font-bold text-gray-700">Sim</span>
                            </label>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="radio" value="Não" x-model="form.sold_to_state" @change="resetHPPFields" class="text-brand-gold focus:ring-brand-gold w-5 h-5">
                                <span class="ml-2 font-medium text-gray-700">Não</span>
                            </label>
                        </div>
                        <div x-show="form.sold_to_state === 'Sim'" x-transition class="mt-3 text-sm text-blue-700 font-medium flex items-center gap-2 p-2 bg-blue-100 rounded">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>O ganho é isento de IRS.</span>
                        </div>
                    </div>

                    {{-- Lógica Condicional Principal --}}
                    <div x-show="form.sold_to_state === 'Não'" x-transition class="space-y-6">
                        
                        {{-- HPP Status --}}
                        <div class="p-4 rounded-lg border" :class="{'border-gray-200 bg-white': true, 'border-brand-gold ring-1 ring-brand-gold/20': form.hpp_status !== 'Não'}">
                            <label class="block text-sm font-bold text-gray-700 mb-3">Qual era a finalidade do imóvel no momento da venda?</label>
                            <div class="flex flex-col gap-3">
                                <label class="inline-flex items-start cursor-pointer">
                                    <input type="radio" value="Sim" x-model="form.hpp_status" @change="resetReinvestmentFields" class="text-brand-gold focus:ring-brand-gold w-5 h-5 mt-0.5">
                                    <span class="ml-2 text-sm font-medium text-gray-700">Habitação Própria Permanente (HPP) há, pelo menos, 12 meses.</span>
                                </label>
                                <label class="inline-flex items-start cursor-pointer">
                                    <input type="radio" value="Menos12Meses" x-model="form.hpp_status" @change="resetReinvestmentFields" class="text-brand-gold focus:ring-brand-gold w-5 h-5 mt-0.5">
                                    <span class="ml-2 text-sm font-medium text-gray-700">HPP há menos de 12 meses.</span>
                                </label>
                                <label class="inline-flex items-start cursor-pointer">
                                    <input type="radio" value="Não" x-model="form.hpp_status" @change="resetReinvestmentFields" class="text-brand-gold focus:ring-brand-gold w-5 h-5 mt-0.5">
                                    <span class="ml-2 text-sm font-medium text-gray-700">Imóvel Secundário / Investimento.</span>
                                </label>
                            </div>
                        </div>

                        {{-- BLOCO DE BENEFÍCIOS (Reinvestimento / Amortização) --}}
                        <div class="space-y-6 p-4 rounded-lg border border-green-100 bg-green-50">
                            <h4 class="text-lg font-bold text-green-800">Opções de Isenção e Benefícios</h4>

                            {{-- Reinvestimento (SÓ HPP) --}}
                            <div class="border-b border-green-100 pb-4" x-show="form.hpp_status === 'Sim'">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pretende reinvestir o valor da venda numa nova HPP?</label>
                                <div class="flex gap-6 mb-3">
                                    <label class="inline-flex items-center cursor-pointer"><input type="radio" value="Sim" x-model="form.reinvest_intention" class="text-brand-gold focus:ring-brand-gold w-5 h-5"><span class="ml-2">Sim</span></label>
                                    <label class="inline-flex items-center cursor-pointer"><input type="radio" value="Não" x-model="form.reinvest_intention" class="text-brand-gold focus:ring-brand-gold w-5 h-5"><span class="ml-2">Não</span></label>
                                </div>
                                <div x-show="form.reinvest_intention === 'Sim'" x-transition>
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Valor a Reinvestir (€)</label>
                                    <input type="number" step="0.01" x-model="form.reinvestment_amount" class="w-full rounded-lg border-green-300 focus:border-brand-gold focus:ring-brand-gold">
                                </div>
                            </div>

                            {{-- Amortização (TODOS - Norma Mais Habitação) --}}
                            <div class="border-b border-green-100 pb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pretende amortizar crédito habitação (HPP) com a venda?</label>
                                {{-- Aviso para Secundários --}}
                                <p class="text-[10px] text-gray-500 mb-3" x-show="form.hpp_status !== 'Sim'">
                                    *Válido para vendas de secundários/terrenos em 2023/2024 (Lei Mais Habitação).
                                </p>
                                <div class="flex gap-6 mb-3">
                                    <label class="inline-flex items-center cursor-pointer"><input type="radio" value="Sim" x-model="form.amortize_credit" class="text-brand-gold focus:ring-brand-gold w-5 h-5"><span class="ml-2">Sim</span></label>
                                    <label class="inline-flex items-center cursor-pointer"><input type="radio" value="Não" x-model="form.amortize_credit" class="text-brand-gold focus:ring-brand-gold w-5 h-5"><span class="ml-2">Não</span></label>
                                </div>
                                <div x-show="form.amortize_credit === 'Sim'" x-transition>
                                    <label class="block text-xs font-bold text-gray-600 mb-1">Valor a Amortizar (€)</label>
                                    <input type="number" step="0.01" x-model="form.amortization_amount" class="w-full rounded-lg border-green-300 focus:border-brand-gold focus:ring-brand-gold">
                                </div>
                            </div>

                            {{-- Reformados (SÓ HPP) --}}
                            <div x-show="form.hpp_status === 'Sim'">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Está reformado ou tem mais de 65 anos?</label>
                                <div class="flex gap-6">
                                    <label class="inline-flex items-center cursor-pointer"><input type="radio" value="Sim" x-model="form.retired_status" class="text-brand-gold focus:ring-brand-gold w-5 h-5"><span class="ml-2">Sim</span></label>
                                    <label class="inline-flex items-center cursor-pointer"><input type="radio" value="Não" x-model="form.retired_status" class="text-brand-gold focus:ring-brand-gold w-5 h-5"><span class="ml-2">Não</span></label>
                                </div>
                                <p class="text-[10px] text-gray-400 mt-1" x-show="form.retired_status === 'Sim'">*Permite isenção se reinvestir em PPR/Seguros.</p>
                            </div>
                        </div>

                        {{-- Dados de Tributação --}}
                        <div class="space-y-6 pt-4 border-t border-gray-100">
                            <h4 class="text-lg font-bold text-gray-800">Dados de Tributação</h4>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tem declaração fiscal conjunta?</label>
                                <div class="flex gap-6">
                                    <label class="inline-flex items-center cursor-pointer"><input type="radio" value="Sim" x-model="form.joint_tax_return" class="text-brand-gold focus:ring-brand-gold w-5 h-5"><span class="ml-2">Sim</span></label>
                                    <label class="inline-flex items-center cursor-pointer"><input type="radio" value="Não" x-model="form.joint_tax_return" class="text-brand-gold focus:ring-brand-gold w-5 h-5"><span class="ml-2">Não</span></label>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Qual é o seu Rendimento Anual Coletável para IRS? (€)</label>
                                <input type="number" step="0.01" x-model="form.annual_income" class="w-full rounded-lg border-gray-300 focus:border-brand-gold focus:ring-brand-gold" placeholder="Ex: 25000,00">
                                <p class="text-xs text-gray-400 mt-1">*Indique o valor do <strong>Anexo A</strong> da sua declaração de IRS.</p>
                            </div>

                            <div class="pt-4 border-t border-gray-100">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Relativamente ao imóvel alienado, beneficiou de apoio público não reembolsável (>30% VPT)?</label>
                                <div class="flex gap-6 mb-3">
                                    <label class="inline-flex items-center cursor-pointer"><input type="radio" value="Sim" x-model="form.public_support" class="text-brand-gold focus:ring-brand-gold w-5 h-5"><span class="ml-2">Sim</span></label>
                                    <label class="inline-flex items-center cursor-pointer"><input type="radio" value="Não" x-model="form.public_support" class="text-brand-gold focus:ring-brand-gold w-5 h-5"><span class="ml-2">Não</span></label>
                                </div>
                                <div x-show="form.public_support === 'Sim'" x-transition class="grid grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg border border-gray-200">
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Ano Apoio</label>
                                        <select x-model="form.public_support_year" class="w-full rounded-lg border-gray-300 text-sm focus:border-brand-gold focus:ring-brand-gold">
                                            @foreach(range(2025, 1980) as $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Mês Apoio</label>
                                        <select x-model="form.public_support_month" class="w-full rounded-lg border-gray-300 text-sm focus:border-brand-gold focus:ring-brand-gold">
                                            @foreach(['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'] as $month)
                                                <option value="{{ $month }}">{{ $month }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <section class="border-t border-gray-200 pt-6">
                    <button type="button" @click="openModal" class="w-full bg-brand-black text-white font-bold py-4 rounded-xl shadow-lg hover:bg-gray-800 transition-all uppercase tracking-widest text-sm transform hover:-translate-y-0.5">
                        Simular Mais-Valia
                    </button>
                </section>

            </div>

            <div class="lg:col-span-4">
                <div class="sticky top-24 space-y-6">
                    
                    <div x-show="!hasCalculated" class="bg-white border border-gray-200 rounded-xl p-8 text-center text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        <p class="text-sm">Preencha o formulário e clique em "Simular" para ver o resultado detalhado.</p>
                    </div>

                    <div x-show="hasCalculated" x-transition class="space-y-6" style="display: none;">
                        
                        <div class="bg-orange-500 rounded-xl p-6 text-white shadow-lg relative overflow-hidden">
                            <h3 class="text-sm font-semibold opacity-90 mb-1 uppercase tracking-widest">Imposto Estimado (IRS)</h3>
                            <div class="text-5xl font-black mb-6" x-text="results.estimated_tax_fmt + ' €'"></div>
                            
                            <div class="grid grid-cols-1 gap-3 border-t border-orange-400 pt-4">
                                <div>
                                    <div class="text-xs opacity-80 mb-0.5">Mais-valia Bruta Total:</div>
                                    <div class="text-xl font-bold" x-text="results.gross_gain_fmt + ' €'"></div>
                                </div>
                                <div>
                                    <div class="text-xs opacity-80 mb-0.5">Valor Tributável (Considerado para IRS):</div>
                                    <div class="text-xl font-bold" x-text="results.taxable_gain_fmt + ' €'"></div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gray-50 px-5 py-3 border-b border-gray-200 font-black text-brand-black text-sm">
                                Detalhe do Cálculo da Mais-valia
                            </div>
                            <div class="p-5 space-y-4 text-sm">
                                <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                    <span class="text-gray-600">Valor de venda (Realização)</span>
                                    <span class="font-bold text-gray-900" x-text="results.sale_fmt + ' €'"></span>
                                </div>
                                <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                    <span class="text-gray-600">Coeficiente de atualização monetária</span>
                                    <span class="font-bold text-gray-900" x-text="results.coefficient"></span>
                                </div>
                                <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                    <span class="text-gray-600">Valor de aquisição atualizado</span>
                                    <span class="font-bold text-brand-gold" x-text="'- ' + results.acquisition_updated_fmt + ' €'"></span>
                                </div>
                                <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                    <span class="text-gray-600">Despesas e encargos</span>
                                    <span class="font-bold text-brand-gold" x-text="'- ' + results.expenses_fmt + ' €'"></span>
                                </div>
                                <div class="flex justify-between items-center border-b border-gray-100 pb-2" x-show="results.reinvestment_fmt !== '0,00' || form.amortize_credit === 'Sim'">
                                    <span class="text-gray-600">Valor Reinvestido / Amortizado (Isento)</span>
                                    <span class="font-bold text-brand-gold" x-text="'- ' + results.reinvestment_fmt + ' €'"></span>
                                </div>
                                <div class="flex justify-between items-center pt-2 mt-4">
                                    <span class="font-black text-brand-black text-base">Mais-valia Tributável</span>
                                    <span class="font-black text-green-600 text-lg" x-text="results.taxable_gain_fmt + ' €'"></span>
                                </div>
                            </div>
                        </div>

                        <div x-show="form.sold_to_state === 'Sim'" class="bg-blue-100 border border-blue-200 rounded-xl p-4 text-xs text-blue-800 leading-relaxed font-bold">
                            <strong class="block mb-1">ISENÇÃO TOTAL POR VENDA PÚBLICA</strong>
                            A lei prevê a isenção de tributação em IRS para a venda de imóveis de habitação ao Estado, Regiões Autónomas ou Autarquias.
                        </div>

                        <div x-show="results.taxable_gain_fmt !== '0,00'" class="p-4 bg-yellow-100 border border-yellow-200 rounded-xl text-xs text-yellow-800 font-medium">
                            <strong class="block mb-1 text-sm text-yellow-900">Nota sobre Englobamento (50%)</strong>
                            Em Portugal, apenas 50% da mais-valia líquida (após isenções) é englobada e sujeita às taxas progressivas de IRS. O valor "Tributável" acima já reflete essa regra.
                        </div>

                    </div>
                </div>
            </div>

        </div>

        {{-- Modal de Lead (Mantido igual) --}}
        <div x-show="showLeadModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showLeadModal" x-transition.opacity class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" aria-hidden="true" @click="showLeadModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="showLeadModal" x-transition.scale class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-brand-gold/10 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-brand-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-black text-gray-900" id="modal-title">Receber Simulação Detalhada</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 mb-4">
                                        Para visualizar o resultado completo e receber o relatório oficial em PDF, por favor indique o seu contacto.
                                    </p>
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Nome Completo *</label>
                                            <input type="text" x-model="form.lead_name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-gold focus:ring-brand-gold sm:text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">E-mail *</label>
                                            <input type="email" x-model="form.lead_email" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-gold focus:ring-brand-gold sm:text-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" @click="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-brand-black text-base font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-gold sm:ml-3 sm:w-auto sm:text-sm">
                            Ver Resultados e Receber PDF
                        </button>
                        <button type="button" @click="showLeadModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function gainsForm() {
        return {
            hasCalculated: false,
            showLeadModal: false,
            form: {
                acquisition_value: '',
                acquisition_year: 2010,
                acquisition_month: 'Janeiro',
                sale_value: '',
                sale_year: 2025,
                sale_month: 'Janeiro',
                has_expenses: 'Não',
                expenses_works: '',
                expenses_imt: '',
                expenses_commission: '',
                expenses_other: '',
                sold_to_state: 'Não',
                hpp_status: 'Sim',
                amortize_credit: 'Não',
                amortization_amount: '',
                joint_tax_return: 'Não',
                annual_income: '',
                public_support: 'Não',
                public_support_year: 2020,
                public_support_month: 'Janeiro',
                retired_status: 'Não', 
                self_built: 'Não', 
                reinvest_intention: 'Não',
                reinvestment_amount: '',
                lead_name: '',
                lead_email: ''
            },
            results: {
                sale_fmt: '0,00',
                coefficient: '1,00',
                acquisition_updated_fmt: '0,00',
                expenses_fmt: '0,00',
                reinvestment_fmt: '0,00',
                gross_gain_fmt: '0,00',
                taxable_gain_fmt: '0,00',
                estimated_tax_fmt: '0,00',
                status: ''
            },
            
            resetHPPFields() {
                if(this.form.sold_to_state === 'Sim') {
                    this.form.hpp_status = 'Não'; 
                }
                this.resetReinvestmentFields();
            },

            resetReinvestmentFields() {
                 if(this.form.hpp_status !== 'Sim') {
                    this.form.reinvest_intention = 'Não';
                    this.form.reinvestment_amount = '';
                    // NOTA: Amortização não é resetada aqui pois pode ser usada para secundários
                    this.form.retired_status = 'Não'; 
                }
            },
            
            openModal() {
                if(!this.form.acquisition_value || !this.form.sale_value) {
                    alert("Por favor, preencha pelo menos os valores de aquisição e venda.");
                    return;
                }
                this.showLeadModal = true;
            },

            async submit() {
                if(!this.form.lead_name || !this.form.lead_email) {
                    alert("Por favor, preencha seu nome e e-mail para continuar.");
                    return;
                }

                try {
                    if(this.form.sold_to_state === 'Sim') {
                        this.form.annual_income = 0; 
                    }

                    const response = await fetch('{{ route('tools.gains.calculate') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(this.form)
                    });
                    
                    if (!response.ok) {
                        alert('Verifique se preencheu todos os campos obrigatórios corretamente.');
                        return;
                    }

                    this.results = await response.json();
                    this.hasCalculated = true;
                    this.showLeadModal = false; 
                    
                    this.$nextTick(() => {
                        this.$el.querySelector('.bg-orange-500').scrollIntoView({ behavior: 'smooth', block: 'center' });
                    });

                } catch (e) {
                    console.error("Erro no cálculo:", e);
                }
            }
        }
    }
</script>
@endsection