<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

/**
 * Por onde o lead deixou os dados (RN-010).
 */
enum CanalCaptacao: string implements HasLabel
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
