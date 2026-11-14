{{-- Home institucional (US-002, RF-001, wireframe T-01). Fotos e licenças em docs/marca/fotos-licencas.md --}}
@php
    use App\Support\Telefone;
    use App\Support\WhatsApp;

    $servicos = config('b2bsafe.servicos');
    $vitrine = config('b2bsafe.vitrine');
    $whatsappGeral = config('b2bsafe.whatsapp.geral');
    $whatsappMaquininha = config('b2bsafe.whatsapp.maquininha');
    $email = config('b2bsafe.email_contato');
    $credenciadas = [...config('b2bsafe.empresas'), ...config('b2bsafe.escritorios_parceiros')];

    $titulo = 'text-3xl leading-tight font-extrabold tracking-tight text-preto md:text-5xl';
    // Hover sem zoom nem deslocamento: só a cor muda
    $botaoPreto = 'inline-flex items-center justify-center gap-2 rounded-full bg-preto px-7 py-3.5 font-semibold text-white transition-colors hover:bg-preto-hover';
@endphp

<x-layouts.site>
    @push('head')
        {{-- Dados estruturados da empresa com os dois endereços (RF-011) --}}
        <script type="application/ld+json">{!! json_encode(\App\Support\Seo::dadosEstruturados(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
    @endpush

    {{-- Apresentação: ocupa toda a largura da página, como as seções Sobre e Fale conosco --}}
    <section class="relative overflow-hidden bg-gelo">
        <div class="pontilhado pointer-events-none absolute inset-0 opacity-60" aria-hidden="true"></div>
        <div class="relative grid w-full items-center gap-14 px-4 pt-12 pb-10 md:px-10 md:pt-16 lg:grid-cols-[1.1fr_1fr] lg:pb-14 xl:px-16">
            <div data-revelar>
                <h1 class="text-5xl leading-[1.05] font-extrabold tracking-tight text-preto md:text-7xl">
                    Sua empresa em boas mãos.
                </h1>
                <p class="mt-6 max-w-xl text-lg leading-relaxed text-texto-suave md:text-xl">
                    Solução financeira com parceria, orientação e segurança para impulsionar o crescimento da sua empresa.
                </p>
                <ul class="mt-7 space-y-3 text-texto">
                    @foreach ([
                        'Conta PJ sem tarifa, com Pix ilimitado e boletos grátis',
                        'Crédito, câmbio, investimentos e maquininha C6 Pay',
                        'Um especialista da B2BSAFE do primeiro contato em diante',
                    ] as $vantagem)
                        <li class="flex items-start gap-3">
                            <span class="mt-0.5 flex size-6 shrink-0 items-center justify-center rounded-full bg-amarelo text-preto">
                                <i data-lucide="check" class="size-4" aria-hidden="true"></i>
                            </span>
                            {{ $vantagem }}
                        </li>
                    @endforeach
                </ul>
                <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                    <a href="#contato" class="{{ $botaoPreto }}">
                        Quero abrir minha conta <i data-lucide="arrow-right" class="size-4" aria-hidden="true"></i>
                    </a>
                    <x-botao-whatsapp :href="WhatsApp::link()">Falar no WhatsApp</x-botao-whatsapp>
                </div>
                <p class="mt-7 flex items-center gap-2 text-sm text-texto-suave">
                    <i data-lucide="lock" class="size-4 text-preto" aria-hidden="true"></i>
                    Escritório credenciado C6 Empresas ·
                    <a href="#credenciamento" class="rounded font-semibold text-preto underline">verifique</a>
                </p>
            </div>

            {{-- Porta aberta para novos negócios: a foto em arco e, atrás dela, um arco amarelo deslocado para cima e para a esquerda,
                 com um arco cinza do lado oposto (duas portas, a B2BSAFE e a empresa do cliente) --}}
            <div class="relative mx-auto w-full max-w-md px-6 py-6 lg:max-w-2xl" data-revelar>
                <div class="absolute top-0 right-12 bottom-12 left-0 rounded-t-[14rem] rounded-b-[2rem] bg-amarelo" aria-hidden="true"></div>
                <div class="absolute top-12 right-0 bottom-0 left-12 rounded-t-[14rem] rounded-b-[2rem] bg-[#dcdfe4]" aria-hidden="true"></div>
                <img src="{{ asset('img/foto-aperto-de-maos.webp') }}" width="1125" height="900" fetchpriority="high"
                     alt="Dois empresários de terno sorrindo e apertando as mãos numa mesa de reunião"
                     class="relative aspect-[1/1] w-full rounded-t-[14rem] rounded-b-[2rem] object-cover object-[60%_center] shadow-2xl">
            </div>
        </div>
    </section>

    {{-- Serviços em cards pequenos logo abaixo do topo: cada um abre o WhatsApp citando o serviço (RN-021) --}}
    @php
        $descricoes = [...array_map(fn ($card) => $card, $vitrine), 'maquininha' => ['descricao' => 'Parcele em até 12x e receba em até 2 dias úteis.', 'icone' => 'store']];
    @endphp
    <section id="servicos" aria-labelledby="titulo-servicos" class="bg-gelo">
        <div class="w-full px-4 py-8 md:px-10 md:py-10 xl:px-16">
            <h2 id="titulo-servicos" class="text-2xl font-extrabold text-preto">Soluções para sua empresa</h2>
            {{-- Cards amarelos (texto preto: contraste 13,4:1), todos numa linha só no computador --}}
            <ul class="mt-6 grid grid-cols-2 gap-3 md:grid-cols-4 lg:grid-cols-8">
                @foreach (array_keys($servicos) as $chave)
                    @continue(! isset($descricoes[$chave]))
                    <li>
                        <a href="{{ WhatsApp::linkDoServico($chave) }}" target="_blank" rel="noopener noreferrer"
                           data-whatsapp="home" data-servico="{{ $chave }}"
                           class="group flex h-full flex-col rounded-2xl bg-amarelo p-4 text-preto shadow-sm transition-colors duration-200 hover:bg-amarelo-hover focus-visible:bg-amarelo-hover">
                            <span class="flex items-start justify-between">
                                <span class="flex size-10 items-center justify-center rounded-xl bg-preto text-amarelo">
                                    <i data-lucide="{{ $descricoes[$chave]['icone'] }}" class="size-5" aria-hidden="true"></i>
                                </span>
                                <i data-lucide="arrow-up-right" class="size-4" aria-hidden="true"></i>
                            </span>
                            <span class="mt-3 leading-tight font-bold">{{ $servicos[$chave] }}</span>
                            <span class="mt-1 text-sm leading-snug text-preto/75">{{ $descricoes[$chave]['descricao'] }}</span>
                            <span class="sr-only">(fale com um atendente no WhatsApp, abre em nova aba)</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- Sobre e Conta PJ numa seção só, ocupando toda a largura da página (sem o container) e no mesmo fundo da hero: o selo Conexão Awards 2025 é a única imagem --}}
    <section id="sobre" aria-labelledby="titulo-sobre" class="bg-gelo">
        <div class="grid w-full items-center gap-12 px-4 py-14 md:px-10 md:py-20 lg:grid-cols-[5fr_6fr] lg:gap-16 xl:px-16">
            <figure class="mx-auto w-full max-w-md lg:max-w-xl" data-revelar>
                <img src="{{ asset('img/conexao-awards-2025.webp') }}" width="487" height="487" loading="lazy"
                     alt="Selo Conexão Awards 2025 do C6 Empresas: B2BSAFE, destaque de 2025, reconhecimento por transformar consistência em resultados de alto nível"
                     class="w-full rounded-[2rem] shadow-2xl">
                <figcaption class="sr-only">Escritório destaque 2025 · Conexão Awards C6 Empresas</figcaption>
            </figure>

            <div data-revelar>
                <h2 id="titulo-sobre" class="{{ $titulo }}">Sua empresa e seus investimentos em total segurança.</h2>
                <div class="mt-6 space-y-4 text-lg leading-relaxed text-texto-suave">
                    <p>
                        B2B é negócio para negócio. Atendemos pequenas e médias empresas com a oferta exclusiva do C6 Empresas,
                        moldando nossa atuação ao modelo e às necessidades de cada cliente.
                    </p>
                    <p>
                        No ambiente digital, o cadeado é o nosso símbolo: proteger seus ativos e prevenir riscos em investimentos,
                        negócios, transferências e pagamentos.
                    </p>
                </div>

                <div id="conta-pj" class="mt-10 rounded-3xl bg-fundo p-6 shadow-sm md:p-8">
                    <h3 class="text-2xl leading-snug font-extrabold text-preto">Abra a conta PJ da sua empresa com quem entende do C6.</h3>
                    <p class="mt-3 leading-relaxed text-texto-suave">
                        Conta completa e sem tarifa, com Pix ilimitado, boletos de cobrança grátis todo mês e gestão pelo app ou pelo web banking.
                        A B2BSAFE acompanha a abertura com você, do primeiro contato à conta funcionando.
                    </p>
                    <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                        <a href="#contato" data-servico="conta_corrente" class="{{ $botaoPreto }}">
                            Quero abrir minha conta <i data-lucide="arrow-right" class="size-4" aria-hidden="true"></i>
                        </a>
                        <x-botao-whatsapp :href="WhatsApp::linkDoServico('conta_corrente')" servico="conta_corrente">Falar no WhatsApp</x-botao-whatsapp>
                    </div>
                </div>

                <p class="mt-8 text-2xl font-extrabold text-preto">B2BSAFE, Be Safe!</p>
            </div>
        </div>
    </section>

    {{-- Maquininha C6 Pay: fundo preto em toda a largura, com o WhatsApp da maquininha (RN-021) --}}
    <section id="maquininha" class="fundo-escuro relative overflow-hidden bg-preto text-white">
        <div class="pontilhado-claro pointer-events-none absolute inset-0 opacity-40" aria-hidden="true"></div>
        <div class="relative grid w-full items-center gap-10 px-4 py-14 md:px-10 md:py-20 lg:grid-cols-2 xl:px-16">
            <div class="relative" data-revelar>
                <h2 class="text-3xl leading-tight font-extrabold tracking-tight md:text-5xl">
                    Maquininha C6 Pay: <span class="text-amarelo">venda mais, pague menos.</span>
                </h2>
                <ul class="mt-10 grid gap-4 sm:grid-cols-3">
                    @foreach ([['calendar-clock', 'Parcele em até 12x e receba em até 2 dias úteis'], ['wifi', 'Chip e plano de dados grátis, e funciona também no Wi-Fi'], ['shuffle', 'A máquina escolhe a bandeira com a melhor taxa']] as [$icone, $texto])
                        <li class="rounded-2xl bg-white/5 p-5 ring-1 ring-white/10">
                            <i data-lucide="{{ $icone }}" class="size-6 text-amarelo" aria-hidden="true"></i>
                            <p class="mt-3 text-white/85">{{ $texto }}</p>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-10 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ WhatsApp::linkDoServico('maquininha') }}" target="_blank" rel="noopener noreferrer"
                       data-whatsapp="home" data-servico="maquininha"
                       class="inline-flex items-center justify-center gap-2 rounded-full bg-amarelo px-7 py-3.5 font-semibold text-preto transition-colors hover:bg-amarelo-hover">
                        <x-icone-marca nome="whatsapp" class="size-5" /> Quero minha C6 Pay
                        <span class="sr-only">(abre o WhatsApp em nova aba)</span>
                    </a>
                    @if (Route::has('maquininha'))
                        <a href="{{ route('maquininha') }}" class="inline-flex items-center justify-center gap-2 rounded-full px-7 py-3.5 font-semibold text-white ring-1 ring-white/40 transition-colors hover:bg-white/10">
                            Ver taxas e condições <i data-lucide="arrow-right" class="size-4" aria-hidden="true"></i>
                        </a>
                    @endif
                </div>
                <!-- <p class="mt-6 text-sm text-white/70">WhatsApp da maquininha: {{ Telefone::formatar($whatsappMaquininha) }}</p> -->
            </div>

            {{-- Imagem da C6 Pay (fundo transparente) sobre um círculo amarelo, para a máquina preta não sumir no fundo preto --}}
            <div class="relative mx-auto w-full max-w-md lg:max-w-none" data-revelar>
                <div class="absolute inset-[2%] rounded-full bg-amarelo" aria-hidden="true"></div>
                <img src="{{ asset('img/maquininha-c6-pay.webp') }}" width="900" height="843" loading="lazy"
                     alt="Maquininha C6 Pay com tela de pagamento e teclado, aceitando Elo, Mastercard, Hipercard e Visa"
                     class="relative w-full drop-shadow-2xl">
            </div>
        </div>
    </section>

    {{-- Como trabalhamos: trilha de 3 passos ligados por uma linha tracejada (no celular, um embaixo do outro) --}}
    <section aria-labelledby="titulo-como" class="bg-gelo">
        <div class="mx-auto max-w-6xl px-4 pt-12 pb-4 md:pt-16 md:pb-6">
            <h2 id="titulo-como" class="{{ $titulo }} lg:whitespace-nowrap" data-revelar>Como a B2BSAFE trabalha com você</h2>
            <div class="relative mt-10">
                <div class="pointer-events-none absolute top-7 right-[16.67%] left-[16.67%] hidden h-0.5 bg-[length:14px_2px] bg-repeat-x md:block"
                     style="background-image: linear-gradient(to right, rgb(6 6 6 / 0.3) 55%, transparent 55%)" aria-hidden="true"></div>
                <ol class="relative grid gap-8 md:grid-cols-3">
                    @foreach ([
                        ['message-square-text', 'Você conta o que precisa', 'Pelo WhatsApp ou pelo formulário, sem compromisso e sem burocracia.'],
                        ['clipboard-list', 'Um especialista monta a solução', 'Entendemos o momento da sua empresa e indicamos os produtos do C6 Empresas que fazem sentido.'],
                        ['rocket', 'A gente acompanha de perto', 'Da abertura da conta à maquininha funcionando, com atendimento próximo do começo ao fim.'],
                    ] as $indice => [$icone, $passo, $texto])
                        <li class="flex flex-col items-center text-center" data-revelar>
                            <span class="relative z-10 flex size-14 items-center justify-center rounded-full bg-amarelo text-xl font-extrabold text-preto ring-8 ring-gelo" aria-hidden="true">{{ $indice + 1 }}</span>
                            <div class="mt-6 flex w-full flex-1 flex-col items-center rounded-3xl bg-fundo px-6 py-8 shadow-sm">
                                <span class="flex size-12 items-center justify-center rounded-2xl bg-preto text-amarelo">
                                    <i data-lucide="{{ $icone }}" class="size-6" aria-hidden="true"></i>
                                </span>
                                <h3 class="mt-5 text-xl font-bold text-preto"><span class="sr-only">Passo {{ $indice + 1 }}: </span>{{ $passo }}</h3>
                                <p class="mt-2 max-w-xs text-texto-suave">{{ $texto }}</p>
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </section>

    {{-- Parcerias / Trabalhe conosco: os botões levam ao Fale conosco com o serviço "parceria" --}}
    <section id="parcerias" class="bg-gelo">
        <div class="mx-auto max-w-6xl px-4 pt-12 pb-4 md:pt-16 md:pb-6">
            <h2 class="{{ $titulo }}" data-revelar>Parcerias</h2>
            <p class="mt-4 text-lg text-texto-suave" data-revelar>Trabalhe conosco ou seja parceiro, você escolhe.</p>

            <div class="mt-8 grid gap-6 md:grid-cols-2">
                @foreach ([
                    ['foto-parceria', 'Mãos sobre a mesa com caderno, tablet e café numa conversa de negócios', 'handshake', 'Seja parceiro de negócios', 'Seja remunerado por indicar empresas que você conhece. Atendemos pequenas e médias empresas com faturamento de R$ 1 a R$ 50 milhões.', 'Quero ser parceiro'],
                    ['foto-equipe', 'Duas profissionais trabalhando juntas no notebook num escritório', 'users-round', 'Seja parte da equipe', 'Buscamos profissionais com perfil comercial, iniciativa e interesse em uma parceria de longo prazo, com remuneração por resultados.', 'Quero trabalhar na B2BSAFE'],
                ] as [$foto, $alt, $icone, $tituloCard, $texto, $botao])
                    <article class="flex flex-col overflow-hidden rounded-3xl bg-fundo text-preto shadow-sm" data-revelar>
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ asset('img/'.$foto.'.webp') }}" loading="lazy" alt="{{ $alt }}"
                                 class="size-full object-cover">
                            <span class="absolute top-4 left-4 flex size-12 items-center justify-center rounded-2xl bg-amarelo text-preto shadow-lg">
                                <i data-lucide="{{ $icone }}" class="size-6" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="flex flex-1 flex-col p-8">
                            <h3 class="text-2xl font-bold text-preto">{{ $tituloCard }}</h3>
                            <p class="mt-3 flex-1 text-texto-suave">{{ $texto }}</p>
                            <a href="#contato" data-servico="parceria" class="{{ $botaoPreto }} mt-7 self-start">
                                {{ $botao }} <i data-lucide="arrow-right" class="size-4" aria-hidden="true"></i>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Credenciamento: seção própria antes do Fale conosco, com os dois jeitos de conferir no C6 (RN-015) --}}
    @php
        $passo = 'flex size-7 shrink-0 items-center justify-center rounded-full bg-amarelo text-sm font-extrabold text-preto';
        $botaoCartao = $botaoPreto.' mt-auto self-start px-5! py-2.5! text-sm';
    @endphp
    <section id="credenciamento" aria-labelledby="titulo-credenciamento" class="bg-gelo">
        <div class="w-full px-4 pt-14 pb-4 md:px-10 md:pt-20 xl:px-16">
            <div class="flex items-start gap-4" data-revelar>
                <span class="flex size-14 shrink-0 items-center justify-center rounded-2xl bg-preto text-amarelo">
                    <i data-lucide="shield-check" class="size-7" aria-hidden="true"></i>
                </span>
                <div>
                    <h2 id="titulo-credenciamento" class="{{ $titulo }}">Verifique nosso credenciamento</h2>
                    <p class="mt-3 max-w-2xl text-lg text-texto-suave">
                        Somos escritório parceiro C6 Empresas. Você pode confirmar isso direto no C6 Bank, de dois jeitos.
                    </p>
                </div>
            </div>

            <div class="mt-10 grid gap-5 lg:grid-cols-3">
                {{-- Jeito 1: lista oficial em PDF --}}
                <article class="flex flex-col rounded-3xl bg-fundo p-6 shadow-sm md:p-8" data-revelar>
                    <span class="flex size-11 items-center justify-center rounded-2xl bg-gelo text-preto">
                        <i data-lucide="file-text" class="size-5" aria-hidden="true"></i>
                    </span>
                    <h3 class="mt-4 text-xl font-extrabold text-preto">Pela lista oficial de parceiros</h3>
                    <p class="mt-1 text-sm text-texto-suave">O jeito mais rápido: o PDF do C6 com todos os escritórios credenciados.</p>
                    <ol class="mt-5 mb-6 space-y-3">
                        <li class="flex gap-3"><span class="{{ $passo }}" aria-hidden="true">1</span><span><span class="sr-only">Passo 1: </span>Abra a lista oficial de escritórios parceiros do C6 Empresas.</span></li>
                        <li class="flex gap-3"><span class="{{ $passo }}" aria-hidden="true">2</span><span><span class="sr-only">Passo 2: </span>Procure por “B2BSAFE”: Ctrl + F no computador (Cmd + F no Mac) ou a lupa do leitor de PDF no celular.</span></li>
                        <li class="flex gap-3"><span class="{{ $passo }}" aria-hidden="true">3</span><span><span class="sr-only">Passo 3: </span>Confira se o CNPJ é um dos nossos, ao lado.</span></li>
                    </ol>
                    <a href="{{ config('b2bsafe.verificacao_c6') }}" target="_blank" rel="noopener noreferrer" class="{{ $botaoCartao }}">
                        Abrir lista oficial <i data-lucide="external-link" class="size-4" aria-hidden="true"></i>
                        <span class="sr-only">(PDF no site do C6 Bank, abre em nova aba)</span>
                    </a>
                </article>

                {{-- Jeito 2: página Parceiro C6 Empresas no site do C6 Bank --}}
                <article class="flex flex-col rounded-3xl bg-fundo p-6 shadow-sm md:p-8" data-revelar>
                    <span class="flex size-11 items-center justify-center rounded-2xl bg-gelo text-preto">
                        <i data-lucide="globe" class="size-5" aria-hidden="true"></i>
                    </span>
                    <h3 class="mt-4 text-xl font-extrabold text-preto">Pelo site do C6 Bank</h3>
                    <p class="mt-1 text-sm text-texto-suave">Pela página de parceiros do C6 Empresas, na área de consulta de escritórios.</p>
                    <ol class="mt-5 mb-6 space-y-3">
                        <li class="flex gap-3"><span class="{{ $passo }}" aria-hidden="true">1</span><span><span class="sr-only">Passo 1: </span>Acesse a página “Parceiro C6 Empresas” no site do C6 Bank.</span></li>
                        <li class="flex gap-3"><span class="{{ $passo }}" aria-hidden="true">2</span><span><span class="sr-only">Passo 2: </span>Vá até a área “Tem uma empresa e quer consultar nossos escritórios autorizados”.</span></li>
                        <li class="flex gap-3"><span class="{{ $passo }}" aria-hidden="true">3</span><span><span class="sr-only">Passo 3: </span>Consulte pelo nome ou pelo CNPJ e veja a B2BSAFE na lista.</span></li>
                    </ol>
                    <a href="{{ config('b2bsafe.verificacao_c6_pagina') }}" target="_blank" rel="noopener noreferrer" class="{{ $botaoCartao }}">
                        Ir ao site do C6 Bank <i data-lucide="external-link" class="size-4" aria-hidden="true"></i>
                        <span class="sr-only">(abre em nova aba)</span>
                    </a>
                </article>

                {{-- Os CNPJs para conferir, com botão de copiar --}}
                <article class="flex flex-col rounded-3xl bg-preto p-6 text-white shadow-sm md:p-8 fundo-escuro" data-revelar>
                    <span class="flex size-11 items-center justify-center rounded-2xl bg-amarelo text-preto">
                        <i data-lucide="building-2" class="size-5" aria-hidden="true"></i>
                    </span>
                    <h3 class="mt-4 text-xl font-extrabold">Nossas empresas credenciadas</h3>
                    <p class="mt-1 text-sm text-white/70">Copie o CNPJ para colar na busca.</p>
                    <ul class="mt-5 space-y-2">
                        @foreach ($credenciadas as $empresa)
                            <li class="flex flex-wrap items-center justify-between gap-x-3 gap-y-2 rounded-2xl bg-white/5 px-4 py-3 ring-1 ring-white/10"
                                x-data="{ copiado: false }">
                                <span class="min-w-0">
                                    <span class="block font-bold">{{ $empresa['nome'] }}</span>
                                    <span class="block text-sm text-white/70">CNPJ {{ $empresa['cnpj'] }}</span>
                                </span>
                                <button type="button"
                                        @click="navigator.clipboard?.writeText(@js($empresa['cnpj'])).then(() => { copiado = true; setTimeout(() => copiado = false, 2000) })"
                                        class="inline-flex items-center gap-1.5 rounded-full bg-amarelo px-3 py-1.5 text-sm font-semibold text-preto transition-colors hover:bg-amarelo-hover">
                                    <i data-lucide="copy" class="size-4" x-show="! copiado" aria-hidden="true"></i>
                                    <i data-lucide="check" class="size-4" x-show="copiado" x-cloak aria-hidden="true"></i>
                                    <span x-text="copiado ? 'Copiado' : 'Copiar CNPJ'">Copiar CNPJ</span>
                                    <span class="sr-only">de {{ $empresa['nome'] }}</span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </article>
            </div>
        </div>
    </section>

    {{-- Fale conosco: ocupa toda a largura da página (sem o container), no mesmo fundo da hero (RF-006, T-03) --}}
    <section id="contato" aria-labelledby="titulo-contato" class="bg-gelo">
        <div class="grid w-full gap-12 px-4 py-14 md:px-10 md:py-20 lg:grid-cols-[1fr_1.2fr] lg:gap-16 xl:px-16">
            <div data-revelar>
                <h2 id="titulo-contato" class="{{ $titulo }}">Fale conosco</h2>
                <p class="mt-4 max-w-lg text-lg text-texto-suave">
                    Deixe seus dados e um especialista da B2BSAFE entra em contato. Se preferir, chame no WhatsApp ou mande um e-mail.
                </p>
                <ul class="mt-8 space-y-3">
                    <li>
                        <a href="{{ WhatsApp::link() }}" target="_blank" rel="noopener noreferrer" data-whatsapp="contato"
                           class="flex items-center gap-4 rounded-2xl border border-borda bg-fundo p-4 transition-colors hover:border-preto">
                            <span class="flex size-12 items-center justify-center rounded-full bg-whatsapp text-white">
                                <x-icone-marca nome="whatsapp" class="size-5" />
                            </span>
                            <span>
                                <span class="block font-bold text-preto">WhatsApp</span>
                                <span class="block text-texto-suave">{{ Telefone::formatar($whatsappGeral) }}</span>
                            </span>
                            <span class="sr-only">(abre o WhatsApp em nova aba)</span>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:{{ $email }}?subject={{ rawurlencode('Contato pelo site da B2BSAFE') }}"
                           class="flex items-center gap-4 rounded-2xl border border-borda bg-fundo p-4 transition-colors hover:border-preto">
                            <span class="flex size-12 items-center justify-center rounded-full bg-amarelo text-preto">
                                <i data-lucide="mail" class="size-5" aria-hidden="true"></i>
                            </span>
                            <span>
                                <span class="block font-bold text-preto">E-mail</span>
                                <span class="block break-all text-texto-suave">{{ $email }}</span>
                            </span>
                        </a>
                    </li>
                </ul>

                {{-- Canais oficiais do C6 (RN-015), logo abaixo dos contatos da B2BSAFE --}}
                <div class="mt-10">
                    <h3 id="canais-c6" class="text-xl font-extrabold text-preto">Canais oficiais C6 Bank</h3>
                    <p class="mt-1 text-texto-suave">Para assuntos da sua conta, fale direto com o C6 Bank.</p>
                    <ul class="mt-4 grid gap-3 sm:grid-cols-2">
                        @foreach (config('b2bsafe.canais_c6') as $canal => $contato)
                            <li class="rounded-2xl bg-fundo px-4 py-3 shadow-sm">
                                <span class="block text-sm text-texto-suave">{{ $canal }}</span>
                                <span class="mt-0.5 block font-bold break-all text-preto">{{ $contato }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div data-revelar>
                <x-formulario-lead />
            </div>
        </div>
    </section>

</x-layouts.site>
