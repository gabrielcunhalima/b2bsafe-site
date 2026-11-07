{{-- Layout das páginas de erro: sem consultas ao banco, para funcionar mesmo com a aplicação degradada. --}}
<x-layouts.site :titulo="$titulo">
    <section class="mx-auto max-w-2xl px-4 py-24 text-center">
        <p class="text-6xl font-extrabold text-borda">{{ $codigo }}</p>
        <h1 class="mt-4 text-3xl font-bold text-preto">{{ $titulo }}</h1>
        <p class="mt-3 text-texto-suave">{{ $mensagem }}</p>
        <div class="mt-8 flex flex-wrap justify-center gap-3">
            <a href="{{ url('/') }}" class="rounded bg-preto px-6 py-3 font-semibold text-white hover:bg-preto-hover">Ir para a página inicial</a>
            <a href="https://wa.me/{{ config('b2bsafe.whatsapp.geral') }}?text={{ rawurlencode('Olá! Vim pelo site da B2BSAFE.') }}"
               class="rounded bg-whatsapp px-6 py-3 font-semibold text-white">Falar no WhatsApp</a>
        </div>
    </section>
</x-layouts.site>
