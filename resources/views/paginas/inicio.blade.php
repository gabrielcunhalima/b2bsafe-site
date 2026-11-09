{{-- Home institucional (US-002, RF-001, wireframe T-01) --}}
@php
    use App\Support\Telefone;
    use App\Support\WhatsApp;

    $servicos = config('b2bsafe.servicos');
    $whatsappGeral = config('b2bsafe.whatsapp.geral');
    $whatsappMaquininha = config('b2bsafe.whatsapp.maquininha');
    $email = config('b2bsafe.email_contato');
    $credenciadas = [...config('b2bsafe.empresas'), ...config('b2bsafe.escritorios_parceiros')];
@endphp

<x-layouts.site>
    {{-- Apresentação --}}
    <section class="bg-gelo">
        <div class="mx-auto grid max-w-6xl items-center gap-12 px-4 py-16 md:py-24 lg:grid-cols-[1.2fr_1fr]">
            <div>
                <h1 class="text-4xl leading-tight font-extrabold text-preto md:text-6xl">Sua empresa em boas mãos.</h1>
                <p class="mt-5 max-w-xl text-lg leading-relaxed text-texto-suave">
                    Mais do que soluções financeiras, oferecemos parceria, orientação e segurança para impulsionar o crescimento da sua empresa.
                </p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="#contato" class="inline-flex items-center justify-center gap-2 rounded bg-preto px-6 py-3 font-semibold text-white transition-colors hover:bg-preto-hover">
                        Quero abrir minha conta <i data-lucide="arrow-right" class="size-4" aria-hidden="true"></i>
                    </a>
                    <x-botao-whatsapp :href="WhatsApp::link()">Falar no WhatsApp</x-botao-whatsapp>
                </div>
                <p class="mt-6 flex items-center gap-2 text-sm text-texto-suave">
                    <i data-lucide="lock" class="size-4 text-preto" aria-hidden="true"></i>
                    Credenciado oficial C6 Empresas ·
                    <a href="#credenciamento" class="rounded font-semibold text-preto underline">verifique</a>
                </p>
            </div>

            <div class="fundo-escuro rounded-2xl bg-preto p-8 text-white shadow-xl md:p-10">
                <span class="flex size-14 items-center justify-center rounded-full bg-amarelo text-preto">
                    <i data-lucide="lock" class="size-7" aria-hidden="true"></i>
                </span>
                <p class="mt-6 text-2xl leading-snug font-bold">Escritório parceiro oficial do C6 Empresas</p>
                <ul class="mt-6 space-y-4 text-white/80">
                    <li class="flex gap-3"><i data-lucide="user-round-check" class="mt-0.5 size-5 shrink-0 text-amarelo" aria-hidden="true"></i> Atendimento próximo para pequenas e médias empresas</li>
                    <li class="flex gap-3"><i data-lucide="layers" class="mt-0.5 size-5 shrink-0 text-amarelo" aria-hidden="true"></i> Conta PJ, crédito, maquininha e investimentos num só lugar</li>
                    <li class="flex gap-3"><i data-lucide="award" class="mt-0.5 size-5 shrink-0 text-amarelo" aria-hidden="true"></i> Escritório destaque 2025 no Conexão Awards</li>
                </ul>
            </div>
        </div>
    </section>

    {{-- Serviços: cada card abre o WhatsApp citando o serviço (RN-021) --}}
    <section id="servicos" class="bg-fundo">
        <div class="mx-auto max-w-6xl px-4 py-16 md:py-24">
            <h2 class="text-3xl font-extrabold text-preto md:text-4xl">Serviços</h2>
            <p class="mt-3 max-w-2xl text-lg text-texto-suave">
                Conta e cartão sem tarifas, crédito para o seu negócio e muito mais. Escolha um serviço e fale direto com um atendente.
            </p>

            <ul class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach (config('b2bsafe.vitrine') as $chave => $card)
                    <li>
                        <a href="{{ WhatsApp::linkDoServico($chave) }}" target="_blank" rel="noopener noreferrer"
                           data-whatsapp="home" data-servico="{{ $chave }}"
                           class="group flex h-full flex-col overflow-hidden rounded-xl border border-borda bg-fundo transition hover:-translate-y-0.5 hover:shadow-lg focus-visible:shadow-lg">
                            <div class="flex-1 p-6">
                                <span class="flex size-12 items-center justify-center rounded-lg bg-gelo text-preto transition-colors group-hover:bg-amarelo group-focus-visible:bg-amarelo">
                                    <i data-lucide="{{ $card['icone'] }}" class="size-6" aria-hidden="true"></i>
                                </span>
                                <h3 class="mt-5 text-lg font-bold text-preto">{{ $servicos[$chave] }}</h3>
                                <p class="mt-2 text-texto-suave">{{ $card['descricao'] }}</p>
                            </div>
                            {{-- Sempre visível em telas de toque; no mouse aparece no hover e no foco --}}
                            <span class="flex items-center gap-2 bg-whatsapp px-6 py-3 text-sm font-semibold text-white transition-opacity [@media(hover:hover)]:opacity-0 [@media(hover:hover)]:group-hover:opacity-100 [@media(hover:hover)]:group-focus-visible:opacity-100">
                                <x-icone-marca nome="whatsapp" class="size-4" /> Fale com um atendente
                                <span class="sr-only">sobre {{ $servicos[$chave] }} no WhatsApp (abre em nova aba)</span>
                            </span>
                        </a>
                    </li>
                @endforeach

                <li class="fundo-escuro flex flex-col justify-between rounded-xl bg-preto p-6 text-white">
                    <div>
                        <i data-lucide="message-circle-question" class="size-8 text-amarelo" aria-hidden="true"></i>
                        <p class="mt-5 text-lg font-bold">Não sabe por onde começar?</p>
                        <p class="mt-2 text-white/75">Conte o que sua empresa precisa e indicamos a melhor solução.</p>
                    </div>
                    <a href="#contato" class="mt-6 inline-flex items-center gap-2 rounded font-semibold text-amarelo underline">
                        Fale conosco <i data-lucide="arrow-right" class="size-4" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        </div>
    </section>

    {{-- Maquininha C6 Pay: seção própria, com o WhatsApp da maquininha (RN-021) --}}
    <section id="maquininha" class="fundo-escuro overflow-hidden bg-preto text-white">
        <div class="mx-auto grid max-w-6xl items-center gap-12 px-4 py-16 md:py-24 lg:grid-cols-2">
            <div>
                <h2 class="text-3xl leading-tight font-extrabold md:text-5xl">
                    Maquininha C6 Pay: <span class="text-amarelo">venda mais, pague menos.</span>
                </h2>
                <ul class="mt-8 space-y-4 text-lg text-white/85">
                    <li class="flex gap-3"><i data-lucide="check" class="mt-1 size-5 shrink-0 text-amarelo" aria-hidden="true"></i> Parcele em até 12x e receba em até 2 dias úteis</li>
                    <li class="flex gap-3"><i data-lucide="check" class="mt-1 size-5 shrink-0 text-amarelo" aria-hidden="true"></i> Chip e plano de dados grátis, e funciona também no Wi-Fi</li>
                    <li class="flex gap-3"><i data-lucide="check" class="mt-1 size-5 shrink-0 text-amarelo" aria-hidden="true"></i> A máquina escolhe a bandeira com a melhor taxa</li>
                </ul>
                <div class="mt-10 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ WhatsApp::linkDoServico('maquininha') }}" target="_blank" rel="noopener noreferrer"
                       data-whatsapp="home" data-servico="maquininha"
                       class="inline-flex items-center justify-center gap-2 rounded bg-amarelo px-6 py-3 font-semibold text-preto transition-colors hover:bg-amarelo-hover">
                        <x-icone-marca nome="whatsapp" class="size-5" /> Quero minha C6 Pay
                        <span class="sr-only">(abre o WhatsApp em nova aba)</span>
                    </a>
                    {{-- A página de taxas é a #3: o link só aparece quando ela existir, nunca leva a um 404 (RF-002) --}}
                    @if (Route::has('maquininha'))
                        <a href="{{ route('maquininha') }}" class="inline-flex items-center justify-center gap-2 rounded border border-white/40 px-6 py-3 font-semibold text-white transition-colors hover:bg-white/10">
                            Ver taxas e condições <i data-lucide="arrow-right" class="size-4" aria-hidden="true"></i>
                        </a>
                    @endif
                </div>
                <p class="mt-6 text-sm text-white/70">WhatsApp da maquininha: {{ Telefone::formatar($whatsappMaquininha) }}</p>
            </div>

            {{-- Ilustração genérica de maquininha até a liberação da imagem oficial da C6 Pay (pendência no ESTADO) --}}
            <div class="relative flex justify-center" aria-hidden="true">
                <div class="absolute top-1/2 left-1/2 size-80 -translate-1/2 rounded-full bg-amarelo/15 blur-2xl"></div>
                <div class="relative w-60 rotate-3 rounded-[2.25rem] bg-[#1c1c1c] p-4 shadow-2xl ring-1 ring-white/10">
                    <div class="rounded-2xl bg-fundo p-5 text-preto">
                        <div class="flex items-center justify-between text-xs font-semibold text-texto-suave">
                            <span>Crédito 3x</span>
                            <i data-lucide="wifi" class="size-4"></i>
                        </div>
                        <p class="mt-6 text-sm text-texto-suave">Valor</p>
                        <p class="text-3xl font-extrabold">R$ 450,00</p>
                        <p class="mt-6 flex items-center gap-2 rounded-lg bg-amarelo px-3 py-2 text-sm font-bold">
                            <i data-lucide="circle-check" class="size-4"></i> Pagamento aprovado
                        </p>
                    </div>
                    <div class="mt-4 grid grid-cols-3 gap-2">
                        @foreach (range(1, 12) as $tecla)
                            <span class="h-8 rounded-lg bg-white/10"></span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Sobre --}}
    <section id="sobre" class="bg-gelo">
        <div class="mx-auto grid max-w-6xl items-center gap-12 px-4 py-16 md:py-24 lg:grid-cols-[1.4fr_1fr]">
            <div>
                <h2 class="text-3xl leading-tight font-extrabold text-preto md:text-4xl">Sua empresa e seus investimentos em total segurança.</h2>
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
                <p class="mt-6 text-xl font-extrabold text-preto">B2BSAFE, Be Safe!</p>
            </div>

            <figure class="rounded-2xl bg-fundo p-8 text-center shadow-sm">
                <span class="mx-auto flex size-24 items-center justify-center rounded-full bg-preto text-amarelo">
                    <i data-lucide="award" class="size-12" aria-hidden="true"></i>
                </span>
                <figcaption class="mt-6">
                    <span class="block text-2xl font-extrabold text-preto">Escritório destaque 2025</span>
                    <span class="mt-2 block text-texto-suave">Conexão Awards C6 Empresas</span>
                </figcaption>
            </figure>
        </div>
    </section>

    {{-- Parcerias / Trabalhe conosco: os botões levam ao Fale conosco com o serviço "parceria" (formulário na #8) --}}
    <section id="parcerias" class="bg-fundo">
        <div class="mx-auto max-w-6xl px-4 py-16 md:py-24">
            <h2 class="text-3xl font-extrabold text-preto md:text-4xl">Parcerias</h2>
            <p class="mt-3 text-lg text-texto-suave">Trabalhe conosco ou seja parceiro, você escolhe.</p>

            <div class="mt-10 grid gap-5 md:grid-cols-2">
                <article class="flex flex-col rounded-xl border border-borda p-8">
                    <i data-lucide="handshake" class="size-8 text-preto" aria-hidden="true"></i>
                    <h3 class="mt-5 text-xl font-bold text-preto">Seja parceiro de negócios</h3>
                    <p class="mt-2 flex-1 text-texto-suave">
                        Seja remunerado por indicar empresas que você conhece. Atendemos pequenas e médias empresas com faturamento de R$ 1 a R$ 50 milhões.
                    </p>
                    <a href="#contato" data-servico="parceria" class="mt-6 inline-flex items-center gap-2 self-start rounded bg-preto px-5 py-3 font-semibold text-white transition-colors hover:bg-preto-hover">
                        Quero ser parceiro <i data-lucide="arrow-right" class="size-4" aria-hidden="true"></i>
                    </a>
                </article>
                <article class="flex flex-col rounded-xl border border-borda p-8">
                    <i data-lucide="users-round" class="size-8 text-preto" aria-hidden="true"></i>
                    <h3 class="mt-5 text-xl font-bold text-preto">Seja parte da equipe</h3>
                    <p class="mt-2 flex-1 text-texto-suave">
                        Buscamos profissionais com perfil comercial, iniciativa e interesse em uma parceria de longo prazo, com remuneração por resultados.
                    </p>
                    <a href="#contato" data-servico="parceria" class="mt-6 inline-flex items-center gap-2 self-start rounded bg-preto px-5 py-3 font-semibold text-white transition-colors hover:bg-preto-hover">
                        Quero trabalhar na B2BSAFE <i data-lucide="arrow-right" class="size-4" aria-hidden="true"></i>
                    </a>
                </article>
            </div>
        </div>
    </section>

    {{-- Fale conosco: o formulário de lead (T-03) entra aqui na #8 --}}
    <section id="contato" class="bg-gelo">
        <div class="mx-auto grid max-w-6xl gap-10 px-4 py-16 md:py-24 lg:grid-cols-2">
            <div>
                <h2 class="text-3xl font-extrabold text-preto md:text-4xl">Fale conosco</h2>
                <p class="mt-3 max-w-lg text-lg text-texto-suave">
                    Conte o que sua empresa precisa e um especialista da B2BSAFE responde. Se preferir, chame no WhatsApp ou mande um e-mail.
                </p>
            </div>
            <ul class="grid gap-4 sm:grid-cols-2 lg:grid-cols-1">
                <li class="rounded-xl bg-fundo p-6 shadow-sm">
                    <p class="flex items-center gap-2 font-bold text-preto"><x-icone-marca nome="whatsapp" class="size-5 text-whatsapp" /> WhatsApp</p>
                    <p class="mt-1 text-texto-suave">{{ Telefone::formatar($whatsappGeral) }}</p>
                    <x-botao-whatsapp :href="WhatsApp::link()" class="mt-4 w-full sm:w-auto">Chamar no WhatsApp</x-botao-whatsapp>
                </li>
                <li class="rounded-xl bg-fundo p-6 shadow-sm">
                    <p class="flex items-center gap-2 font-bold text-preto"><i data-lucide="mail" class="size-5" aria-hidden="true"></i> E-mail</p>
                    <p class="mt-1 break-all text-texto-suave">{{ $email }}</p>
                    <a href="mailto:{{ $email }}?subject={{ rawurlencode('Contato pelo site da B2BSAFE') }}"
                       class="mt-4 inline-flex w-full items-center justify-center gap-2 rounded bg-preto px-6 py-3 font-semibold text-white transition-colors hover:bg-preto-hover sm:w-auto">
                        Enviar e-mail
                    </a>
                </li>
            </ul>
        </div>
    </section>

    {{-- Credenciamento --}}
    <section id="credenciamento" class="bg-fundo">
        <div class="mx-auto max-w-6xl px-4 py-16 md:py-24">
            <div class="grid gap-10 rounded-2xl border border-borda p-8 md:p-12 lg:grid-cols-2">
                <div>
                    <h2 class="flex items-center gap-3 text-3xl font-extrabold text-preto">
                        <i data-lucide="shield-check" class="size-8 shrink-0" aria-hidden="true"></i> Verifique nosso credenciamento
                    </h2>
                    <p class="mt-3 text-lg text-texto-suave">Consulte no site oficial do C6 Bank e confirme nosso cadastro como escritório parceiro.</p>
                    <a href="{{ config('b2bsafe.verificacao_c6') }}" target="_blank" rel="noopener noreferrer"
                       class="mt-6 inline-flex items-center gap-2 rounded bg-amarelo px-6 py-3 font-semibold text-preto transition-colors hover:bg-amarelo-hover">
                        Verificar no C6 Bank <i data-lucide="external-link" class="size-4" aria-hidden="true"></i>
                        <span class="sr-only">(abre em nova aba)</span>
                    </a>
                </div>
                <dl class="divide-y divide-borda">
                    @foreach ($credenciadas as $empresa)
                        <div class="py-4 first:pt-0 last:pb-0">
                            <dt class="font-bold text-preto">{{ $empresa['nome'] }}</dt>
                            <dd class="mt-1 text-texto-suave">CNPJ {{ $empresa['cnpj'] }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>
    </section>

    {{-- Canais oficiais do C6 (RN-015) --}}
    <section aria-labelledby="canais-c6" class="bg-gelo">
        <div class="mx-auto max-w-6xl px-4 py-16">
            <h2 id="canais-c6" class="text-2xl font-extrabold text-preto">Canais oficiais C6 Bank</h2>
            <p class="mt-2 text-texto-suave">Para assuntos da sua conta, fale direto com o C6 Bank.</p>
            <ul class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach (config('b2bsafe.canais_c6') as $canal => $contato)
                    <li class="rounded-xl bg-fundo p-5">
                        <span class="block text-sm text-texto-suave">{{ $canal }}</span>
                        <span class="mt-1 block font-bold break-all text-preto">{{ $contato }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
</x-layouts.site>
