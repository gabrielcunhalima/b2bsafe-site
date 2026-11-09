{{-- Mensagem de erro de um campo: ícone + texto, não só a cor (WCAG 1.4.1) --}}
@props(['campo'])

<p id="erro-{{ $campo }}" class="mt-1 flex items-start gap-1.5 text-sm font-semibold text-erro"
   @error($campo) @else x-cloak @enderror x-show="erros.{{ $campo }} || {{ $errors->has($campo) ? 'true' : 'false' }} && !tocado.{{ $campo }}">
    <i data-lucide="triangle-alert" class="mt-0.5 size-4 shrink-0" aria-hidden="true"></i>
    <span x-text="erros.{{ $campo }} || @js($errors->first($campo))">{{ $errors->first($campo) }}</span>
</p>
