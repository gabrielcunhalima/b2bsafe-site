<?php

namespace App\Models;

use App\Enums\StatusLead;
use Database\Factories\HistoricoStatusFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Registro de cada mudança de status do lead, com autor e data (RN-004).
 */
#[Table('historico_status')]
#[Fillable(['lead_id', 'usuario_id', 'status_anterior', 'status_novo'])]
class HistoricoStatus extends Model
{
    /** @use HasFactory<HistoricoStatusFactory> */
    use HasFactory;

    public const UPDATED_AT = null;

    protected function casts(): array
    {
        return [
            'status_anterior' => StatusLead::class,
            'status_novo' => StatusLead::class,
        ];
    }

    /** @return BelongsTo<Lead, $this> */
    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    /** @return BelongsTo<Usuario, $this> */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class);
    }
}
