<?php

namespace Database\Factories;

use App\Enums\TipoInteracao;
use App\Models\InteracaoLead;
use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InteracaoLead>
 */
class InteracaoLeadFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lead_id' => Lead::factory(),
            'tipo' => TipoInteracao::Formulario,
            'conteudo' => fake()->sentence(),
        ];
    }
}
