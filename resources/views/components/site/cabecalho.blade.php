{{-- Cabeçalho fixo com menu por âncoras e menu móvel em tela cheia (T-10, RF-001) --}}
@php
    $naHome = request()->routeIs('inicio');
    // Na Home as âncoras são locais; nas outras páginas apontam para /#secao.
    $ancora = fn (string $id): string => ($naHome ? '' : route('inicio')).'#'.$id;
    $itens = [
        'servicos' => 'Serviços',
        'maquininha' => 'Maquininha',
        'sobre' => 'Sobre',
        'parcerias' => 'Parcerias',
        'credenciamento' => 'Credenciamento',
    ];
@endphp

<header x-data="menuSite" @keydown.escape.window="fechar()" class="sticky top-0 z-30 bg-fundo shadow-sm">
    <div class="mx-auto flex h-16 max-w-6xl items-center justify-between gap-4 px-4">
        <a href="{{ route('inicio') }}" class="flex items-center gap-4 rounded">
            <img src="{{ asset('img/b2bsafe-logo.webp') }}" alt="B2BSAFE, página inicial" width="191" height="41" class="h-8 w-auto">
            <span class="hidden text-xs leading-tight text-texto-suave sm:inline">Escritório parceiro<br>C6 Empresas</span>
        </a>

        <nav aria-label="Principal" class="hidden items-center gap-1 text-sm font-semibold lg:flex">
            @foreach ($itens as $id => $rotulo)
                @if ($id === 'maquininha' && request()->routeIs('maquininha'))
                    {{-- Na própria página da Maquininha, o item aponta para ela e fica marcado como página atual --}}
                    <a href="{{ route('maquininha') }}" aria-current="page" class="rounded bg-gelo px-3 py-2 text-preto">{{ $rotulo }}</a>
                @else
                    <a href="{{ $ancora($id) }}"
                       class="rounded px-3 py-2 text-texto transition-colors hover:bg-gelo"
                       :class="ativa === @js($id) && 'bg-gelo text-preto'"
                       :aria-current="ativa === @js($id) ? 'true' : null">{{ $rotulo }}</a>
                @endif
            @endforeach
            <a href="{{ $ancora('contato') }}" class="ml-3 rounded bg-preto px-4 py-2 text-white transition-colors hover:bg-preto-hover">Fale conosco</a>
        </nav>

        <button type="button" @click="abrir()"
                class="inline-flex items-center gap-2 rounded border border-borda px-3 py-2 text-sm font-semibold lg:hidden"
                aria-controls="menu-movel" :aria-expanded="aberto.toString()" aria-expanded="false">
            <i data-lucide="menu" class="size-4" aria-hidden="true"></i> Menu
        </button>
    </div>

    <div id="menu-movel" x-cloak x-show="aberto" x-trap.inert.noscroll="aberto"
         role="dialog" aria-modal="true" aria-label="Menu"
         class="fixed inset-0 z-40 flex flex-col overflow-y-auto bg-fundo lg:hidden">
        <div class="flex h-16 shrink-0 items-center justify-between px-4 shadow-sm">
            <img src="{{ asset('img/b2bsafe-logo.webp') }}" alt="B2BSAFE" width="191" height="41" class="h-8 w-auto">
            <button type="button" @click="fechar()" class="inline-flex items-center gap-2 rounded border border-borda px-3 py-2 text-sm font-semibold">
                <i data-lucide="x" class="size-4" aria-hidden="true"></i> Fechar
            </button>
        </div>
        <nav aria-label="Principal no celular" class="flex flex-col px-4 py-2 text-lg font-semibold">
            <ul class="divide-y divide-borda">
                @foreach ($itens as $id => $rotulo)
                    <li>
                        <a href="{{ $ancora($id) }}" @click="fechar()" class="-mx-2 flex items-center justify-between rounded px-2 py-4"
                           :class="ativa === @js($id) && 'bg-gelo'"
                           :aria-current="ativa === @js($id) ? 'true' : null">
                            {{ $rotulo }} <i data-lucide="chevron-right" class="size-5 text-texto-terciario" aria-hidden="true"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
            <a href="{{ $ancora('contato') }}" @click="fechar()" class="mt-6 rounded bg-preto px-4 py-3 text-center text-white">Fale conosco</a>
        </nav>
    </div>
</header>
