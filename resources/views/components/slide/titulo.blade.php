{{--
    Título de um slide do carrossel de serviços. A parte entre ** é o destaque:
    - escuro: texto amarelo (fundo preto);
    - claro: marca-texto amarelo animado quando o slide entra (fundo claro: amarelo nunca vira texto);
    - amarelo: tarja preta com texto amarelo (fundo amarelo).
--}}
@props(['texto', 'modo' => 'escuro'])

@php
    $classe = match ($modo) {
        'claro' => 'marca-texto',
        'amarelo' => 'rounded bg-preto px-2 text-amarelo [box-decoration-break:clone]',
        default => 'text-amarelo',
    };
    $html = preg_replace('/\*\*(.+?)\*\*/u', '<span class="'.$classe.'">$1</span>', e($texto));
@endphp

<h2 {{ $attributes->merge(['class' => 'text-[1.75rem] leading-[1.08] font-extrabold tracking-tight md:text-5xl 2xl:text-6xl']) }}>{!! $html !!}</h2>
