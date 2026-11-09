@props(['id', 'numero', 'titulo'])

<section id="{{ $id }}" aria-labelledby="{{ $id }}-titulo" class="scroll-mt-24">
    <h2 id="{{ $id }}-titulo">{{ $numero }}. {{ $titulo }}</h2>
    {{ $slot }}
</section>
