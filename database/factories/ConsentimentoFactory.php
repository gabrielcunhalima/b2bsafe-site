<?php

namespace Database\Factories;

use App\Enums\TipoConsentimento;
use App\Models\Consentimento;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Consentimento>
 */
class ConsentimentoFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'visitante_id' => (string) Str::uuid(),
            'tipo' => TipoConsentimento::PoliticaFormulario,
            'versao_documento' => '1',
            'categorias' => null,
        ];
    }
}
