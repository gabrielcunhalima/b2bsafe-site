<?php

use App\Models\Consentimento;

// US-012 (#12): banner de cookies no navegador (wireframe T-06).

it('recusa pelo banner, esconde a faixa e avisa que salvou', function () {
    visit('/')
        ->assertSee('Cookies neste site')
        ->click('section[aria-labelledby="cookies-faixa-titulo"] button:nth-of-type(2)')
        ->assertSee('Preferências salvas')
        ->wait(0.3)
        ->assertMissing('section[aria-labelledby="cookies-faixa-titulo"]');

    expect(Consentimento::sole()->categorias)->toBe(['necessarios']);
});

it('personaliza aceitando os estatísticos e reabre pelo rodapé com a escolha atual', function () {
    visit('/')
        ->click('Personalizar')
        ->assertVisible('[aria-labelledby="cookies-dialogo-titulo"]')
        ->assertNotChecked('#cookies-estatisticos')
        ->check('#cookies-estatisticos')
        ->click('Salvar escolhas')
        ->wait(0.3)
        ->assertMissing('[aria-labelledby="cookies-dialogo-titulo"]')
        ->click('#rodape-preferencias-cookies')
        ->assertVisible('[aria-labelledby="cookies-dialogo-titulo"]')
        ->assertChecked('#cookies-estatisticos');

    expect(Consentimento::sole()->categorias)->toBe(['necessarios', 'estatisticos']);
});

it('fecha o diálogo com Esc', function () {
    visit('/')
        ->click('Personalizar')
        ->keys('#cookies-estatisticos', 'Escape')
        ->wait(0.3)
        ->assertMissing('[aria-labelledby="cookies-dialogo-titulo"]');
});
