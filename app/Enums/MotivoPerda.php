<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

/**
 * Motivo obrigatório ao mover um lead para Perdido (RN-006).
 */
enum MotivoPerda: string implements HasLabel
{
    case SemInteresse = 'sem_interesse';
    case SemRetorno = 'sem_retorno';
    case NaoAprovado = 'nao_aprovado';
    case OutraInstituicao = 'outra_instituicao';
    case DuplicadoSpam = 'duplicado_spam';
    case Outro = 'outro';

    public function getLabel(): string
    {
        return match ($this) {
            self::SemInteresse => 'Sem interesse',
            self::SemRetorno => 'Sem retorno',
            self::NaoAprovado => 'Não aprovado / não atende requisitos',
            self::OutraInstituicao => 'Escolheu outra instituição',
            self::DuplicadoSpam => 'Duplicado/spam',
            self::Outro => 'Outro',
        };
    }
}
