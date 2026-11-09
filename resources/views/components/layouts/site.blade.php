@props(['titulo' => null, 'descricao' => 'Escritório parceiro oficial do C6 Empresas em Florianópolis: conta PJ, crédito, maquininha e mais.'])

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $titulo ? $titulo.' | B2BSAFE' : 'B2BSAFE | Escritório parceiro C6 Empresas' }}</title>
    <meta name="description" content="{{ $descricao }}">
    @unless (app()->isProduction())
        {{-- Demonstração e homologação fora dos buscadores (RF-011) --}}
        <meta name="robots" content="noindex, nofollow">
    @endunless
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col">
    <a href="#conteudo" class="sr-only focus:not-sr-only focus:fixed focus:top-2 focus:left-2 focus:z-50 focus:rounded focus:bg-fundo focus:px-4 focus:py-2">
        Pular para o conteúdo
    </a>

    <header class="sticky top-0 z-30 bg-fundo/95 shadow-sm backdrop-blur">
        <div class="mx-auto flex h-16 max-w-6xl items-center justify-between gap-4 px-4">
            <a href="{{ route('inicio') }}" class="text-lg font-extrabold tracking-widest text-preto">B2BSAFE</a>
            <nav aria-label="Principal" class="hidden items-center gap-6 text-sm font-semibold lg:flex">
                <a href="{{ route('inicio') }}#servicos" class="hover:underline">Serviços</a>
                <a href="{{ route('inicio') }}#maquininha" class="hover:underline">Maquininha</a>
                <a href="{{ route('inicio') }}#sobre" class="hover:underline">Sobre</a>
                <a href="{{ route('inicio') }}#contato" class="rounded bg-preto px-4 py-2 text-white hover:bg-preto-hover">Fale conosco</a>
            </nav>
        </div>
    </header>

    <main id="conteudo" class="flex-1">
        {{ $slot }}
    </main>

    <footer class="fundo-escuro bg-preto text-sm text-white/80">
        <div class="mx-auto max-w-6xl px-4 py-10">
            <p class="text-lg font-extrabold tracking-widest text-white">B2BSAFE</p>
            <p class="mt-4 max-w-3xl text-xs">
                A B2BSAFE é escritório parceiro e distribuidor do C6 Bank. As informações deste site não são canais oficiais do C6.
                Canais oficiais do C6 Bank: SAC 24h 0800 660 0060 · Central 3003 6116 · Ouvidoria 0800 660 6060.
            </p>
        </div>
    </footer>
</body>
</html>
