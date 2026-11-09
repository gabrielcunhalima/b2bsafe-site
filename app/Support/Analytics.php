<?php

namespace App\Support;

/**
 * Google Analytics 4 (RF-010): o ID de medição vem da configuração e fica desligado nos ambientes
 * local e de teste. O script do Google só carrega depois do consentimento estatístico (Consent Mode
 * básico): sem aceite, nenhuma requisição ao Google e nenhum cookie _ga.
 */
final class Analytics
{
    public static function idAtivo(): ?string
    {
        $id = config('b2bsafe.ga4_id');

        if (! is_string($id) || $id === '' || app()->environment(['local', 'testing'])) {
            return null;
        }

        return $id;
    }
}
