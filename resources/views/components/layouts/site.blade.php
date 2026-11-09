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
    <a href="#conteudo" class="sr-only focus:not-sr-only focus:fixed focus:top-2 focus:left-2 focus:z-50 focus:rounded focus:bg-amarelo focus:font-semibold focus:text-preto focus:px-4 focus:py-2">
        Pular para o conteúdo
    </a>

    <x-site.cabecalho />

    <main id="conteudo" class="flex-1">
        {{ $slot }}
    </main>

    <x-site.rodape />
</body>
</html>
