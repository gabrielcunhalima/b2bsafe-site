{{--
    Botão de WhatsApp com mensagem pronta (RN-021). Os atributos data-* identificam a página e o serviço
    para o registro do clique (RN-010, #11). Uso: <x-botao-whatsapp :href="$link" pagina="home" servico="credito">Texto</x-botao-whatsapp>
--}}
@props(['href', 'pagina' => 'home', 'servico' => null])

<a href="{{ $href }}" target="_blank" rel="noopener noreferrer"
   data-whatsapp="{{ $pagina }}" @if ($servico) data-servico="{{ $servico }}" @endif
   {{ $attributes->merge(['class' => 'inline-flex items-center justify-center gap-2 rounded bg-whatsapp px-6 py-3 font-semibold text-white transition-colors hover:bg-[#054a42]']) }}>
    <x-icone-marca nome="whatsapp" class="size-5" />
    {{ $slot }}
    <span class="sr-only">(abre o WhatsApp em nova aba)</span>
</a>
