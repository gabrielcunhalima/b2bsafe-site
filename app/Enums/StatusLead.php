<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

/**
 * Etapas do funil do lead (RN-004).
 */
enum StatusLead: string implements HasLabel
{
    case Novo = 'novo';
    case EmContato = 'em_contato';
    case Proposta = 'proposta';
    case Convertido = 'convertido';
    case Perdido = 'perdido';

    public function getLabel(): string
    {
        return match ($this) {
            self::Novo => 'Novo',
            self::EmContato => 'Em contato',
            self::Proposta => 'Proposta',
            self::Convertido => 'Convertido',
            self::Perdido => 'Perdido',
        };
    }

    /**
     * Status em que o lead ainda está em tratamento: um novo contato vira interação (RN-003).
     *
     * @return list<self>
     */
    public static function abertos(): array
    {
        return [self::Novo, self::EmContato, self::Proposta];
    }
}
