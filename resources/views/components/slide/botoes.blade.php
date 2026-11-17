{{--
    Botões de um slide: WhatsApp citando o serviço (RN-021; a maquininha usa o número próprio)
    e "Fale conosco", que abre o formulário com o serviço já escolhido.
    modo: escuro (fundo preto), claro (fundo gelo) ou amarelo (fundo amarelo).
--}}
@props(['chave', 'nome', 'modo' => 'escuro'])

@php
    $principal = match ($modo) {
        'amarelo' => 'bg-preto text-white hover:bg-preto-hover',
        'claro' => 'bg-preto text-white hover:bg-preto-hover',
        default => 'bg-amarelo text-preto hover:bg-amarelo-hover',
    };
    $secundario = match ($modo) {
        'escuro' => 'text-white ring-1 ring-white/40 hover:bg-white/10',
        default => 'text-preto ring-1 ring-preto/30 hover:bg-preto/5',
    };
    $base = 'inline-flex items-center justify-center gap-2 rounded px-4 py-2.5 text-sm font-semibold transition-colors md:px-7 md:py-3.5 md:text-base';
@endphp

<div {{ $attributes->merge(['class' => 'flex flex-wrap gap-2 md:gap-3']) }}>
    <a href="{{ \App\Support\WhatsApp::linkDoServico($chave) }}" target="_blank" rel="noopener noreferrer"
       data-whatsapp="carrossel" data-servico="{{ $chave }}" class="{{ $base }} {{ $principal }}">
        <x-icone-marca nome="whatsapp" class="size-5" /> Falar sobre {{ $nome }}
        <span class="sr-only">(abre o WhatsApp em nova aba)</span>
    </a>
    @if ($chave === 'maquininha' && Route::has('maquininha'))
        <a href="{{ route('maquininha') }}" class="{{ $base }} {{ $secundario }}">
            Ver taxas e condições <i data-lucide="arrow-right" class="size-4" aria-hidden="true"></i>
        </a>
    @else
        <a href="#contato" data-servico="{{ $chave }}" class="{{ $base }} {{ $secundario }}">
            Fale conosco <i data-lucide="arrow-right" class="size-4" aria-hidden="true"></i>
        </a>
    @endif
</div>
