<?php

namespace Database\Factories;

use App\Enums\PapelMensagem;
use App\Models\Conversa;
use App\Models\Mensagem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Mensagem>
 */
class MensagemFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'conversa_id' => Conversa::factory(),
            'papel' => PapelMensagem::Visitante,
            'conteudo' => fake()->sentence(),
            'sem_resposta' => false,
        ];
    }
}
