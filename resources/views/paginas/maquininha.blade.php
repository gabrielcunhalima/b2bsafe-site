{{-- Página Maquininha C6 Pay (US-003, RF-002, wireframe T-02). WhatsApp próprio: (11) 92460-0991 (RN-021). --}}
@php
    use App\Support\Telefone;
    use App\Support\WhatsApp;

    $config = config('b2bsafe.maquininha');
    $linkMaquininha = WhatsApp::linkDoServico('maquininha');
    $referencia = \Illuminate\Support\Carbon::parse($config['taxas_referencia_em'])->format('d/m/Y');
    $vantagens = [
        ['icone' => 'badge-percent', 'titulo' => 'Adesão zero', 'texto' => 'Adesão e mensalidade zero para quem vende a partir de R$ 5 mil por mês e recebe pelo C6 Bank.'],
        ['icone' => 'wifi', 'titulo' => 'Wi-Fi ou chip', 'texto' => 'Chip e plano de dados grátis. A máquina funciona também no Wi-Fi.'],
        ['icone' => 'calendar-clock', 'titulo' => 'Parcele em até 12x', 'texto' => 'Venda parcelado e receba os pagamentos em até 2 dias úteis.'],
        ['icone' => 'shuffle', 'titulo' => 'Multiadquirência', 'texto' => 'A máquina escolhe a bandeira com a melhor taxa para cada venda.'],
        ['icone' => 'chart-no-axes-combined', 'titulo' => 'Portal C6 Pay', 'texto' => 'Acompanhe os recebimentos em tempo real pelo portal.'],
        ['icone' => 'credit-card', 'titulo' => 'Principais bandeiras', 'texto' => 'Aceita as principais bandeiras do mercado no débito e no crédito.'],
    ];
@endphp

