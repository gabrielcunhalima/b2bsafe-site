<?php

namespace App\Support;

/**
 * Formata números de telefone brasileiros guardados só com dígitos e DDI (ex.: 5511984205023).
 */
final class Telefone
{
    /** "(11) 98420-5023" (celular), "(11) 3003-6116" (fixo) e "0800 660 0060"; outro formato volta como veio. */
    public static function formatar(string $numero): string
    {
        $digitos = preg_replace('/\D/', '', $numero) ?? '';

        if (str_starts_with($digitos, '55') && in_array(strlen($digitos), [12, 13], true)) {
            $digitos = substr($digitos, 2);
        }

        if (str_starts_with($digitos, '0800') && strlen($digitos) === 11) {
            return sprintf('%s %s %s', substr($digitos, 0, 4), substr($digitos, 4, 3), substr($digitos, 7));
        }

        return match (strlen($digitos)) {
            11 => sprintf('(%s) %s-%s', substr($digitos, 0, 2), substr($digitos, 2, 5), substr($digitos, 7)),
            10 => sprintf('(%s) %s-%s', substr($digitos, 0, 2), substr($digitos, 2, 4), substr($digitos, 6)),
            default => $numero,
        };
    }
}
