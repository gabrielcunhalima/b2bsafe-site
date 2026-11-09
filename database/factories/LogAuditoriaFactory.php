<?php

namespace Database\Factories;

use App\Models\LogAuditoria;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LogAuditoria>
 */
class LogAuditoriaFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'usuario_id' => Usuario::factory()->administrador(),
            'acao' => 'exportacao_csv',
            'entidade' => 'leads',
            'detalhes' => ['quantidade' => fake()->numberBetween(1, 50)],
            'ip' => fake()->ipv4(),
        ];
    }
}
