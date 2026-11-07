<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

/**
 * Perfil de acesso à área restrita (RN-017).
 */
enum PerfilUsuario: string implements HasLabel
{
    case Administrador = 'administrador';
    case Atendente = 'atendente';

    public function getLabel(): string
    {
        return match ($this) {
            self::Administrador => 'Administrador',
            self::Atendente => 'Atendente',
        };
    }
}
