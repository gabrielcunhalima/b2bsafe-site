@props(['titulo' => null, 'whatsapp' => 'geral', 'descricao' => 'Escritório parceiro oficial do C6 Empresas em Florianópolis: conta PJ, crédito, maquininha e mais.'])

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    {{-- Botão flutuante de WhatsApp (RF-005, RN-021); o assistente virtual entra ao lado na Entrega 2 --}}
    <a href="{{ \App\Support\WhatsApp::link($whatsapp, $whatsapp === 'maquininha' ? 'Olá! Vim pelo site e quero saber sobre a maquininha C6 Pay.' : null) }}"
       target="_blank" rel="noopener noreferrer" data-whatsapp="flutuante" @if ($whatsapp === 'maquininha') data-servico="maquininha" @endif
       class="fixed right-4 bottom-4 z-20 flex size-14 items-center justify-center rounded-full bg-whatsapp text-white shadow-lg transition-transform hover:scale-105"
       aria-label="Falar no WhatsApp (abre em nova aba)">
        <x-icone-marca nome="whatsapp" class="size-7" />
    </a>
</body>
</html>
