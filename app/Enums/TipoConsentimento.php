<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

/**
 * Documento aceito pelo visitante (RN-011).
 */
enum TipoConsentimento: string implements HasLabel
{
    case PoliticaFormulario = 'politica_formulario';
    case PoliticaChat = 'politica_chat';
    case Cookies = 'cookies';

    public function getLabel(): string
    {
        return match ($this) {
            self::PoliticaFormulario => 'Política de Privacidade (formulário)',
            self::PoliticaChat => 'Aviso do assistente virtual',
            self::Cookies => 'Preferências de cookies',
        };
    }
}
