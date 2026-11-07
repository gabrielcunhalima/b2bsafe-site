<?php

namespace Database\Factories;

use App\Enums\PerfilUsuario;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Hash calculado uma vez só, para os testes ficarem rápidos.
     */
    protected static ?string $senha;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'senha' => static::$senha ??= Hash::make('senha-de-teste-123'),
            'perfil' => PerfilUsuario::Atendente,
            'ativo' => true,
            'recebe_resumo_semanal' => true,
            'remember_token' => Str::random(10),
        ];
    }

    public function administrador(): static
    {
        return $this->state(fn (): array => ['perfil' => PerfilUsuario::Administrador]);
    }

    public function inativo(): static
    {
        return $this->state(fn (): array => ['ativo' => false]);
    }
}
