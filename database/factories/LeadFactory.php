<?php

namespace Database\Factories;

use App\Enums\CanalCaptacao;
use App\Enums\MotivoPerda;
use App\Enums\StatusLead;
use App\Models\Lead;
use App\Models\Origem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lead>
 */
class LeadFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'whatsapp' => '+55'.fake()->randomElement(['11', '21', '47', '48']).'9'.fake()->numerify('########'),
            'email' => fake()->unique()->safeEmail(),
            'servico' => fake()->randomElement(array_keys(config('b2bsafe.servicos'))),
            'mensagem' => fake()->optional()->sentence(),
            'canal_captacao' => fake()->randomElement(CanalCaptacao::cases()),
            'status' => StatusLead::Novo,
            'origem_id' => Origem::factory(),
            'ultima_interacao_em' => now(),
        ];
    }

    public function comStatus(StatusLead $status): static
    {
        return $this->state(fn (): array => [
            'status' => $status,
            'primeiro_contato_em' => $status === StatusLead::Novo ? null : now(),
            'motivo_perda' => $status === StatusLead::Perdido ? MotivoPerda::SemRetorno : null,
        ]);
    }
}
