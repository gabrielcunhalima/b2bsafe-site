<?php

namespace Database\Factories;

use App\Models\CliqueWhatsapp;
use App\Models\Origem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CliqueWhatsapp>
 */
class CliqueWhatsappFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero' => config('b2bsafe.whatsapp.geral'),
            'pagina' => '/',
            'servico' => null,
            'origem_id' => Origem::factory(),
        ];
    }
}
