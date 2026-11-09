<?php

namespace Database\Factories;

use App\Models\Conversa;
use App\Models\Origem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Conversa>
 */
class ConversaFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'origem_id' => Origem::factory(),
            'pagina_inicial' => '/',
            'transbordo' => false,
            'ultima_mensagem_em' => now(),
        ];
    }
}
