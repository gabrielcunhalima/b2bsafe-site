<?php

namespace App\Actions;

use App\Enums\TipoConsentimento;
use App\Models\Consentimento;

/**
 * Registra a escolha de cookies do visitante com a data, a versão da política de cookies e as
 * categorias aceitas (RN-011). Os necessários são sempre ativos.
 */
class RegistrarPreferenciasCookies
{
    public function executar(string $visitanteId, bool $estatisticos): Consentimento
    {
        return Consentimento::create([
            'visitante_id' => $visitanteId,
            'tipo' => TipoConsentimento::Cookies,
            'versao_documento' => (string) config('b2bsafe.versoes.cookies'),
            'categorias' => $estatisticos ? ['necessarios', 'estatisticos'] : ['necessarios'],
        ]);
    }
}
