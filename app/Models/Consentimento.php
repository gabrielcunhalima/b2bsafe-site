<?php

namespace App\Models;

use App\Enums\TipoConsentimento;
use Database\Factories\ConsentimentoFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Evidência de um aceite (política no formulário ou no chat, cookies), sem IP (RN-011).
 */
#[Fillable(['visitante_id', 'tipo', 'versao_documento', 'categorias'])]
class Consentimento extends Model
{
    /** @use HasFactory<ConsentimentoFactory> */
    use HasFactory;

    public const UPDATED_AT = null;

    protected function casts(): array
    {
        return [
            'tipo' => TipoConsentimento::class,
            'categorias' => 'array',
        ];
    }
}
