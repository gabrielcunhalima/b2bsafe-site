<?php

use App\Enums\CanalCaptacao;
use App\Enums\MotivoPerda;
use App\Enums\PapelMensagem;
use App\Enums\PerfilUsuario;
use App\Enums\StatusLead;
use App\Enums\TipoConsentimento;
use App\Enums\TipoInteracao;

dataset('enums', [
    PerfilUsuario::class, StatusLead::class, MotivoPerda::class, CanalCaptacao::class,
    TipoConsentimento::class, TipoInteracao::class, PapelMensagem::class,
]);

it('tem rótulo em português e valor em snake_case para todo caso', function (string $enum) {
    foreach ($enum::cases() as $caso) {
        expect($caso->getLabel())->not->toBeEmpty()
            ->and($caso->value)->toMatch('/^[a-z]+(_[a-z]+)*$/');
    }
})->with('enums');

it('tem as cinco etapas do funil na ordem do RN-004', function () {
    expect(array_map(fn (StatusLead $s) => $s->value, StatusLead::cases()))
        ->toBe(['novo', 'em_contato', 'proposta', 'convertido', 'perdido']);
});
