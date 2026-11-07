<?php

namespace App\Models;

use App\Enums\TipoInteracao;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Cada contato recebido de um lead, inclusive os repetidos (RN-003).
 */
#[Table('interacoes_lead')]
#[Fillable(['lead_id', 'tipo', 'conteudo'])]
class InteracaoLead extends Model
{
    public const UPDATED_AT = null;

    protected function casts(): array
    {
        return [
            'tipo' => TipoInteracao::class,
        ];
    }

    /** @return BelongsTo<Lead, $this> */
    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }
}
