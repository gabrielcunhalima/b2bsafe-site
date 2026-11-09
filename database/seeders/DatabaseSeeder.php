<?php

namespace Database\Seeders;

use App\Enums\StatusLead;
use App\Models\Lead;
use App\Models\Origem;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * Dados de exemplo para desenvolvimento local. Nunca rodar em produção.
 */
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Usuario::factory()->administrador()->create([
            'nome' => 'Administrador Local',
            'email' => 'admin@b2bsafe.test',
            'senha' => 'senha-local-123',
        ]);

        Usuario::factory()->create([
            'nome' => 'Atendente Local',
            'email' => 'atendente@b2bsafe.test',
            'senha' => 'senha-local-123',
        ]);

        foreach (StatusLead::cases() as $status) {
            Lead::factory()->count(3)->comStatus($status)->create();
        }

        Lead::factory()->count(4)->for(Origem::factory()->googleAds())->create();
        Lead::factory()->count(4)->for(Origem::factory()->campanha())->create();
    }
}
