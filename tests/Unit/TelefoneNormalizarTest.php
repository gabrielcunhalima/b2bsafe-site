<?php

use App\Support\Telefone;

// RN-002: telefone brasileiro válido, gravado em E.164.

it('normaliza celular com máscara para E.164 (RN-002)', function () {
    expect(Telefone::normalizar('(48) 99999-1234'))->toBe('+5548999991234');
});

it('aceita número já com DDI e telefone fixo de 8 dígitos (RN-002)', function () {
    expect(Telefone::normalizar('+55 11 98420-5023'))->toBe('+5511984205023')
        ->and(Telefone::normalizar('(48) 3333-4444'))->toBe('+554833334444');
});

it('recusa DDD inexistente, número curto e celular de 9 dígitos sem o 9 inicial (RN-002)', function (string $numero) {
    expect(Telefone::normalizar($numero))->toBeNull();
})->with([
    'DDD 20' => '(20) 99999-1234',
    'curto' => '99999-12',
    'celular sem 9' => '(48) 89999-1234',
    'fixo iniciando em 1' => '(48) 1333-4444',
    'estrangeiro' => '+1 415 555 0100',
]);
