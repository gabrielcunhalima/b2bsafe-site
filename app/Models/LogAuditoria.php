<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Ação sensível registrada para o administrador (RF-030). O IP é apagado depois de 30 dias.
 */
#[Table('log_auditoria')]
#[Fillable(['usuario_id', 'acao', 'entidade', 'entidade_id', 'detalhes', 'ip'])]
class LogAuditoria extends Model
{
    public const UPDATED_AT = null;

    protected function casts(): array
    {
        return [
            'detalhes' => 'array',
        ];
    }

    /** @return BelongsTo<Usuario, $this> */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class);
    }
}
