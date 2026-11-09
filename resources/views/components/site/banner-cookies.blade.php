{{--
    Banner e preferências de cookies (US-012, RF-009, RN-011, wireframe T-06).
    Faixa no rodapé sem prender o foco; "Recusar" e "Aceitar todos" com o mesmo peso; diálogo "Personalizar"
    com foco preso e Esc para fechar. Reaberto pelo evento "abrir-preferencias-cookies" (link do rodapé).
--}}
@php
    $escolha = \App\Support\PreferenciasCookies::doRequest(request());
    $saibaMais = Route::has('privacidade') ? route('privacidade').'#cookies' : null;
    $botao = 'inline-flex items-center justify-center rounded px-5 py-2.5 font-semibold whitespace-nowrap transition-colors';
@endphp

<div x-data="preferenciasCookies(@js(['escolha' => $escolha, 'url' => route('cookies.preferencias')]))"
     @abrir-preferencias-cookies.window="abrirDialogo()">

    {{-- 1. Faixa no rodapé: primeiro acesso ou nova versão da política de cookies --}}
    <section x-cloak x-show="faixaAberta" x-ref="faixa" aria-labelledby="cookies-faixa-titulo"
             class="fundo-escuro fixed inset-x-0 bottom-0 z-30 bg-preto text-white shadow-[0_-8px_24px_rgb(0_0_0/0.25)]">
        <div class="mx-auto flex max-w-6xl flex-col gap-4 px-4 py-5 lg:flex-row lg:items-center lg:justify-between">
            <div class="max-w-3xl text-sm leading-relaxed text-white/85">
                <h2 id="cookies-faixa-titulo" class="mb-1 text-base font-bold text-white">Cookies neste site</h2>
                Usamos cookies necessários para o site funcionar e, se você permitir, cookies estatísticos (Google Analytics) para entender como o site é usado.
                @if ($saibaMais)
                    <a href="{{ $saibaMais }}" class="rounded font-semibold text-white underline">Saiba mais</a>.
                @endif
            </div>
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                <button type="button" @click="abrirDialogo()" class="{{ $botao }} text-white underline hover:bg-white/10">Personalizar</button>
                <button type="button" @click="salvar(false)" class="{{ $botao }} bg-white text-preto hover:bg-gelo">Recusar</button>
                <button type="button" @click="salvar(true)" class="{{ $botao }} bg-white text-preto hover:bg-gelo">Aceitar todos</button>
            </div>
        </div>
    </section>

    {{-- 2. Personalizar --}}
    <div x-cloak x-show="dialogoAberto" @keydown.escape.prevent.stop="fecharDialogo()"
         class="fixed inset-0 z-50 flex items-end justify-center bg-preto/60 p-4 sm:items-center">
        <div role="dialog" aria-modal="true" aria-labelledby="cookies-dialogo-titulo" x-trap.noscroll="dialogoAberto"
             @click.outside="fecharDialogo()" class="w-full max-w-lg rounded-2xl bg-fundo p-6 shadow-2xl md:p-8">
            <div class="flex items-start justify-between gap-4">
                <h2 id="cookies-dialogo-titulo" class="text-2xl font-extrabold text-preto">Preferências de cookies</h2>
                <button type="button" @click="fecharDialogo()" class="rounded p-1 text-texto-suave hover:bg-gelo" aria-label="Fechar">
                    <i data-lucide="x" class="size-5" aria-hidden="true"></i>
                </button>
            </div>

            <ul class="mt-6 divide-y divide-borda">
                <li class="flex items-start justify-between gap-4 pb-5">
                    <div>
                        <p class="font-bold text-preto">Necessários</p>
                        <p class="mt-1 text-sm text-texto-suave">Sessão, segurança e lembrar sua escolha.</p>
                    </div>
                    <span class="shrink-0 rounded-full bg-gelo px-3 py-1 text-sm font-semibold text-preto">Sempre ativo</span>
                </li>
                <li class="flex items-start justify-between gap-4 pt-5">
                    <div>
                        <label for="cookies-estatisticos" class="font-bold text-preto">Estatísticos</label>
                        <p id="cookies-estatisticos-descricao" class="mt-1 text-sm text-texto-suave">Google Analytics 4: páginas visitadas e origem da visita, sem identificar você.</p>
                    </div>
                    <input id="cookies-estatisticos" type="checkbox" role="switch" x-model="estatisticos"
                           aria-describedby="cookies-estatisticos-descricao" class="mt-1 size-6 shrink-0 accent-preto">
                </li>
            </ul>

            <div class="mt-8 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                <button type="button" @click="salvar(false)" class="{{ $botao }} border border-borda text-preto hover:bg-gelo">Recusar todos</button>
                <button type="button" @click="salvar(estatisticos)" class="{{ $botao }} bg-preto text-white hover:bg-preto-hover">Salvar escolhas</button>
            </div>
        </div>
    </div>

    {{-- 3. Depois da escolha: aviso lido pelo leitor de tela --}}
    <div role="status" aria-live="polite" class="pointer-events-none fixed bottom-4 left-4 z-40 max-w-sm">
        <p x-cloak x-show="aviso" x-transition.opacity x-text="aviso"
           class="rounded-lg bg-preto px-4 py-3 text-sm text-white shadow-lg"></p>
    </div>
</div>
