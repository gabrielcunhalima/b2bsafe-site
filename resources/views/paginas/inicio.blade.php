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

    // Foto do topo: a de pagamento com a C6 Pay, quando o responsável salvar; até lá, a foto de empreendedora (Unsplash)
    $fotoTopo = file_exists(public_path('img/hero-pagamento-c6.webp'))
        ? ['arquivo' => 'img/hero-pagamento-c6.webp', 'alt' => 'Cliente pagando com cartão na maquininha C6 Pay de um comerciante']
        : ['arquivo' => 'img/foto-empreendedora.webp', 'alt' => 'Empreendedora sorrindo enquanto trabalha no notebook do escritório'];

    $titulo = 'text-3xl leading-tight font-extrabold tracking-tight text-preto md:text-5xl';
    // Hover sem zoom nem deslocamento: só a cor muda
    $botaoPreto = 'inline-flex items-center justify-center gap-2 rounded-full bg-preto px-7 py-3.5 font-semibold text-white transition-colors hover:bg-preto-hover';
@endphp

<x-layouts.site>
    @push('head')
        {{-- Dados estruturados da empresa com os dois endereços (RF-011) --}}
        <script type="application/ld+json">{!! json_encode(\App\Support\Seo::dadosEstruturados(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
    @endpush

    {{-- Apresentação --}}
    <section class="relative overflow-hidden bg-gelo">
        <div class="pontilhado pointer-events-none absolute inset-0 opacity-60" aria-hidden="true"></div>
        <div class="relative mx-auto grid max-w-6xl items-center gap-14 px-4 pt-14 pb-20 md:pt-20 lg:grid-cols-[1.15fr_1fr] lg:pb-28">
            <div data-revelar>
                <h1 class="text-5xl leading-[1.05] font-extrabold tracking-tight text-preto md:text-7xl">
                    Sua empresa em boas mãos.
                </h1>
                <p class="mt-6 max-w-xl text-lg leading-relaxed text-texto-suave md:text-xl">
                    Solução financeira com parceria, orientação e segurança para impulsionar o crescimento da sua empresa.
                </p>
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

            {{-- Foto como corpo de um cadeado: a alça amarela vem do "A" do logo B2BSAFE (o cadeado é o símbolo da empresa) --}}
            <div class="relative mx-auto w-full max-w-md pt-[30%] lg:max-w-none" data-revelar>
                <svg class="absolute top-0 left-1/2 w-[62%] -translate-x-1/2 text-amarelo" viewBox="0 0 200 140" fill="none" aria-hidden="true">
                    <path d="M28 140V86a72 72 0 0 1 144 0v54" stroke="currentColor" stroke-width="28" />
                </svg>
                <img src="{{ asset($fotoTopo['arquivo']) }}" width="800" height="1000" fetchpriority="high" alt="{{ $fotoTopo['alt'] }}"
                     class="relative aspect-[4/5] w-full rounded-[2rem] object-cover shadow-2xl">
            </div>
        </div>
    </section>

    {{-- Faixa de confiança --}}
    <section aria-label="Por que a B2BSAFE" class="fundo-escuro bg-preto text-white">
        <ul class="mx-auto grid max-w-6xl gap-6 px-4 py-8 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ([
                ['shield-check', 'Escritório credenciado', 'C6 Empresas'],
                ['award', 'Destaque 2025', 'Conexão Awards'],
                ['badge-percent', 'Conta PJ sem tarifa', 'Pix ilimitado'],
                ['map-pin', 'Atendimento próximo', 'em SC e SP'],
            ] as [$icone, $forte, $leve])
                <li class="flex items-center gap-3">
                    <span class="flex size-11 shrink-0 items-center justify-center rounded-full bg-white/10 text-amarelo">
                        <i data-lucide="{{ $icone }}" class="size-5" aria-hidden="true"></i>
                    </span>
                    <span class="leading-tight"><strong class="block">{{ $forte }}</strong><span class="text-sm text-white/70">{{ $leve }}</span></span>
                </li>
            @endforeach
        </ul>
    </section>

    {{-- Serviços em mosaico: cada card abre o WhatsApp citando o serviço (RN-021) --}}
    <section id="servicos" class="bg-fundo">
        <div class="mx-auto max-w-6xl px-4 py-20 md:py-28">
            <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end" data-revelar>
                <div>
                    <h2 class="{{ $titulo }}">Serviços para cada momento da sua empresa</h2>
                    <p class="mt-4 max-w-2xl text-lg text-texto-suave">
                        Conta e cartão sem tarifas, crédito para o seu negócio e muito mais. Escolha um serviço e fale direto com um atendente.
                    </p>
                </div>
            </div>

            <ul class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($vitrine as $chave => $card)
                    @php($destaque = $chave === 'credito')
                    <li class="{{ $destaque ? 'sm:col-span-2 lg:row-span-2' : '' }}" data-revelar>
                        <a href="{{ WhatsApp::linkDoServico($chave) }}" target="_blank" rel="noopener noreferrer"
                           data-whatsapp="home" data-servico="{{ $chave }}"
                           class="group relative flex h-full flex-col overflow-hidden rounded-3xl transition-colors duration-300 {{ $destaque ? 'fundo-escuro min-h-[26rem] bg-preto text-white' : 'border border-borda bg-fundo hover:border-preto hover:bg-gelo focus-visible:border-preto focus-visible:bg-gelo' }}">
                            @if ($destaque)
                                <img src="{{ asset('img/foto-credito.webp') }}" width="1200" height="800" loading="lazy" alt=""
                                     class="absolute inset-0 size-full object-cover opacity-70 transition-opacity duration-300 group-hover:opacity-45 group-focus-visible:opacity-45">
                                <span class="absolute inset-0 bg-gradient-to-t from-preto via-preto/70 to-transparent" aria-hidden="true"></span>
                            @endif
                            <div class="relative flex flex-1 flex-col p-7 {{ $destaque ? 'justify-end' : '' }}">
                                <div class="flex items-start justify-between">
                                    <span class="flex size-12 items-center justify-center rounded-2xl transition-colors {{ $destaque ? 'bg-amarelo text-preto' : 'bg-gelo text-preto group-hover:bg-amarelo group-focus-visible:bg-amarelo' }}">
                                        <i data-lucide="{{ $card['icone'] }}" class="size-6" aria-hidden="true"></i>
                                    </span>
                                    @unless ($destaque)
                                        <i data-lucide="arrow-up-right" class="size-5 text-texto-terciario transition-colors duration-300 group-hover:text-preto group-focus-visible:text-preto" aria-hidden="true"></i>
                                    @endunless
                                </div>
                                <h3 class="mt-6 font-bold {{ $destaque ? 'text-3xl' : 'text-lg text-preto' }}">{{ $servicos[$chave] }}</h3>
                                <p class="mt-2 {{ $destaque ? 'max-w-md text-lg text-white/85' : 'text-texto-suave' }}">{{ $card['descricao'] }}</p>
                            </div>
                            {{-- Sempre visível em telas de toque; no mouse aparece no hover e no foco --}}
                            <span class="relative flex items-center gap-2 bg-whatsapp px-7 py-3 text-sm font-semibold text-white transition-opacity [@media(hover:hover)]:opacity-0 [@media(hover:hover)]:group-hover:opacity-100 [@media(hover:hover)]:group-focus-visible:opacity-100">
                                <x-icone-marca nome="whatsapp" class="size-4" /> Fale com um atendente
                                <span class="sr-only">sobre {{ $servicos[$chave] }} no WhatsApp (abre em nova aba)</span>
                            </span>
                        </a>
                    </li>
                @endforeach

                <li class="relative flex flex-col justify-between overflow-hidden rounded-3xl bg-amarelo p-7 text-preto sm:col-span-2" data-revelar>
                    <div class="absolute -right-10 -bottom-16 size-48 rounded-full bg-preto/5" aria-hidden="true"></div>
                    <div class="relative">
                        <i data-lucide="message-circle-question" class="size-9" aria-hidden="true"></i>
                        <p class="mt-5 text-2xl font-extrabold">Não sabe por onde começar?</p>
                        <p class="mt-2 max-w-md text-preto/80">Conte o que sua empresa precisa e indicamos a melhor solução do C6 Empresas para o seu momento.</p>
                    </div>
                    <a href="#contato" class="relative mt-6 inline-flex items-center gap-2 self-start rounded-full bg-preto px-6 py-3 font-semibold text-white transition-colors hover:bg-preto-hover">
                        Fale conosco <i data-lucide="arrow-right" class="size-4" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        </div>
    </section>

    {{-- Conta PJ: a foto ocupa 40% da seção, de ponta a ponta e sem moldura, como fundo do lado esquerdo --}}
    <section id="conta-pj" aria-labelledby="titulo-conta-pj" class="bg-gelo">
        <div class="grid items-center lg:grid-cols-[2fr_3fr]">
            <img src="{{ asset('img/foto-conta-pj.webp') }}" width="1000" height="1000" loading="lazy"
                 alt="Empreendedora no próprio estabelecimento acompanhando a conta da empresa pelo celular"
                 class="block aspect-square w-full object-cover">
            {{-- Texto alinhado à grade do site (max-w-6xl) pelo lado direito --}}
            <div class="max-w-xl px-4 py-14 lg:max-w-none lg:py-20 lg:pr-[max(1rem,calc((100vw-72rem)/2+1rem))] lg:pl-16" data-revelar>
                <h2 id="titulo-conta-pj" class="{{ $titulo }}">Abra a conta PJ da sua empresa com quem entende do C6.</h2>
                <p class="mt-5 max-w-xl text-lg leading-relaxed text-texto-suave">
                    Conta completa e sem tarifa, com Pix ilimitado, boletos de cobrança grátis todo mês e gestão pelo app ou pelo web banking.
                    A B2BSAFE acompanha a abertura com você, do primeiro contato à conta funcionando.
                </p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="#contato" data-servico="conta_corrente" class="{{ $botaoPreto }}">
                        Quero abrir minha conta <i data-lucide="arrow-right" class="size-4" aria-hidden="true"></i>
                    </a>
                    <x-botao-whatsapp :href="WhatsApp::linkDoServico('conta_corrente')" servico="conta_corrente">Falar no WhatsApp</x-botao-whatsapp>
                </div>
            </div>
        </div>
    </section>

    {{-- Maquininha C6 Pay: seção própria, com o WhatsApp da maquininha (RN-021) --}}
    <section id="maquininha" class="fundo-escuro relative overflow-hidden bg-preto text-white">
        <div class="pontilhado-claro pointer-events-none absolute inset-0 opacity-40" aria-hidden="true"></div>
        <div class="relative mx-auto grid max-w-6xl items-center gap-12 px-4 py-20 md:py-28 lg:grid-cols-2">
            <div data-revelar>
                <h2 class="text-4xl leading-tight font-extrabold tracking-tight md:text-6xl">
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
                <p class="mt-6 text-sm text-white/70">WhatsApp da maquininha: {{ Telefone::formatar($whatsappMaquininha) }}</p>
            </div>

            {{-- Imagem da C6 Pay (fundo transparente) sobre um círculo amarelo, para a máquina preta não sumir no fundo preto --}}
            <div class="relative mx-auto w-full max-w-md lg:max-w-none" data-revelar>
                <div class="absolute inset-[8%] rounded-full bg-amarelo" aria-hidden="true"></div>
                <div class="absolute inset-[2%] rounded-full ring-1 ring-amarelo/30" aria-hidden="true"></div>
                <img src="{{ asset('img/maquininha-c6-pay.webp') }}" width="900" height="843" loading="lazy"
                     alt="Maquininha C6 Pay com tela de pagamento e teclado, aceitando Elo, Mastercard, Hipercard e Visa"
                     class="relative w-full drop-shadow-2xl">
            </div>
        </div>
    </section>

    {{-- Como trabalhamos --}}
    <section aria-labelledby="titulo-como" class="bg-gelo">
        <div class="mx-auto max-w-6xl px-4 py-20 md:py-28">
            <h2 id="titulo-como" class="{{ $titulo }} max-w-2xl" data-revelar>Como a B2BSAFE trabalha com você</h2>
            <ol class="mt-12 grid gap-5 md:grid-cols-3">
                @foreach ([
                    ['message-square-text', 'Você conta o que precisa', 'Pelo WhatsApp ou pelo formulário, sem compromisso e sem burocracia.'],
                    ['clipboard-list', 'Um especialista monta a solução', 'Entendemos o momento da sua empresa e indicamos os produtos do C6 Empresas que fazem sentido.'],
                    ['rocket', 'A gente acompanha de perto', 'Da abertura da conta à maquininha funcionando, com atendimento próximo do começo ao fim.'],
                ] as $indice => [$icone, $passo, $texto])
                    <li class="relative overflow-hidden rounded-3xl bg-fundo p-8 shadow-sm" data-revelar>
                        <span class="absolute -top-4 -right-2 text-8xl font-extrabold text-gelo select-none" aria-hidden="true">{{ $indice + 1 }}</span>
                        <span class="relative flex size-14 items-center justify-center rounded-2xl bg-preto text-amarelo">
                            <i data-lucide="{{ $icone }}" class="size-6" aria-hidden="true"></i>
                        </span>
                        <h3 class="relative mt-6 text-xl font-bold text-preto"><span class="sr-only">Passo {{ $indice + 1 }}: </span>{{ $passo }}</h3>
                        <p class="relative mt-2 text-texto-suave">{{ $texto }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- Sobre --}}
    {{-- Sobre: o selo Conexão Awards 2025 é a única imagem, em destaque --}}
    <section id="sobre" class="bg-fundo">
        <div class="mx-auto grid max-w-6xl items-center gap-12 px-4 py-20 md:py-28 lg:grid-cols-2 lg:gap-16">
            <figure class="mx-auto w-full max-w-lg lg:max-w-none" data-revelar>
                <img src="{{ asset('img/conexao-awards-2025.webp') }}" width="487" height="487" loading="lazy"
                     alt="Selo Conexão Awards 2025 do C6 Empresas: B2BSAFE, destaque de 2025, reconhecimento por transformar consistência em resultados de alto nível"
                     class="w-full rounded-[2rem] shadow-2xl">
                <figcaption class="sr-only">Escritório destaque 2025 · Conexão Awards C6 Empresas</figcaption>
            </figure>

            <div data-revelar>
                <h2 class="{{ $titulo }}">Sua empresa e seus investimentos em total segurança.</h2>
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
                <p class="mt-8 text-2xl font-extrabold text-preto">B2BSAFE, Be Safe!</p>
            </div>
        </div>
    </section>

    {{-- Parcerias / Trabalhe conosco: os botões levam ao Fale conosco com o serviço "parceria" --}}
    <section id="parcerias" class="bg-gelo">
        <div class="mx-auto max-w-6xl px-4 py-20 md:py-28">
            <h2 class="{{ $titulo }}" data-revelar>Parcerias</h2>
            <p class="mt-4 text-lg text-texto-suave" data-revelar>Trabalhe conosco ou seja parceiro, você escolhe.</p>

            <div class="mt-12 grid gap-6 md:grid-cols-2">
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

    {{-- Fale conosco: formulário de lead (RF-006, T-03) e os canais diretos --}}
    <section id="contato" class="fundo-escuro relative overflow-hidden bg-preto text-white">
        <div class="absolute -top-32 -left-32 size-96 rounded-full bg-amarelo/10 blur-3xl" aria-hidden="true"></div>
        <div class="relative mx-auto grid max-w-6xl gap-12 px-4 py-20 md:py-28 lg:grid-cols-[1fr_1.3fr]">
            <div data-revelar>
                <h2 class="text-3xl leading-tight font-extrabold tracking-tight md:text-5xl">Fale <span class="text-amarelo">conosco</span></h2>
                <p class="mt-4 max-w-lg text-lg text-white/75">
                    Deixe seus dados e um especialista da B2BSAFE entra em contato. Se preferir, chame no WhatsApp ou mande um e-mail.
                </p>
                <ul class="mt-10 space-y-4">
                    <li>
                        <a href="{{ WhatsApp::link() }}" target="_blank" rel="noopener noreferrer" data-whatsapp="contato"
                           class="flex items-center gap-4 rounded-2xl bg-white/5 p-4 ring-1 ring-white/10 transition-colors hover:bg-white/10">
                            <span class="flex size-12 items-center justify-center rounded-full bg-whatsapp text-white">
                                <x-icone-marca nome="whatsapp" class="size-5" />
                            </span>
                            <span>
                                <span class="block font-bold">WhatsApp</span>
                                <span class="block text-white/70">{{ Telefone::formatar($whatsappGeral) }}</span>
                            </span>
                            <span class="sr-only">(abre o WhatsApp em nova aba)</span>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:{{ $email }}?subject={{ rawurlencode('Contato pelo site da B2BSAFE') }}"
                           class="flex items-center gap-4 rounded-2xl bg-white/5 p-4 ring-1 ring-white/10 transition-colors hover:bg-white/10">
                            <span class="flex size-12 items-center justify-center rounded-full bg-amarelo text-preto">
                                <i data-lucide="mail" class="size-5" aria-hidden="true"></i>
                            </span>
                            <span>
                                <span class="block font-bold">E-mail</span>
                                <span class="block break-all text-white/70">{{ $email }}</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <div data-revelar>
                <x-formulario-lead />
            </div>
        </div>
    </section>

    {{-- Credenciamento --}}
    <section id="credenciamento" class="bg-gelo">
        <div class="mx-auto max-w-6xl px-4 py-20 md:py-24">
            <div class="grid gap-10 rounded-[2rem] bg-fundo p-8 shadow-sm md:p-12 lg:grid-cols-2" data-revelar>
                <div>
                    <span class="flex size-14 items-center justify-center rounded-2xl bg-amarelo text-preto">
                        <i data-lucide="shield-check" class="size-7" aria-hidden="true"></i>
                    </span>
                    <h2 class="mt-6 text-3xl font-extrabold tracking-tight text-preto">Verifique nosso credenciamento</h2>
                    <p class="mt-3 text-lg text-texto-suave">Consulte no site oficial do C6 Bank e confirme nosso cadastro como escritório parceiro.</p>
                    <a href="{{ config('b2bsafe.verificacao_c6') }}" target="_blank" rel="noopener noreferrer" class="{{ $botaoPreto }} mt-7">
                        Verificar no C6 Bank <i data-lucide="external-link" class="size-4" aria-hidden="true"></i>
                        <span class="sr-only">(PDF da lista oficial de parceiros, abre em nova aba)</span>
                    </a>
                </div>
                <dl class="divide-y divide-borda self-center">
                    @foreach ($credenciadas as $empresa)
                        <div class="flex items-center justify-between gap-4 py-4 first:pt-0 last:pb-0">
                            <dt class="font-bold text-preto">{{ $empresa['nome'] }}</dt>
                            <dd class="shrink-0 text-texto-suave">CNPJ {{ $empresa['cnpj'] }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>
    </section>

    {{-- Canais oficiais do C6 (RN-015) --}}
    <section aria-labelledby="canais-c6" class="bg-gelo">
        <div class="mx-auto max-w-6xl px-4 pb-20">
            <h2 id="canais-c6" class="text-2xl font-extrabold text-preto">Canais oficiais C6 Bank</h2>
            <p class="mt-2 text-texto-suave">Para assuntos da sua conta, fale direto com o C6 Bank.</p>
            <ul class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach (config('b2bsafe.canais_c6') as $canal => $contato)
                    <li class="rounded-2xl bg-fundo p-5 shadow-sm">
                        <span class="block text-sm text-texto-suave">{{ $canal }}</span>
                        <span class="mt-1 block font-bold break-all text-preto">{{ $contato }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
</x-layouts.site>
