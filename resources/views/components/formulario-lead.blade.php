{{--
    Formulário de lead (RF-006, wireframe T-03). Com JavaScript envia sem recarregar e troca o formulário
    pela mensagem de sucesso; sem JavaScript, faz o POST normal e volta para #contato.
    Uso: <x-formulario-lead servico="maquininha" />
--}}
@props(['servico' => null])

@php
    use App\Support\WhatsApp;

    $enviado = session('lead_enviado');
    $falha = session('lead_falha');
    $servicoInicial = old('servico', request()->query('servico', $servico));
    $servicoInicial = array_key_exists((string) $servicoInicial, config('b2bsafe.servicos')) ? $servicoInicial : '';
    $campo = 'w-full rounded-lg border bg-fundo px-4 py-3 text-texto transition-[border-color,box-shadow] duration-200 placeholder:text-texto-terciario focus:border-preto focus-visible:outline-none focus-visible:shadow-[0_0_0_4px_rgb(6_6_6/0.12)]';
    // Links de WhatsApp do formulário seguem o contexto da página: na Maquininha, o número da maquininha (RN-021)
    $linkWhatsapp = $servicoInicial ? WhatsApp::linkDoServico($servicoInicial) : WhatsApp::link();
    $erroCampo = fn (string $nome) => $errors->has($nome) ? 'border-2 border-erro' : 'border-borda';
@endphp

