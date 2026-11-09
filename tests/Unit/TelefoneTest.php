<?php

use App\Support\Telefone;

it('formata celular com DDI', function () {
    expect(Telefone::formatar('5511984205023'))->toBe('(11) 98420-5023');
});

it('formata telefone fixo com DDI', function () {
    expect(Telefone::formatar('554830036116'))->toBe('(48) 3003-6116');
});

it('formata número sem DDI e ignora caracteres que não são dígitos', function () {
    expect(Telefone::formatar('(11) 92460-0991'))->toBe('(11) 92460-0991')
        ->and(Telefone::formatar('11924600991'))->toBe('(11) 92460-0991');
});

it('formata 0800', function () {
    expect(Telefone::formatar('08006600060'))->toBe('0800 660 0060');
});

it('devolve como veio o número em formato desconhecido', function () {
    expect(Telefone::formatar('123'))->toBe('123')
        ->and(Telefone::formatar('30036116'))->toBe('30036116');
});
