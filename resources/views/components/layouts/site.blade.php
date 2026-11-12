@props(['titulo' => null, 'whatsapp' => 'geral', 'descricao' => 'Escritório parceiro C6 Empresas em Florianópolis: conta PJ, crédito, maquininha e mais.'])

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if ($ga4 = \App\Support\Analytics::idAtivo())
        {{-- GA4 só carrega depois do consentimento estatístico (RF-010) --}}
        <meta name="ga4-id" content="{{ $ga4 }}">
    @endif
    @php($tituloCompleto = $titulo ? $titulo.' | B2BSAFE' : 'B2BSAFE | Escritório parceiro C6 Empresas')
    <title>{{ $tituloCompleto }}</title>
    <meta name="description" content="{{ $descricao }}">
    {{-- SEO técnico (RF-011): URL canônica sem parâmetros de campanha, Open Graph e Twitter Card --}}
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="B2BSAFE">
    <meta property="og:locale" content="pt_BR">
    <meta property="og:title" content="{{ $tituloCompleto }}">
    <meta property="og:description" content="{{ $descricao }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('img/og-b2bsafe.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="B2BSAFE, escritório parceiro C6 Empresas">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="theme-color" content="#060606">
    @stack('head')
    {{-- Fonte carregada cedo: evita o texto "pular" quando a Urbanist chega (CLS) --}}
    @unless (\Illuminate\Support\Facades\Vite::isRunningHot())
        <link rel="preload" as="font" type="font/woff2" crossorigin
              href="{{ \Illuminate\Support\Facades\Vite::asset('node_modules/@fontsource-variable/urbanist/files/urbanist-latin-wght-normal.woff2') }}">
    @endunless
    @unless (app()->isProduction())
        {{-- Demonstração e homologação fora dos buscadores (RF-011) --}}
        <meta name="robots" content="noindex, nofollow">
    @endunless
    {{-- Com JavaScript, os blocos aparecem ao rolar; sem ele, tudo fica visível --}}
    <script>document.documentElement.classList.add('js')</script>
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
       style="bottom: calc(1rem + var(--altura-faixa-cookies, 0px))"
       class="fixed right-4 z-20 flex size-14 items-center justify-center rounded-full bg-whatsapp text-white shadow-lg transition-colors hover:bg-[#054a42]"
       aria-label="Falar no WhatsApp (abre em nova aba)">
        <x-icone-marca nome="whatsapp" class="size-7" />
    </a>

    <x-site.banner-cookies />
</body>
</html>
