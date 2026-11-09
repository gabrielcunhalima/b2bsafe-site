{{--
    Layout das páginas legais: título, versão e data visíveis, índice das seções e texto com boa leitura.
    Cada seção é um <x-pagina-legal.secao numero="1" titulo="...">.
--}}
@props(['titulo', 'descricao', 'versao' => null, 'atualizadaEm', 'secoes' => []])

<x-layouts.site :titulo="$titulo" :descricao="$descricao">
    <section class="bg-gelo">
        <div class="mx-auto max-w-6xl px-4 py-14 md:py-20">
            <h1 class="text-4xl leading-tight font-extrabold text-preto md:text-5xl">{{ $titulo }}</h1>
            <p class="mt-4 flex flex-wrap gap-x-4 gap-y-1 text-texto-suave">
                @if ($versao)
                    <span>Versão {{ $versao }}</span>
                @endif
                <span>Última atualização: <time datetime="{{ $atualizadaEm }}">{{ \Illuminate\Support\Carbon::parse($atualizadaEm)->format('d/m/Y') }}</time></span>
            </p>
        </div>
    </section>

    <div class="mx-auto grid max-w-6xl gap-10 px-4 py-12 md:py-16 lg:grid-cols-[16rem_1fr]">
        @if ($secoes)
            <nav aria-label="Seções do documento" class="lg:sticky lg:top-24 lg:self-start">
                <p class="font-bold text-preto">Nesta página</p>
                <ol class="mt-3 space-y-1 text-sm">
                    @foreach ($secoes as $ancora => $nome)
                        <li><a href="#{{ $ancora }}" class="block rounded px-2 py-1.5 text-texto-suave hover:bg-gelo hover:text-preto">{{ $nome }}</a></li>
                    @endforeach
                </ol>
            </nav>
        @endif

        <article class="texto-legal max-w-3xl">
            {{ $slot }}
        </article>
    </div>
</x-layouts.site>
