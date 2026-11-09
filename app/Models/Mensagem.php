<?php

namespace App\Models;

use App\Enums\PapelMensagem;
use Database\Factories\MensagemFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Mensagem do visitante ou do assistente, já com dados sensíveis mascarados (RF-017, RN-013).
 */
#[Table('mensagens')]
#[Fillable(['conversa_id', 'papel', 'conteudo', 'topico', 'sem_resposta', 'resolvida_em', 'diagnostico'])]
class Mensagem extends Model
{
    /** @use HasFactory<MensagemFactory> */
    use HasFactory;

    public const UPDATED_AT = null;

    protected function casts(): array
    {
        return [
            'papel' => PapelMensagem::class,
            'sem_resposta' => 'boolean',
            'resolvida_em' => 'datetime',
        ];
    }

    /** @return BelongsTo<Conversa, $this> */
    public function conversa(): BelongsTo
    {
        return $this->belongsTo(Conversa::class);
    }
}
