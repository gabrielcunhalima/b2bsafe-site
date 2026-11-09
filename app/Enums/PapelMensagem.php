<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

/**
 * Autor de uma mensagem do chat.
 */
enum PapelMensagem: string implements HasLabel
{
    case Visitante = 'visitante';
    case Assistente = 'assistente';

    public function getLabel(): string
    {
        return match ($this) {
            self::Visitante => 'Visitante',
            self::Assistente => 'Assistente',
        };
    }
}