<div x-data="formularioLead(@js(['servico' => $servicoInicial]))" @selecionar-servico.window="selecionarServico($event.detail)"
     class="fundo-claro rounded-3xl bg-fundo p-6 text-texto shadow-xl md:p-8">

    {{-- Sucesso (substitui o formulário) --}}
    <div x-cloak x-show="sucesso" x-ref="sucesso" tabindex="-1" role="status" class="py-6 text-center"
         @if ($enviado) x-init="sucesso = @js($enviado); $nextTick(() => $refs.sucesso.focus())" @endif>
        <span class="mx-auto flex size-14 items-center justify-center rounded-full bg-amarelo text-preto">
            <i data-lucide="check" class="size-7" aria-hidden="true"></i>
        </span>
        <h3 class="mt-5 text-2xl font-extrabold text-preto">Recebemos seu contato<span x-text="sucesso?.nome ? ', ' + sucesso.nome : ''"></span>!</h3>
        <p class="mt-2 text-texto-suave">
            Em breve um especialista da B2BSAFE fala com você sobre <strong class="text-preto" x-text="sucesso?.nome_servico"></strong>.
        </p>
        <p class="mt-4 text-texto-suave">Quer adiantar? Continue a conversa pelo WhatsApp.</p>
        <a :href="sucesso?.whatsapp" href="{{ $linkWhatsapp }}" target="_blank" rel="noopener noreferrer"
           data-whatsapp="formulario-sucesso" :data-servico="sucesso?.servico"
           class="mt-5 inline-flex items-center justify-center gap-2 rounded bg-whatsapp px-6 py-3 font-semibold text-white transition-colors hover:bg-[#054a42]">
            <x-icone-marca nome="whatsapp" class="size-5" /> Seguir pelo WhatsApp
            <span class="sr-only">(abre o WhatsApp em nova aba)</span>
        </a>
    </div>

    <form x-show="!sucesso" x-ref="formulario" method="POST" action="{{ route('leads.store') }}" novalidate
          @submit.prevent="enviar" class="space-y-5" aria-describedby="legenda-obrigatorios">
        @csrf

        {{-- Resumo de erros: o foco vai para cá no envio com erro --}}
        <div x-cloak x-show="listaErros.length" x-ref="resumo" tabindex="-1" role="alert"
             class="rounded-lg border-2 border-erro bg-erro/5 p-4 text-sm">
            <p class="flex items-center gap-2 font-bold text-erro">
                <i data-lucide="triangle-alert" class="size-4" aria-hidden="true"></i>
                <span x-text="listaErros.length === 1 ? 'Corrija 1 campo para enviar:' : 'Corrija ' + listaErros.length + ' campos para enviar:'"></span>
            </p>
            <ul class="mt-2 list-disc space-y-1 pl-5">
                <template x-for="item in listaErros" :key="item.campo">
                    <li><a :href="'#lead-' + item.campo" class="rounded underline" @click.prevent="focarCampo(item.campo)" x-text="item.mensagem"></a></li>
                </template>
            </ul>
        </div>

        @if ($errors->any())
            <div x-data x-show="false" role="alert" class="rounded-lg border-2 border-erro bg-erro/5 p-4 text-sm">
                <p class="font-bold text-erro">Corrija os campos destacados para enviar.</p>
            </div>
        @endif

        {{-- Falha ou limite de envios (RN-016) --}}
        <div x-cloak x-show="falha" role="alert" class="rounded-lg border-2 border-erro bg-erro/5 p-4 text-sm"
             @if ($falha) x-init="falha = @js($falha)" @endif>
            <p class="font-bold text-erro" x-text="falha"></p>
            <a href="{{ $linkWhatsapp }}" target="_blank" rel="noopener noreferrer" data-whatsapp="formulario-falha"
               class="mt-3 inline-flex items-center gap-2 rounded bg-whatsapp px-4 py-2 font-semibold text-white">
                <x-icone-marca nome="whatsapp" class="size-4" /> Falar no WhatsApp
                <span class="sr-only">(abre o WhatsApp em nova aba)</span>
            </a>
        </div>

        <div>
            <label for="lead-nome" class="mb-1 block font-semibold text-preto">Nome completo <span aria-hidden="true">*</span></label>
            <input id="lead-nome" name="nome" type="text" required minlength="2" maxlength="120" autocomplete="name"
                   value="{{ old('nome') }}" data-erro="Informe seu nome."
                   class="{{ $campo }} {{ $erroCampo('nome') }}" :class="erros.nome && 'border-2 border-erro'"
                   :aria-invalid="erros.nome ? 'true' : null" aria-describedby="erro-nome" @input="limparSeValido($event.target)" @blur="avisarSeInvalido($event.target)">
            <x-formulario-lead.erro campo="nome" />
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="lead-whatsapp" class="mb-1 block font-semibold text-preto">WhatsApp <span aria-hidden="true">*</span></label>
                <input id="lead-whatsapp" name="whatsapp" type="tel" inputmode="tel" required autocomplete="tel" maxlength="20"
                       placeholder="(48) 99999-1234" value="{{ old('whatsapp') }}"
                       data-erro="Informe um celular com DDD, por exemplo (48) 99999-1234."
                       class="{{ $campo }} {{ $erroCampo('whatsapp') }}" :class="erros.whatsapp && 'border-2 border-erro'"
                       :aria-invalid="erros.whatsapp ? 'true' : null" aria-describedby="dica-whatsapp erro-whatsapp"
                       @input="mascararTelefone($event.target); limparSeValido($event.target)" @blur="avisarSeInvalido($event.target)">
                <p id="dica-whatsapp" class="mt-1 text-sm text-texto-suave">Com DDD.</p>
                <x-formulario-lead.erro campo="whatsapp" />
            </div>
            <div>
                <label for="lead-email" class="mb-1 block font-semibold text-preto">E-mail <span aria-hidden="true">*</span></label>
                <input id="lead-email" name="email" type="email" required autocomplete="email" maxlength="190"
                       placeholder="voce@empresa.com.br" value="{{ old('email') }}"
                       data-erro="Informe um e-mail válido, por exemplo voce@empresa.com.br."
                       class="{{ $campo }} {{ $erroCampo('email') }}" :class="erros.email && 'border-2 border-erro'"
                       :aria-invalid="erros.email ? 'true' : null" aria-describedby="erro-email" @input="limparSeValido($event.target)" @blur="avisarSeInvalido($event.target)">
                <x-formulario-lead.erro campo="email" />
            </div>
        </div>

        <div>
            <label for="lead-servico" class="mb-1 block font-semibold text-preto">Serviço de interesse <span aria-hidden="true">*</span></label>
            <select id="lead-servico" name="servico" required x-model="servico" data-erro="Escolha o serviço de interesse."
                    class="{{ $campo }} {{ $erroCampo('servico') }}" :class="erros.servico && 'border-2 border-erro'"
                    :aria-invalid="erros.servico ? 'true' : null" aria-describedby="erro-servico" @change="limparSeValido($event.target); avisarSeInvalido($event.target)">
                <option value="">Selecione</option>
                @foreach (config('b2bsafe.servicos') as $chave => $nome)
                    <option value="{{ $chave }}" @selected($servicoInicial === $chave)>{{ $nome }}</option>
                @endforeach
            </select>
            <x-formulario-lead.erro campo="servico" />
        </div>

        <div>
            <label for="lead-mensagem" class="mb-1 block font-semibold text-preto">Mensagem <span class="font-normal text-texto-suave">(opcional)</span></label>
            <textarea id="lead-mensagem" name="mensagem" rows="3" maxlength="1000" aria-describedby="erro-mensagem"
                      class="{{ $campo }} {{ $erroCampo('mensagem') }}">{{ old('mensagem') }}</textarea>
            <x-formulario-lead.erro campo="mensagem" />
        </div>

        {{-- Armadilha para robôs (RN-016): escondida de pessoas e de leitores de tela --}}
        <div class="absolute -left-[9999px] h-px w-px overflow-hidden" aria-hidden="true">
            <label for="lead-site">Não preencha este campo</label>
            <input id="lead-site" name="site" type="text" tabindex="-1" autocomplete="off">
        </div>

        <div>
            <div class="flex items-start gap-3">
                {{-- RN-011: o aceite nunca vem marcado --}}
                <input id="lead-aceite" name="aceite" type="checkbox" value="1" required data-erro="Para enviar, aceite a Política de Privacidade."
                       class="mt-1 size-5 shrink-0 accent-preto" :aria-invalid="erros.aceite ? 'true' : null" aria-describedby="erro-aceite"
                       @change="limparSeValido($event.target); avisarSeInvalido($event.target)">
                <label for="lead-aceite" class="text-sm text-texto-suave">
                    Li e aceito a
                    @if (Route::has('privacidade'))
                        <a href="{{ route('privacidade') }}" target="_blank" class="rounded font-semibold text-preto underline">Política de Privacidade</a>
                    @else
                        Política de Privacidade
                    @endif
                    e autorizo o contato da B2BSAFE. <span aria-hidden="true">*</span>
                </label>
            </div>
            <x-formulario-lead.erro campo="aceite" />
        </div>

        <button type="submit" :disabled="enviando" :aria-busy="enviando ? 'true' : 'false'"
                class="inline-flex w-full items-center justify-center gap-2 rounded bg-preto px-6 py-3 font-semibold text-white transition-colors hover:bg-preto-hover disabled:cursor-wait disabled:opacity-70 sm:w-auto">
            <i x-show="enviando" data-lucide="loader-circle" class="size-4 animate-spin" aria-hidden="true"></i>
            <span x-text="enviando ? 'Enviando…' : 'Enviar'">Enviar</span>
        </button>
        <p id="legenda-obrigatorios" class="text-sm text-texto-suave">* Campos obrigatórios.</p>
    </form>
</div>
