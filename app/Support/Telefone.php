<?php

namespace App\Support;

/**
 * Formata números de telefone brasileiros guardados só com dígitos e DDI (ex.: 5511984205023).
 */
final class Telefone
{
    /** DDDs válidos no Brasil (Anatel). */
    public const DDDS = [
        11, 12, 13, 14, 15, 16, 17, 18, 19, 21, 22, 24, 27, 28, 31, 32, 33, 34, 35, 37, 38,
        41, 42, 43, 44, 45, 46, 47, 48, 49, 51, 53, 54, 55, 61, 62, 63, 64, 65, 66, 67, 68, 69,
        71, 73, 74, 75, 77, 79, 81, 82, 83, 84, 85, 86, 87, 88, 89,
        91, 92, 93, 94, 95, 96, 97, 98, 99,
    ];

    /**
     * Normaliza para E.164 (+55DDDNUMERO) um telefone brasileiro com DDD válido e 8 ou 9 dígitos;
     * com 9 dígitos, precisa começar por 9 (RN-002). Devolve null quando não é válido.
     */
    public static function normalizar(string $numero): ?string
    {
        $digitos = preg_replace('/\D/', '', $numero) ?? '';

        if (str_starts_with($digitos, '55') && in_array(strlen($digitos), [12, 13], true)) {
            $digitos = substr($digitos, 2);
        }

        if (! in_array(strlen($digitos), [10, 11], true) || ! in_array((int) substr($digitos, 0, 2), self::DDDS, true)) {
            return null;
        }

        $local = substr($digitos, 2);

        if (strlen($local) === 9 && $local[0] !== '9') {
            return null;
        }

        if (strlen($local) === 8 && in_array($local[0], ['0', '1'], true)) {
            return null;
        }

        return '+55'.$digitos;
    }

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
