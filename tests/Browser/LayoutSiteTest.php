<?php

// US-001 (#1): menu móvel acessível e layout sem rolagem horizontal (RF-001, T-10).

it('abre o menu no celular, fecha com Esc e devolve o foco ao botão', function () {
    visit('/')
        ->resize(360, 740)
        ->assertMissing('#menu-movel')
        ->click('[aria-controls="menu-movel"]')
        ->assertVisible('#menu-movel')
        ->assertAttribute('[aria-controls="menu-movel"]', 'aria-expanded', 'true')
        ->keys('#menu-movel', 'Escape')
        ->assertMissing('#menu-movel')
        ->assertScript('document.activeElement.getAttribute("aria-controls")', 'menu-movel')
        ->assertNoSmoke();
});

it('fecha o menu no celular pelo botão Fechar', function () {
    visit('/')
        ->resize(360, 740)
        ->click('[aria-controls="menu-movel"]')
        ->click('#menu-movel button')
        ->assertMissing('#menu-movel');
});

it('não tem rolagem horizontal de 360 px a 1920 px', function (int $largura) {
    visit('/')
        ->resize($largura, 900)
        ->assertScript('document.documentElement.scrollWidth <= window.innerWidth', true);
})->with([360, 768, 1024, 1440, 1920]);

it('deixa como primeiro item focável o link "Pular para o conteúdo"', function () {
    visit('/')
        ->assertScript(
            '[...document.querySelectorAll("a[href], button, input, select, textarea")].find((e) => e.tabIndex >= 0).textContent.trim()',
            'Pular para o conteúdo',
        );
});

it('abre o menu do celular cobrindo a tela inteira', function () {
    visit('/')
        ->resize(360, 740)
        ->click('[aria-controls="menu-movel"]')
        ->assertScript('document.getElementById("menu-movel").getBoundingClientRect().height', 740);
});
