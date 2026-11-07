{{-- Home provisória do scaffold. A Home completa é a issue #2 (US-002, wireframe T-01). --}}
<x-layouts.site>
    <section class="bg-gelo">
        <div class="mx-auto max-w-6xl px-4 py-20 md:py-28">
            <h1 class="max-w-2xl text-4xl leading-tight font-extrabold text-preto md:text-5xl">Sua empresa em boas mãos.</h1>
            <p class="mt-4 max-w-xl text-lg leading-relaxed text-texto-suave">
                Mais do que soluções financeiras, oferecemos parceria, orientação e segurança para impulsionar o crescimento da sua empresa.
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="#contato" class="inline-flex items-center gap-2 rounded bg-preto px-6 py-3 font-semibold text-white hover:bg-preto-hover">
                    Quero abrir minha conta <i data-lucide="arrow-right" class="size-4" aria-hidden="true"></i>
                </a>
                <a href="https://wa.me/{{ config('b2bsafe.whatsapp.geral') }}?text={{ rawurlencode('Olá! Vim pelo site da B2BSAFE.') }}"
                   class="inline-flex items-center rounded bg-whatsapp px-6 py-3 font-semibold text-white">
                    Falar no WhatsApp
                </a>
            </div>
        </div>
    </section>
</x-layouts.site>
