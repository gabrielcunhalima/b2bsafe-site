<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

/**
 * Origem de cada contato registrado na ficha do lead (RN-003).
 */
enum TipoInteracao: string implements HasLabel
{
    case Formulario = 'formulario';
    case Chatbot = 'chatbot';

    public function getLabel(): string
    {
        return match ($this) {
            self::Formulario => 'Formulário',
            self::Chatbot => 'Chatbot',
        };
    }
}
