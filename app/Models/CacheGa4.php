<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

/**
 * Relatório do GA4 em cache, atualizado de hora em hora pelo agendador (RF-022).
 */
#[Table('cache_ga4', timestamps: false)]
#[Fillable(['relatorio', 'periodo', 'dados', 'atualizado_em'])]
class CacheGa4 extends Model
{
    protected function casts(): array
    {
        return [
            'dados' => 'array',
            'atualizado_em' => 'datetime',
        ];
    }
}
