{{--
    Nova hero da Home: carrossel dos 8 serviços (RF-001, RN-021), cada slide com uma composição própria.
    Carrossel + barra de nomes ocupam exatamente a primeira tela (altura da tela menos o cabeçalho).
    Passa sozinho a cada 7 s até a pessoa interagir; depois fica travado (resources/js/carrossel-servicos.js).
    Textos e fotos em config('b2bsafe.carrossel').
--}}
@php
    $slides = config('b2bsafe.carrossel');
    $servicos = config('b2bsafe.servicos');
    $chaves = array_keys($slides);

    // Peças repetidas: área do slide, parágrafo, chips de destaque (celular) e espaçamentos
    $area = 'relative grid h-full items-center gap-5 px-4 py-5 md:px-10 md:py-8 lg:gap-10 xl:px-16';
    $paragrafo = 'mt-3 max-w-xl text-sm leading-relaxed md:mt-4 md:text-lg';
    $chipEscuro = 'flex items-center gap-2 rounded bg-white/10 px-3 py-1.5 text-xs font-semibold ring-1 ring-white/15 md:text-sm';
    $chipClaro = 'flex items-center gap-2 rounded bg-fundo px-3 py-1.5 text-xs font-semibold text-preto shadow-sm md:text-sm';
@endphp

