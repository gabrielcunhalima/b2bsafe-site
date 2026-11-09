{{-- Rodapé com dados legais, contato, redes e aviso de parceiro C6 (T-10, RF-001, RN-015) --}}
@php
    $whatsapp = config('b2bsafe.whatsapp.geral');
    $whatsappExibicao = \App\Support\Telefone::formatar($whatsapp);
    $email = config('b2bsafe.email_contato');
@endphp

<footer class="fundo-escuro bg-preto text-sm text-white/75">
    <div class="mx-auto grid max-w-6xl gap-10 px-4 py-12 sm:grid-cols-2 lg:grid-cols-4">
        <div>
            <p class="text-lg font-extrabold tracking-widest text-white">B2BSAFE</p>
            <p class="mt-3 leading-relaxed">Escritório parceiro oficial do C6 Empresas. B2BSAFE, Be Safe!</p>
        </div>

        @foreach (config('b2bsafe.empresas') as $empresa)
            <div>
                <p class="font-semibold text-white">{{ $empresa['nome'] }}</p>
                <p class="mt-2">CNPJ {{ $empresa['cnpj'] }}</p>
                <p class="mt-2 flex gap-2">
                    <i data-lucide="map-pin" class="mt-0.5 size-4 shrink-0 text-amarelo" aria-hidden="true"></i>
                    <span>{{ $empresa['endereco'] }}<br>{{ $empresa['cidade'] }}</span>
                </p>
            </div>
        @endforeach

        <div>
            <p class="font-semibold text-white">Contato</p>
            <ul class="mt-2 space-y-2">
                <li>
                    <a href="{{ \App\Support\WhatsApp::link() }}" target="_blank" rel="noopener noreferrer" data-whatsapp="rodape"
                       class="inline-flex items-center gap-2 rounded hover:text-white hover:underline">
                        <x-icone-marca nome="whatsapp" class="size-4 text-amarelo" /> WhatsApp {{ $whatsappExibicao }}
                    </a>
                </li>
                <li>
                    <a href="mailto:{{ $email }}" class="inline-flex items-center gap-2 rounded break-all hover:text-white hover:underline">
                        <i data-lucide="mail" class="size-4 shrink-0 text-amarelo" aria-hidden="true"></i> {{ $email }}
                    </a>
                </li>
            </ul>
            <ul class="mt-4 flex gap-2" aria-label="Redes sociais">
                @foreach (config('b2bsafe.redes_sociais') as $nome => $rede)
                    <li>
                        <a href="{{ $rede['url'] }}" target="_blank" rel="noopener noreferrer"
                           class="flex size-10 items-center justify-center rounded-full bg-white/10 text-white transition-colors hover:bg-amarelo hover:text-preto"
                           aria-label="{{ $rede['rotulo'] }} da B2BSAFE (abre em nova aba)">
                            <x-icone-marca :nome="$nome" />
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="mx-auto max-w-6xl px-4 pb-10">
        <div class="h-px bg-white/15" aria-hidden="true"></div>

        <nav aria-label="Links legais" class="mt-6 flex flex-wrap gap-x-6 gap-y-1">
            {{-- Os links legais aparecem quando as páginas existirem: /privacidade (#4) e /policy (#5). --}}
            @if (Route::has('privacidade'))
                <a href="{{ route('privacidade') }}" class="inline-flex min-h-6 items-center gap-1 rounded py-1 underline hover:text-white">Política de Privacidade</a>
            @endif
            @if (Route::has('policy'))
                <a href="{{ route('policy') }}" class="inline-flex min-h-6 items-center gap-1 rounded py-1 underline hover:text-white">Termos do B2BSafe Connect</a>
            @endif
            {{-- O banner de cookies (RF-009, #12) escuta este evento para reabrir as preferências. --}}
            <button type="button" x-data @click="$dispatch('abrir-preferencias-cookies')" class="inline-flex min-h-6 items-center gap-1 rounded py-1 underline hover:text-white">
                Preferências de cookies
            </button>
            <a href="{{ config('b2bsafe.verificacao_c6') }}" target="_blank" rel="noopener noreferrer" class="inline-flex min-h-6 items-center gap-1 rounded py-1 underline hover:text-white">
                Verificar credenciamento no C6 Bank
                <i data-lucide="external-link" class="size-3.5" aria-hidden="true"></i>
                <span class="sr-only">(abre em nova aba)</span>
            </a>
        </nav>

        {{-- RN-015: aviso de parceiro e canais oficiais em todas as páginas públicas --}}
        <p class="mt-6 max-w-4xl text-xs leading-relaxed text-white/65">
            A B2BSAFE é escritório parceiro e distribuidor do C6 Bank. As informações deste site não são canais oficiais do C6.
            Canais oficiais do C6 Bank:
            @foreach (config('b2bsafe.canais_c6') as $canal => $contato)
                {{ $canal }} {{ $contato }}{{ $loop->last ? '.' : ' ·' }}
            @endforeach
        </p>
        <p class="mt-4 text-xs text-white/65">© {{ now()->year }} B2BSAFE. Todos os direitos reservados.</p>
    </div>
</footer>
