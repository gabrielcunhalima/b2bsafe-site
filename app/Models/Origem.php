<?php

namespace App\Models;

use Database\Factories\OrigemFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Primeiro toque da visita, com o canal já classificado (RF-008, RN-008, RN-009).
 */
#[Table('origens')]
#[Fillable([
    'canal', 'utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content',
    'gclid', 'fbclid', 'referrer', 'pagina_entrada', 'primeiro_acesso_em',
])]
class Origem extends Model
{
    /** @use HasFactory<OrigemFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'primeiro_acesso_em' => 'datetime',
        ];
    }

    /** @return HasMany<Lead, $this> */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
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
}
