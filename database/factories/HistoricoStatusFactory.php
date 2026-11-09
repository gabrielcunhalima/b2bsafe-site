<?php

namespace Database\Factories;

use App\Enums\StatusLead;
use App\Models\HistoricoStatus;
use App\Models\Lead;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HistoricoStatus>
 */
class HistoricoStatusFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lead_id' => Lead::factory(),
            'usuario_id' => Usuario::factory(),
            'status_anterior' => StatusLead::Novo,
            'status_novo' => StatusLead::EmContato,
        ];
    }
}