<x-layouts.site titulo="Maquininha C6 Pay" whatsapp="maquininha"
    descricao="Maquininha C6 Pay com adesão zero, parcelamento em até 12x e recebimento em até 2 dias úteis. Peça a sua com a B2BSAFE, escritório parceiro C6 Empresas.">

    {{-- Apresentação --}}
    <section class="fundo-escuro overflow-hidden bg-preto text-white">
        <div class="mx-auto grid max-w-6xl items-center gap-12 px-4 py-16 md:py-24 lg:grid-cols-2">
            <div>
                <h1 class="text-4xl leading-tight font-extrabold md:text-6xl">
                    C6 Pay: <span class="text-amarelo">soluções completas de pagamento.</span>
                </h1>
                <p class="mt-6 max-w-xl text-lg leading-relaxed text-white/80">
                    Adesão zero, parcelamento em até 12x e recebimento em até 2 dias úteis. Custo zero, segura e digital,
                    com o atendimento de um escritório parceiro oficial do C6 Empresas.
                </p>
                <div class="mt-10 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ $linkMaquininha }}" target="_blank" rel="noopener noreferrer" data-whatsapp="maquininha-topo" data-servico="maquininha"
                       class="inline-flex items-center justify-center gap-2 rounded bg-amarelo px-6 py-3 font-semibold text-preto transition-colors hover:bg-amarelo-hover">
                        <x-icone-marca nome="whatsapp" class="size-5" /> Quero minha C6 Pay
                        <span class="sr-only">(abre o WhatsApp em nova aba)</span>
                    </a>
                    <a href="#pedir" data-servico="conta_corrente"
                       class="inline-flex items-center justify-center gap-2 rounded border border-white/40 px-6 py-3 font-semibold text-white transition-colors hover:bg-white/10">
                        Abrir conta grátis <i data-lucide="arrow-right" class="size-4" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="relative mx-auto w-full max-w-md lg:max-w-none">
                <div class="absolute inset-[8%] rounded-full bg-amarelo" aria-hidden="true"></div>
                <img src="{{ asset('img/maquininha-c6-pay.webp') }}" width="900" height="843" fetchpriority="high"
                     alt="Maquininha C6 Pay com tela de pagamento e teclado, aceitando Elo, Mastercard, Hipercard e Visa"
                     class="relative w-full drop-shadow-2xl">
            </div>
        </div>
    </section>

    {{-- Vantagens --}}
    <section aria-labelledby="vantagens" class="bg-fundo">
        <div class="mx-auto max-w-6xl px-4 py-16 md:py-24">
            <h2 id="vantagens" class="text-3xl font-extrabold text-preto md:text-4xl">Vantagens da C6 Pay</h2>
            <p class="mt-3 max-w-2xl text-lg text-texto-suave">Tudo o que o seu negócio precisa para vender mais, pagando menos.</p>
            <ul class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($vantagens as $vantagem)
                    <li class="rounded-xl border border-borda p-6">
                        <span class="flex size-12 items-center justify-center rounded-lg bg-gelo text-preto">
                            <i data-lucide="{{ $vantagem['icone'] }}" class="size-6" aria-hidden="true"></i>
                        </span>
                        <h3 class="mt-5 text-lg font-bold text-preto">{{ $vantagem['titulo'] }}</h3>
                        <p class="mt-2 text-texto-suave">{{ $vantagem['texto'] }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- Taxas de referência (valores em configuração) --}}
    <section id="taxas" aria-labelledby="titulo-taxas" class="bg-gelo">
        <div class="mx-auto grid max-w-6xl gap-10 px-4 py-16 md:py-24 lg:grid-cols-[1fr_1.4fr]">
            <div>
                <h2 id="titulo-taxas" class="text-3xl font-extrabold text-preto md:text-4xl">Taxas</h2>
                <p class="mt-3 text-lg text-texto-suave">
                    Valores de referência, sujeitos a análise do C6 Bank. Variam conforme o plano, o faturamento e o prazo de recebimento.
                </p>
                <a href="{{ WhatsApp::link('maquininha', 'Olá! Vim pelo site e quero simular a taxa da maquininha C6 Pay para o meu negócio.') }}"
                   target="_blank" rel="noopener noreferrer" data-whatsapp="maquininha-taxas" data-servico="maquininha"
                   class="mt-8 inline-flex items-center justify-center gap-2 rounded bg-whatsapp px-6 py-3 font-semibold text-white transition-colors hover:bg-[#054a42]">
                    <x-icone-marca nome="whatsapp" class="size-5" /> Simular a taxa do meu negócio
                    <span class="sr-only">(abre o WhatsApp em nova aba)</span>
                </a>
            </div>
            <div>
                <div class="overflow-x-auto rounded-xl bg-fundo shadow-sm">
                    <table class="w-full text-left">
                        <caption class="sr-only">Taxas de referência da C6 Pay por modalidade</caption>
                        <thead class="bg-preto text-white">
                            <tr>
                                <th scope="col" class="px-5 py-4 font-semibold">Modalidade</th>
                                <th scope="col" class="px-5 py-4 text-right font-semibold">Taxa (a partir de)</th>
                                <th scope="col" class="px-5 py-4 font-semibold">Recebimento</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-borda">
                            @foreach ($config['taxas'] as $linha)
                                <tr>
                                    <th scope="row" class="px-5 py-4 font-semibold text-preto">{{ $linha['modalidade'] }}</th>
                                    <td class="px-5 py-4 text-right text-lg font-extrabold text-preto">{{ $linha['taxa'] }}</td>
                                    <td class="px-5 py-4 text-texto-suave">{{ $linha['recebimento'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p class="mt-3 text-sm text-texto-suave">Referência: site oficial do C6 Bank, consultado em {{ $referencia }}.</p>
            </div>
        </div>
    </section>

    {{-- Condições e bandeiras --}}
    <section aria-labelledby="condicoes" class="bg-fundo">
        <div class="mx-auto grid max-w-6xl gap-10 px-4 py-16 md:py-24 lg:grid-cols-2">
            <div>
                <h2 id="condicoes" class="text-3xl font-extrabold text-preto md:text-4xl">Condições</h2>
                <ul class="mt-6 space-y-4 text-lg text-texto-suave">
                    <li class="flex gap-3"><i data-lucide="check" class="mt-1 size-5 shrink-0 text-preto" aria-hidden="true"></i> C6 Pay Smart com adesão e mensalidade zero para quem vende a partir de R$ 5 mil por mês e recebe o valor pelo C6 Bank.</li>
                    <li class="flex gap-3"><i data-lucide="check" class="mt-1 size-5 shrink-0 text-preto" aria-hidden="true"></i> Plano de dados grátis: funciona com chip e Wi-Fi.</li>
                    <li class="flex gap-3"><i data-lucide="check" class="mt-1 size-5 shrink-0 text-preto" aria-hidden="true"></i> A C6 Pay é uma plataforma de soluções para clientes pessoa jurídica.</li>
                </ul>
            </div>
            <div class="rounded-2xl bg-gelo p-8">
                <h2 class="text-2xl font-extrabold text-preto">Aceita as principais bandeiras</h2>
                <p class="mt-2 text-texto-suave">Com multiadquirência, a máquina escolhe a melhor taxa para cada venda.</p>
                <ul class="mt-6 flex flex-wrap gap-3" aria-label="Bandeiras aceitas">
                    @foreach ($config['bandeiras'] as $bandeira)
                        <li class="rounded-full bg-fundo px-4 py-2 font-semibold text-preto shadow-sm">{{ $bandeira }}</li>
                    @endforeach
                    <li class="rounded-full bg-fundo px-4 py-2 text-texto-suave shadow-sm">e outras</li>
                </ul>
            </div>
        </div>
    </section>

    {{-- Pedir a C6 Pay: formulário com o serviço Maquininha já escolhido (RF-006) --}}
    <section id="pedir" class="bg-gelo">
        <div id="contato" class="mx-auto grid max-w-6xl gap-10 px-4 py-16 md:py-24 lg:grid-cols-[1fr_1.3fr]">
            <div>
                <h2 class="text-3xl font-extrabold text-preto md:text-4xl">Peça sua C6 Pay</h2>
                <p class="mt-3 max-w-lg text-lg text-texto-suave">
                    Deixe seus dados e um especialista da B2BSAFE fala com você. Se preferir, chame no WhatsApp da maquininha:
                    <a href="{{ $linkMaquininha }}" target="_blank" rel="noopener noreferrer" data-whatsapp="maquininha-pedir" data-servico="maquininha"
                       class="rounded font-semibold whitespace-nowrap text-preto underline">{{ Telefone::formatar(config('b2bsafe.whatsapp.maquininha')) }}</a>.
                </p>
            </div>
            <x-formulario-lead servico="maquininha" />
        </div>
    </section>
</x-layouts.site>
