<?php

namespace App\Models;

use Database\Factories\CliqueWhatsappFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Clique num botão de WhatsApp ou transbordo do chat. Não é lead (RN-010).
 */
#[Table('cliques_whatsapp')]
#[Fillable(['numero', 'pagina', 'servico', 'origem_id', 'conversa_id', 'lead_id'])]
class CliqueWhatsapp extends Model
{
    /** @use HasFactory<CliqueWhatsappFactory> */
    use HasFactory;

    public const UPDATED_AT = null;

    /** @return BelongsTo<Origem, $this> */
    public function origem(): BelongsTo
    {
        return $this->belongsTo(Origem::class);
    }

    /** @return BelongsTo<Conversa, $this> */
    public function conversa(): BelongsTo
    {
        return $this->belongsTo(Conversa::class);
    }

    /** @return BelongsTo<Lead, $this> */
    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }
}