<section id="servicos" aria-roledescription="carrossel" aria-label="Serviços da B2BSAFE"
         x-data="carrosselServicos({{ count($slides) }})"
         class="relative flex h-[calc(100svh-4rem)] min-h-[34rem] flex-col bg-preto">
    <h1 class="sr-only">B2BSAFE, escritório parceiro C6 Empresas: crédito, maquininha, conta PJ, câmbio, investimentos, cartão, consórcio e seguros</h1>

    <div x-ref="palco" class="relative min-h-0 flex-1 scroll-mt-16 overflow-hidden"
         @scroll="$el.scrollLeft = 0">
        <div class="flex h-full transition-transform duration-700 ease-[cubic-bezier(0.65,0,0.35,1)] motion-reduce:transition-none"
             :style="`transform: translateX(-${atual * 100}%)`">
            @foreach ($slides as $chave => $slide)
                @php
                    $indice = $loop->index;
                    $nome = $servicos[$chave];
                @endphp
                <article id="servico-{{ str_replace('_', '-', $chave) }}" data-slide="{{ str_replace('_', '-', $chave) }}" data-indice="{{ $indice }}"
                         aria-roledescription="slide" aria-label="{{ $indice + 1 }} de {{ count($slides) }}: {{ $nome }}"
                         :inert="atual !== {{ $indice }}" :class="atual === {{ $indice }} && 'revelado'"
                         class="relative h-full w-full shrink-0 overflow-hidden">

                    @switch($chave)
                        {{-- 1. Crédito: foto à direita cortada em diagonal, título grande e destaques em linha --}}
                        @case('credito')
                            <div class="fundo-escuro relative h-full bg-preto text-white">
                                <img src="{{ asset($slide['imagem']) }}" alt="{{ $slide['alt'] }}" width="1400" height="788" fetchpriority="high"
                                     class="absolute inset-0 size-full object-cover opacity-60 lg:inset-y-0 lg:right-0 lg:left-auto lg:w-[50%] lg:opacity-100 lg:[clip-path:polygon(18%_0,100%_0,100%_100%,0_100%)]">
                                <div class="absolute inset-0 bg-gradient-to-t from-preto via-preto/80 to-transparent lg:hidden" aria-hidden="true"></div>
                                <div class="{{ $area }} lg:grid-cols-[54%_1fr]">
                                    <div class="self-end lg:self-center">
                                        <x-slide.titulo :texto="$slide['titulo']" />
                                        <p class="{{ $paragrafo }} text-white/80">{{ $slide['texto'] }}</p>
                                        {{-- Crédito sem cards de destaque (pedido do cliente); o espaço que eles ocupavam fica vazio --}}
                                        <div class="mt-4 h-7 md:mt-6 md:h-9 lg:h-[3.625rem]" aria-hidden="true"></div>
                                        <x-slide.botoes :chave="$chave" :nome="$nome" class="mt-5 md:mt-7" />
                                    </div>
                                </div>
                            </div>
                            @break

                        {{-- 2. Maquininha: a C6 Pay sobre o círculo amarelo, destaques em cards --}}
                        @case('maquininha')
                            <div class="fundo-escuro relative h-full bg-preto text-white">
                                <div class="pontilhado-claro pointer-events-none absolute inset-0 opacity-40" aria-hidden="true"></div>
                                <div class="{{ $area }} grid-rows-[auto_1fr] lg:grid-cols-2 lg:grid-rows-1">
                                    <div class="relative mx-auto flex h-full max-h-56 items-center justify-center lg:order-2 lg:max-h-[min(34rem,calc(100svh-12rem))]">
                                        <div class="absolute aspect-square h-[92%] rounded-full bg-amarelo" aria-hidden="true"></div>
                                        <img src="{{ asset($slide['imagem']) }}" alt="{{ $slide['alt'] }}" width="900" height="843" loading="lazy"
                                             class="relative h-full w-auto object-contain drop-shadow-2xl">
                                    </div>
                                    <div class="relative self-start lg:order-1 lg:self-center">
                                        <x-slide.titulo :texto="$slide['titulo']" />
                                        <p class="{{ $paragrafo }} text-white/75">{{ $slide['texto'] }}</p>
                                        <ul class="mt-4 flex flex-wrap gap-2 md:mt-6 lg:grid lg:grid-cols-3 lg:gap-3">
                                            @foreach ($slide['destaques'] as [$icone, $texto])
                                                <li class="{{ $chipEscuro }} lg:block lg:bg-white/5 lg:p-4 lg:font-normal">
                                                    <i data-lucide="{{ $icone }}" class="size-4 shrink-0 text-amarelo lg:size-6" aria-hidden="true"></i>
                                                    <span class="lg:mt-2 lg:block lg:text-white/85">{{ $texto }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <x-slide.botoes :chave="$chave" :nome="'a C6 Pay'" class="mt-5 md:mt-7" />
                                    </div>
                                </div>
                            </div>
                            @break

                        {{-- 3. Conta Corrente: fundo claro, foto em arco e um "extrato" com as vantagens --}}
                        @case('conta_corrente')
                            <div class="relative h-full bg-gelo text-preto">
                                <div class="{{ $area }} grid-rows-[auto_1fr] lg:grid-cols-[2fr_3fr] lg:grid-rows-1">
                                    <img src="{{ asset($slide['imagem']) }}" alt="{{ $slide['alt'] }}" width="1400" height="788" loading="lazy"
                                         class="h-40 w-full rounded-t-[6rem] rounded-b object-cover object-[60%_30%] shadow-xl md:h-56 lg:h-[min(30rem,calc(100svh-12rem))] lg:rounded-t-[12rem]">
                                    <div class="self-start lg:self-center">
                                        <x-slide.titulo :texto="$slide['titulo']" modo="claro" />
                                        <p class="{{ $paragrafo }} text-texto-suave">{{ $slide['texto'] }}</p>
                                        <div class="mt-4 max-w-lg rounded bg-fundo px-4 py-2 shadow-sm md:mt-6 md:px-6 md:py-4">
                                            <p class="hidden items-center justify-between text-sm font-semibold text-texto-suave md:flex">
                                                <span>Conta PJ C6 Empresas</span>
                                                <span class="rounded bg-gelo px-3 py-1 text-preto">sua empresa</span>
                                            </p>
                                            <dl class="divide-y divide-borda md:mt-2">
                                                @foreach ($slide['destaques'] as [$icone, $texto])
                                                    <div class="flex items-center gap-3 py-2 md:py-3">
                                                        <dt class="flex size-7 shrink-0 items-center justify-center rounded bg-amarelo md:size-9">
                                                            <i data-lucide="{{ $icone }}" class="size-4 md:size-5" aria-hidden="true"></i>
                                                        </dt>
                                                        <dd class="text-sm font-semibold md:text-base">{{ $texto }}</dd>
                                                        <i data-lucide="check" class="ml-auto size-5 text-sucesso" aria-hidden="true"></i>
                                                    </div>
                                                @endforeach
                                            </dl>
                                        </div>
                                        <x-slide.botoes :chave="$chave" :nome="'a conta PJ'" modo="claro" class="mt-5 md:mt-7" />
                                    </div>
                                </div>
                            </div>
                            @break

                        {{-- 4. Câmbio: foto de fundo em tela cheia escurecida, texto por cima e destaques em pílulas --}}
                        @case('cambio')
                            <div class="fundo-escuro relative h-full bg-preto text-white">
                                <img src="{{ asset($slide['imagem']) }}" alt="{{ $slide['alt'] }}" width="933" height="1400" loading="lazy"
                                     class="absolute inset-0 size-full object-cover object-[center_35%] opacity-45">
                                <div class="absolute inset-0 bg-gradient-to-t from-preto via-preto/75 to-preto/30 lg:bg-gradient-to-r lg:from-preto lg:via-preto/80 lg:to-preto/20" aria-hidden="true"></div>
                                <div class="{{ $area }}">
                                    <div class="max-w-2xl self-end lg:self-center">
                                        <x-slide.titulo :texto="$slide['titulo']" />
                                        <p class="{{ $paragrafo }} text-white/80">{{ $slide['texto'] }}</p>
                                        <ul class="mt-4 flex flex-wrap gap-2 md:mt-6 md:gap-3">
                                            @foreach ($slide['destaques'] as [$icone, $texto])
                                                <li class="{{ $chipEscuro }} backdrop-blur md:px-4 md:py-2.5">
                                                    <i data-lucide="{{ $icone }}" class="size-4 text-amarelo md:size-5" aria-hidden="true"></i> {{ $texto }}
                                                </li>
                                            @endforeach
                                        </ul>
                                        <x-slide.botoes :chave="$chave" :nome="'câmbio'" class="mt-5 md:mt-7" />
                                    </div>
                                </div>
                            </div>
                            @break

                        {{-- 5. Investimentos: fundo amarelo, foto numa moldura branca e linha do tempo "6 meses a 3 anos" --}}
                        @case('investimentos')
                            <div class="relative h-full bg-amarelo text-preto">
                                <div class="{{ $area }} grid-rows-[auto_1fr] lg:grid-cols-[3fr_2fr] lg:grid-rows-1">
                                    <div class="mx-auto h-36 w-full max-w-sm rotate-2 rounded bg-fundo p-2 shadow-2xl md:h-48 lg:order-2 lg:h-[min(28rem,calc(100svh-14rem))] lg:max-w-none lg:p-4">
                                        <img src="{{ asset($slide['imagem']) }}" alt="{{ $slide['alt'] }}" width="1400" height="788" loading="lazy"
                                             class="size-full rounded object-cover object-[55%_center]">
                                    </div>
                                    <div class="self-start lg:order-1 lg:self-center">
                                        <x-slide.titulo :texto="$slide['titulo']" modo="amarelo" />
                                        <p class="{{ $paragrafo }} text-preto/80">{{ $slide['texto'] }}</p>
                                        <div class="mt-4 max-w-xl rounded bg-preto p-4 text-white md:mt-6 md:p-6">
                                            <div class="flex items-center gap-3" aria-label="Prazos de 6 meses a 3 anos">
                                                <span class="shrink-0 text-sm font-extrabold md:text-base">6 meses</span>
                                                <span class="relative h-1.5 flex-1 rounded-full bg-amarelo" aria-hidden="true">
                                                    <span class="absolute top-1/2 left-0 size-4 -translate-y-1/2 rounded-full bg-amarelo ring-4 ring-preto"></span>
                                                    <span class="absolute top-1/2 right-0 size-4 -translate-y-1/2 rounded-full bg-amarelo ring-4 ring-preto"></span>
                                                </span>
                                                <span class="shrink-0 text-sm font-extrabold md:text-base">3 anos</span>
                                            </div>
                                            <ul class="mt-4 flex flex-wrap gap-2">
                                                @foreach ($slide['destaques'] as [$icone, $texto])
                                                    <li class="{{ $chipEscuro }}">
                                                        <i data-lucide="{{ $icone }}" class="size-4 text-amarelo" aria-hidden="true"></i> {{ $texto }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <x-slide.botoes :chave="$chave" :nome="'investimentos'" modo="amarelo" class="mt-5 md:mt-7" />
                                    </div>
                                </div>
                            </div>
                            @break

                        {{-- 6. Cartão: só a foto oficial do C6 Business (fornecida pelo cliente) à direita --}}
                        @case('cartao')
                            <div class="fundo-escuro relative h-full bg-preto text-white">
                                <div class="{{ $area }} grid-rows-[auto_1fr] lg:grid-cols-2 lg:grid-rows-1">
                                    <div class="mx-auto flex h-40 w-full max-w-sm items-center justify-center md:h-56 md:max-w-md lg:order-2 lg:h-[min(30rem,calc(100svh-12rem))] lg:max-w-none">
                                        <img src="{{ asset($slide['imagem']) }}" alt="{{ $slide['alt'] }}" width="1200" height="675" loading="lazy"
                                             class="h-auto max-h-full w-auto max-w-full rounded shadow-2xl ring-1 ring-white/10">
                                    </div>
                                    <div class="self-start lg:order-1 lg:self-center">
                                        <x-slide.titulo :texto="$slide['titulo']" />
                                        <p class="{{ $paragrafo }} text-white/75">{{ $slide['texto'] }}</p>
                                        <ul class="mt-4 flex flex-wrap gap-2 md:mt-6 lg:block lg:space-y-3">
                                            @foreach ($slide['destaques'] as [$icone, $texto])
                                                <li class="{{ $chipEscuro }} lg:bg-transparent lg:p-0 lg:text-lg lg:ring-0">
                                                    <span class="flex items-center justify-center text-amarelo lg:size-10 lg:rounded-full lg:bg-amarelo lg:text-preto">
                                                        <i data-lucide="{{ $icone }}" class="size-4 lg:size-5" aria-hidden="true"></i>
                                                    </span>
                                                    {{ $texto }}
                                                </li>
                                            @endforeach
                                        </ul>
                                        <x-slide.botoes :chave="$chave" :nome="'o cartão'" class="mt-5 md:mt-7" />
                                    </div>
                                </div>
                            </div>
                            @break

                        {{-- 7. Consórcio: mosaico com a conversa com o especialista (grande; no computador, larga em cima), as chaves e a casa --}}
                        @case('consorcio')
                            <div class="fundo-escuro relative h-full bg-preto text-white">
                                <div class="{{ $area }} grid-rows-[auto_1fr] lg:grid-cols-2 lg:grid-rows-1">
                                    <div class="mx-auto grid h-36 w-full max-w-sm grid-cols-5 gap-2 md:h-52 lg:h-[min(30rem,calc(100svh-12rem))] lg:max-w-none lg:grid-cols-2 lg:grid-rows-[3fr_2fr] lg:gap-4">
                                        <img src="{{ asset($slide['imagem']) }}" alt="{{ $slide['alt'] }}" width="1400" height="788" loading="lazy"
                                             class="col-span-3 h-full min-h-0 w-full rounded object-cover object-[55%_center] lg:col-span-2 lg:object-[center_30%]">
                                        <div class="col-span-2 grid h-full min-h-0 grid-rows-2 gap-2 lg:grid-cols-2 lg:grid-rows-1 lg:gap-4">
                                            <img src="{{ asset($slide['imagem_2']) }}" alt="{{ $slide['alt_2'] }}" width="1400" height="934" loading="lazy"
                                                 class="size-full min-h-0 rounded object-cover object-[45%_center]">
                                            <img src="{{ asset($slide['imagem_3']) }}" alt="{{ $slide['alt_3'] }}" width="1400" height="787" loading="lazy"
                                                 class="size-full min-h-0 rounded object-cover object-[35%_center]">
                                        </div>
                                    </div>
                                    <div class="self-start lg:self-center">
                                        <x-slide.titulo :texto="$slide['titulo']" />
                                        <p class="{{ $paragrafo }} text-white/75">{{ $slide['texto'] }}</p>
                                        <ol class="mt-4 space-y-2 md:mt-6 lg:space-y-3">
                                            @foreach ($slide['destaques'] as [$icone, $texto])
                                                <li class="flex items-center gap-3 rounded bg-white/5 px-3 py-2 text-sm ring-1 ring-white/10 lg:gap-4 lg:p-4 lg:text-base">
                                                    <span class="font-extrabold text-amarelo lg:text-2xl" aria-hidden="true">0{{ $loop->iteration }}</span>
                                                    <span class="font-semibold">{{ $texto }}</span>
                                                </li>
                                            @endforeach
                                        </ol>
                                        <x-slide.botoes :chave="$chave" :nome="'consórcio'" class="mt-5 md:mt-7" />
                                    </div>
                                </div>
                            </div>
                            @break

                        {{-- 8. Seguros e previdência: foto em círculo com os destaques ao redor --}}
                        @case('seguros_previdencia')
                            <div class="relative h-full bg-gelo text-preto">
                                <div class="{{ $area }} grid-rows-[auto_1fr] lg:grid-cols-[1fr_auto] lg:grid-rows-1">
                                    <div class="relative mx-auto lg:order-2">
                                        <div class="relative mx-auto size-36 md:size-52 lg:size-[min(26rem,calc(100svh-14rem))]">
                                            <div class="absolute -inset-2 rounded-full bg-amarelo lg:-inset-4" aria-hidden="true"></div>
                                            <img src="{{ asset($slide['imagem']) }}" alt="{{ $slide['alt'] }}" width="1400" height="934" loading="lazy"
                                                 class="relative size-full rounded-full object-cover shadow-2xl">
                                            <ul class="hidden lg:block">
                                                @foreach ($slide['destaques'] as [$icone, $texto])
                                                    <li @class(['absolute flex items-center gap-3 rounded bg-fundo p-4 font-semibold shadow-sm', '-top-2 -left-16' => $loop->index === 0, 'top-1/2 right-2 -translate-y-1/2' => $loop->index === 1, '-bottom-2 -left-10' => $loop->index === 2])>
                                                        <i data-lucide="{{ $icone }}" class="size-5 shrink-0" aria-hidden="true"></i> {{ $texto }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="self-start lg:order-1 lg:self-center">
                                        <x-slide.titulo :texto="$slide['titulo']" modo="claro" />
                                        <p class="{{ $paragrafo }} text-texto-suave">{{ $slide['texto'] }}</p>
                                        <ul class="mt-4 flex flex-wrap gap-2 lg:hidden">
                                            @foreach ($slide['destaques'] as [$icone, $texto])
                                                <li class="{{ $chipClaro }}"><i data-lucide="{{ $icone }}" class="size-4" aria-hidden="true"></i> {{ $texto }}</li>
                                            @endforeach
                                        </ul>
                                        <x-slide.botoes :chave="$chave" :nome="'seguros e previdência'" modo="claro" class="mt-5 md:mt-7" />
                                    </div>
                                </div>
                            </div>
                            @break
                    @endswitch
                </article>
            @endforeach
        </div>

        {{-- Setas no meio da altura, coladas nas bordas (dentro da margem lateral do slide, sem cobrir o texto).
             No celular não há margem livre: lá as setas ficam nas pontas da barra de nomes. Não há arrasto. --}}
        @php($seta = 'absolute top-1/2 z-10 hidden size-8 -translate-y-1/2 items-center justify-center rounded bg-preto/70 text-white ring-1 ring-white/25 backdrop-blur transition-colors hover:bg-preto md:flex')
        <button type="button" @click="anterior()" class="{{ $seta }} left-1 xl:left-3">
            <i data-lucide="chevron-left" class="size-5" aria-hidden="true"></i><span class="sr-only">Serviço anterior</span>
        </button>
        <button type="button" @click="proximo()" class="{{ $seta }} right-1 xl:right-3">
            <i data-lucide="chevron-right" class="size-5" aria-hidden="true"></i><span class="sr-only">Próximo serviço</span>
        </button>
    </div>

    {{-- Barra com os nomes dos serviços: leva ao slide e trava o carrossel; a barrinha mostra o tempo até o próximo.
         No celular fica em cima dos slides, no computador embaixo. --}}
    <nav aria-label="Escolha o serviço" class="order-first shrink-0 bg-amarelo text-preto lg:order-none">
        @php($setaBarra = 'flex size-9 shrink-0 items-center justify-center rounded bg-preto text-amarelo transition-colors hover:bg-preto-hover md:hidden')
        <div class="flex items-center gap-2 px-2 py-2 md:px-6 xl:px-14">
            <button type="button" @click="anterior()" class="{{ $setaBarra }}">
                <i data-lucide="chevron-left" class="size-5" aria-hidden="true"></i><span class="sr-only">Serviço anterior</span>
            </button>
            <ul x-ref="nomes" class="flex min-w-0 flex-1 gap-1 overflow-x-auto [scrollbar-width:none] lg:justify-between">
                @foreach ($chaves as $indice => $chave)
                    <li class="shrink-0">
                        <a href="#servico-{{ str_replace('_', '-', $chave) }}" @click.prevent="escolher({{ $indice }})"
                           :aria-current="atual === {{ $indice }} ? 'true' : null"
                           :class="atual === {{ $indice }} ? 'bg-preto text-amarelo' : 'hover:bg-preto/10'"
                           class="relative block overflow-hidden rounded px-4 py-2 text-sm font-bold whitespace-nowrap transition-colors">
                            {{ $servicos[$chave] }}
                            <span x-show="atual === {{ $indice }} && ! travado" x-cloak aria-hidden="true"
                                  class="progresso-carrossel absolute bottom-0 left-0 h-0.5 bg-amarelo"></span>
                        </a>
                    </li>
                @endforeach
            </ul>
            <button type="button" @click="proximo()" class="{{ $setaBarra }}">
                <i data-lucide="chevron-right" class="size-5" aria-hidden="true"></i><span class="sr-only">Próximo serviço</span>
            </button>
        </div>
    </nav>
</section>
