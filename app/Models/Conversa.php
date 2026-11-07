<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Sessão de chat com o assistente virtual. O id (UUID) é o identificador usado pelo widget (RF-013, RF-017).
 */
#[Fillable(['lead_id', 'origem_id', 'consentimento_id', 'pagina_inicial', 'transbordo', 'ultima_mensagem_em', 'anonimizado_em'])]
class Conversa extends Model
{
    use HasUuids;

    protected function casts(): array
    {
        return [
            'transbordo' => 'boolean',
            'ultima_mensagem_em' => 'datetime',
            'anonimizado_em' => 'datetime',
        ];
    }

    /** @return BelongsTo<Lead, $this> */
    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    /** @return BelongsTo<Origem, $this> */
    public function origem(): BelongsTo
    {
        return $this->belongsTo(Origem::class);
    }

    /** @return BelongsTo<Consentimento, $this> */
    public function consentimento(): BelongsTo
    {
        return $this->belongsTo(Consentimento::class);
    }

    /** @return HasMany<Mensagem, $this> */
    public function mensagens(): HasMany
    {
        return $this->hasMany(Mensagem::class);
    }
}
