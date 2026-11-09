<?php

namespace App\Support;

use Illuminate\Http\Request;

/**
 * Preferências de cookies do visitante, gravadas pelo banner (RF-009) no cookie "b2b_cookies"
 * (criptografado pelo Laravel). Só valem na versão atual da política de cookies (RN-011).
 */
final class PreferenciasCookies
{
    public const COOKIE = 'b2b_cookies';

    /** Validade da escolha: 12 meses, em minutos. */
    public const VALIDADE_MINUTOS = 60 * 24 * 365;

    /** @return array{versao: string, estatisticos: bool}|null */
    public static function doRequest(Request $request): ?array
    {
        $bruto = $request->cookie(self::COOKIE);
        $dados = is_string($bruto) ? json_decode($bruto, true) : null;

        if (! is_array($dados) || ($dados['versao'] ?? null) !== (string) config('b2bsafe.versoes.cookies')) {
            return null;
        }

        return ['versao' => (string) $dados['versao'], 'estatisticos' => (bool) ($dados['estatisticos'] ?? false)];
    }

    public static function aceitouEstatisticos(Request $request): bool
    {
        return self::doRequest($request)['estatisticos'] ?? false;
    }
}
