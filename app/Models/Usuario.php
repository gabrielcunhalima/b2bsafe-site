<?php

namespace App\Models;

use App\Enums\PerfilUsuario;
use Database\Factories\UsuarioFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * Usuário da área restrita: administrador ou atendente (RF-018, RF-019, RN-017).
 *
 * @property int $id
 * @property string $nome
 * @property string $email
 * @property string $senha
 * @property PerfilUsuario $perfil
 * @property bool $ativo
 * @property bool $recebe_resumo_semanal
 * @property Carbon|null $ultimo_acesso_em
 */
#[Table('usuarios')]
#[Fillable(['nome', 'email', 'senha', 'password', 'perfil', 'ativo', 'recebe_resumo_semanal'])]
#[Hidden(['senha', 'remember_token'])]
class Usuario extends Authenticatable implements FilamentUser, HasName
{
    /** @use HasFactory<UsuarioFactory> */
    use HasFactory, Notifiable;

    /** Coluna da senha (o Laravel usa "password" por padrão). */
    protected $authPasswordName = 'senha';

    protected function casts(): array
    {
        return [
            'senha' => 'hashed',
            'perfil' => PerfilUsuario::class,
            'ativo' => 'boolean',
            'recebe_resumo_semanal' => 'boolean',
            'ultimo_acesso_em' => 'datetime',
        ];
    }

    /**
     * Telas do Filament (perfil, redefinição) gravam o campo "password": redireciona para "senha".
     *
     * @return Attribute<null, string>
     */
    protected function password(): Attribute
    {
        return Attribute::make(set: fn (string $valor): array => ['senha' => $valor]);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->ativo;
    }

    public function getFilamentName(): string
    {
        return $this->nome;
    }

    public function ehAdministrador(): bool
    {
        return $this->perfil === PerfilUsuario::Administrador;
    }

    /** @return HasMany<Anotacao, $this> */
    public function anotacoes(): HasMany
    {
        return $this->hasMany(Anotacao::class);
    }

    /** @return HasMany<HistoricoStatus, $this> */
    public function historicoStatus(): HasMany
    {
        return $this->hasMany(HistoricoStatus::class);
    }
}
