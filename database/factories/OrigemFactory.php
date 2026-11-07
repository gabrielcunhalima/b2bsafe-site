<?php

namespace Database\Factories;

use App\Models\Origem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Origem>
 */
class OrigemFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'canal' => 'Direto',
            'pagina_entrada' => '/',
            'primeiro_acesso_em' => now(),
        ];
    }

    public function campanha(string $source = 'instagram', string $medium = 'bio', string $campanha = 'teste'): static
    {
        return $this->state(fn (): array => [
            'canal' => "Campanha ({$source} / {$medium})",
            'utm_source' => $source,
            'utm_medium' => $medium,
            'utm_campaign' => $campanha,
        ]);
    }

    public function googleAds(): static
    {
        return $this->state(fn (): array => [
            'canal' => 'Google Ads',
            'utm_source' => 'google',
            'utm_medium' => 'cpc',
            'gclid' => 'Cj0KCQ'.fake()->bothify('????##########'),
        ]);
    }
}
