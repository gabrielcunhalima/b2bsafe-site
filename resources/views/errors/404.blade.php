{{-- 404 amigável no layout do site, com links úteis (US-006, RF-012) --}}
<x-layouts.site titulo="Página não encontrada">
    <section class="bg-gelo">
        <div class="mx-auto max-w-3xl px-4 py-20 text-center md:py-28">
            <p class="text-7xl font-extrabold text-preto" aria-hidden="true">404</p>
            <h1 class="mt-6 text-3xl font-extrabold text-preto md:text-4xl">Não encontramos esta página.</h1>
            <p class="mt-3 text-lg text-texto-suave">O endereço pode ter mudado. Escolha um caminho abaixo ou fale com a gente.</p>

            <ul class="mt-10 grid gap-4 text-left sm:grid-cols-2">
                <li>
                    <a href="{{ route('inicio') }}" class="flex items-center gap-4 rounded-xl bg-fundo p-5 shadow-sm transition-shadow hover:shadow-md">
                        <i data-lucide="house" class="size-6 shrink-0 text-preto" aria-hidden="true"></i>
                        <span><span class="block font-bold text-preto">Página inicial</span><span class="text-sm text-texto-suave">Conheça a B2BSAFE e os serviços</span></span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route::has('maquininha') ? route('maquininha') : route('inicio').'#maquininha' }}" class="flex items-center gap-4 rounded-xl bg-fundo p-5 shadow-sm transition-shadow hover:shadow-md">
                        <i data-lucide="credit-card" class="size-6 shrink-0 text-preto" aria-hidden="true"></i>
                        <span><span class="block font-bold text-preto">Maquininha C6 Pay</span><span class="text-sm text-texto-suave">Vantagens e taxas</span></span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('inicio') }}#contato" class="flex items-center gap-4 rounded-xl bg-fundo p-5 shadow-sm transition-shadow hover:shadow-md">
                        <i data-lucide="mail" class="size-6 shrink-0 text-preto" aria-hidden="true"></i>
                        <span><span class="block font-bold text-preto">Fale conosco</span><span class="text-sm text-texto-suave">Deixe seus dados no formulário</span></span>
                    </a>
                </li>
                <li>
                    <a href="{{ \App\Support\WhatsApp::link() }}" target="_blank" rel="noopener noreferrer" data-whatsapp="404"
                       class="flex items-center gap-4 rounded-xl bg-fundo p-5 shadow-sm transition-shadow hover:shadow-md">
                        <x-icone-marca nome="whatsapp" class="size-6 text-whatsapp" />
                        <span><span class="block font-bold text-preto">WhatsApp</span><span class="text-sm text-texto-suave">Fale direto com um atendente</span></span>
                        <span class="sr-only">(abre o WhatsApp em nova aba)</span>
                    </a>
                </li>
            </ul>
        </div>
    </section>
</x-layouts.site>
