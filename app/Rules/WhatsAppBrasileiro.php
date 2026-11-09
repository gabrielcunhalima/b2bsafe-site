<?php

namespace App\Rules;

use App\Support\Telefone;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/** Telefone brasileiro com DDD válido e 8 ou 9 dígitos (RN-002). */
class WhatsAppBrasileiro implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || Telefone::normalizar($value) === null) {
            $fail('Informe um celular com DDD, por exemplo (48) 99999-1234.');
        }
    }
}
