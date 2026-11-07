<?php

it('responde ok quando aplicação, banco e fila estão saudáveis', function () {
    $this->getJson(route('saude'))
        ->assertOk()
        ->assertJsonPath('status', 'ok')
        ->assertJsonPath('verificacoes.banco.ok', true)
        ->assertJsonPath('verificacoes.fila.ok', true)
        ->assertJsonPath('verificacoes.fila.falhas', 0);
});

it('mostra a página inicial fora dos buscadores fora da produção', function () {
    $this->get(route('inicio'))
        ->assertOk()
        ->assertSee('Sua empresa em boas mãos.')
        ->assertSee('noindex', escape: false);
});

it('mostra a página 404 amigável', function () {
    $this->get('/pagina-que-nao-existe')
        ->assertNotFound()
        ->assertSee('Não encontramos esta página.');
});
