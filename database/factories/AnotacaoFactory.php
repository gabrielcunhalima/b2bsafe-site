<?php

namespace Database\Factories;

use App\Models\Anotacao;
use App\Models\Lead;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Anotacao>
 */
class AnotacaoFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lead_id' => Lead::factory(),
            'usuario_id' => Usuario::factory(),
            'texto' => fake()->sentence(),
        ];
    }
}
