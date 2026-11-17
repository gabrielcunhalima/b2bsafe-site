<?php

it('abre a página inicial sem erros de JavaScript', function () {
    visit('/')
        ->assertSee('Crédito: menores taxas, sem burocracia.')
        ->assertNoSmoke();
});

it('abre a tela de login do painel sem erros de JavaScript', function () {
    visit('/painel/login')
        ->assertSee('B2BSAFE')
        ->assertNoSmoke();
});
