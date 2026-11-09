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
    @push('head')
        {{-- Dados estruturados da empresa com os dois endereços (RF-011) --}}
        <script type="application/ld+json">{!! json_encode(\App\Support\Seo::dadosEstruturados(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
    @endpush

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

            {{--
                Foto do topo: uma pessoa pagando outra com a maquininha C6 Pay. Basta salvar a foto (licenciada ou
                autorizada) em public/img/hero-pagamento-c6.webp; até lá, fica o cartão de escritório parceiro.
            --}}
            @if (file_exists(public_path('img/hero-pagamento-c6.webp')))
                <img src="{{ asset('img/hero-pagamento-c6.webp') }}" fetchpriority="high"
                     alt="Cliente pagando com cartão na maquininha C6 Pay de um comerciante"
                     class="mx-auto aspect-[4/5] w-full max-w-md rounded-2xl object-cover shadow-xl lg:max-w-none">
            @else
                <div class="fundo-escuro rounded-2xl bg-preto p-8 text-white shadow-xl md:p-10">
                    <span class="flex size-14 items-center justify-center rounded-full bg-amarelo text-preto">
                        <i data-lucide="lock" class="size-7" aria-hidden="true"></i>
                    </span>
                    <p class="mt-6 text-2xl leading-snug font-bold">Escritório parceiro C6 Empresas</p>
                    <ul class="mt-6 space-y-4 text-white/80">
                        <li class="flex gap-3"><i data-lucide="user-round-check" class="mt-0.5 size-5 shrink-0 text-amarelo" aria-hidden="true"></i> Atendimento próximo para pequenas e médias empresas</li>
                        <li class="flex gap-3"><i data-lucide="layers" class="mt-0.5 size-5 shrink-0 text-amarelo" aria-hidden="true"></i> Conta PJ, crédito, maquininha e investimentos num só lugar</li>
                        <li class="flex gap-3"><i data-lucide="award" class="mt-0.5 size-5 shrink-0 text-amarelo" aria-hidden="true"></i> Escritório destaque 2025 no Conexão Awards</li>
                    </ul>
                </div>
            @endif
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

    {{-- Conta PJ: arte do C6 fornecida pelo responsável (original em docs/marca/) --}}
    <section id="conta-pj" aria-labelledby="titulo-conta-pj" class="bg-gelo">
        <div class="mx-auto grid max-w-6xl items-center gap-12 px-4 py-16 md:py-24 lg:grid-cols-2">
            <img src="{{ asset('img/conta-pj-c6.webp') }}" width="900" height="901" loading="lazy"
                 alt="Abra sua conta PJ no C6 Bank em poucos toques e aproveite: conta completa e sem tarifa, 100 boletos de cobrança grátis e Pix ilimitado todo mês, acompanhamento e gestão da conta pelo app ou web banking. Parceiros C6 Empresas."
                 class="mx-auto w-full max-w-md rounded-2xl shadow-xl lg:max-w-none">
            <div>
                <h2 id="titulo-conta-pj" class="text-3xl leading-tight font-extrabold text-preto md:text-4xl">Abra a conta PJ da sua empresa com quem entende do C6.</h2>
                <p class="mt-5 text-lg leading-relaxed text-texto-suave">
                    Conta completa e sem tarifa, com Pix ilimitado, boletos de cobrança grátis todo mês e gestão pelo app ou pelo web banking.
                    A B2BSAFE acompanha a abertura com você, do primeiro contato à conta funcionando.
                </p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="#contato" data-servico="conta_corrente"
                       class="inline-flex items-center justify-center gap-2 rounded bg-preto px-6 py-3 font-semibold text-white transition-colors hover:bg-preto-hover">
                        Quero abrir minha conta <i data-lucide="arrow-right" class="size-4" aria-hidden="true"></i>
                    </a>
                    <x-botao-whatsapp :href="WhatsApp::linkDoServico('conta_corrente')" servico="conta_corrente">Falar no WhatsApp</x-botao-whatsapp>
                </div>
            </div>
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

            {{-- Imagem oficial da C6 Pay (fundo transparente) sobre um círculo amarelo, para a máquina preta não sumir no fundo preto --}}
            <div class="relative mx-auto w-full max-w-md lg:max-w-none">
                <div class="absolute inset-[8%] rounded-full bg-amarelo" aria-hidden="true"></div>
                <img src="{{ asset('img/maquininha-c6-pay.webp') }}" width="900" height="843" loading="lazy"
                     alt="Maquininha C6 Pay com tela de pagamento e teclado, aceitando Elo, Mastercard, Hipercard e Visa"
                     class="relative w-full drop-shadow-2xl">
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

            <figure class="mx-auto w-full max-w-sm">
                <img src="{{ asset('img/conexao-awards-2025.webp') }}" width="487" height="487" loading="lazy"
                     alt="Selo Conexão Awards 2025 do C6 Empresas: B2BSAFE, destaque de 2025, reconhecimento por transformar consistência em resultados de alto nível"
                     class="w-full rounded-2xl shadow-xl">
                <figcaption class="mt-4 text-center text-texto-suave">
                    <span class="block text-lg font-bold text-preto">Escritório destaque 2025</span>
                    Conexão Awards C6 Empresas
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

    {{-- Fale conosco: formulário de lead (RF-006, T-03) e os canais diretos --}}
    <section id="contato" class="bg-gelo">
        <div class="mx-auto grid max-w-6xl gap-10 px-4 py-16 md:py-24 lg:grid-cols-[1fr_1.3fr]">
            <div>
                <h2 class="text-3xl font-extrabold text-preto md:text-4xl">Fale conosco</h2>
                <p class="mt-3 max-w-lg text-lg text-texto-suave">
                    Deixe seus dados e um especialista da B2BSAFE entra em contato. Se preferir, chame no WhatsApp ou mande um e-mail.
                </p>
                <ul class="mt-8 space-y-4">
                    <li>
                        <a href="{{ WhatsApp::link() }}" target="_blank" rel="noopener noreferrer" data-whatsapp="contato"
                           class="flex items-center gap-4 rounded-xl bg-fundo p-4 shadow-sm transition-shadow hover:shadow-md">
                            <span class="flex size-11 items-center justify-center rounded-full bg-whatsapp text-white">
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
                           class="flex items-center gap-4 rounded-xl bg-fundo p-4 shadow-sm transition-shadow hover:shadow-md">
                            <span class="flex size-11 items-center justify-center rounded-full bg-preto text-white">
                                <i data-lucide="mail" class="size-5" aria-hidden="true"></i>
                            </span>
                            <span>
                                <span class="block font-bold text-preto">E-mail</span>
                                <span class="block break-all text-texto-suave">{{ $email }}</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <x-formulario-lead />
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
                        <span class="sr-only">(PDF da lista oficial de parceiros, abre em nova aba)</span>
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
