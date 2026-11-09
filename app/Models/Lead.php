<?php

namespace App\Models;

use App\Enums\CanalCaptacao;
use App\Enums\MotivoPerda;
use App\Enums\StatusLead;
use Database\Factories\LeadFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Contato captado pelo formulário ou pelo assistente virtual (RF-006, RF-015).
 * As regras (deduplicação, transições de status) ficam em Actions, não aqui.
 */
#[Fillable([
    'nome', 'whatsapp', 'email', 'servico', 'mensagem', 'canal_captacao', 'status',
    'motivo_perda', 'motivo_perda_detalhe', 'primeiro_contato_em', 'ultima_interacao_em',
    'voltou_contato_em', 'lead_anterior_id', 'origem_id', 'consentimento_id', 'anonimizado_em',
])]
class Lead extends Model
{
    /** @use HasFactory<LeadFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'canal_captacao' => CanalCaptacao::class,
            'status' => StatusLead::class,
            'motivo_perda' => MotivoPerda::class,
            'primeiro_contato_em' => 'datetime',
            'ultima_interacao_em' => 'datetime',
            'voltou_contato_em' => 'datetime',
            'anonimizado_em' => 'datetime',
        ];
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

    /** @return BelongsTo<Lead, $this> */
    public function leadAnterior(): BelongsTo
    {
        return $this->belongsTo(Lead::class, 'lead_anterior_id');
    }

    /** @return HasMany<InteracaoLead, $this> */
    public function interacoes(): HasMany
    {
        return $this->hasMany(InteracaoLead::class);
    }

    /** @return HasMany<HistoricoStatus, $this> */
    public function historicoStatus(): HasMany
    {
        return $this->hasMany(HistoricoStatus::class);
    }

    /** @return HasMany<Anotacao, $this> */
    public function anotacoes(): HasMany
    {
        return $this->hasMany(Anotacao::class);
    }

    /** @return HasMany<Conversa, $this> */
    public function conversas(): HasMany
    {
        return $this->hasMany(Conversa::class);
    }

    /** @return HasMany<CliqueWhatsapp, $this> */
    public function cliquesWhatsapp(): HasMany
    {
        return $this->hasMany(CliqueWhatsapp::class);
    }

    public function estaAnonimizado(): bool
    {
        return $this->anonimizado_em !== null;
    }
}
