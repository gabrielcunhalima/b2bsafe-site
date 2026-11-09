<?php

// US-001 (#1): cabeçalho, rodapé e navegação do site público (RF-001, RN-015, T-10).

it('mostra o menu com âncoras para as seções da Home e o botão Fale conosco', function () {
    $resposta = $this->get(route('inicio'))->assertOk();

    foreach (['servicos', 'maquininha', 'sobre', 'parcerias', 'credenciamento', 'contato'] as $secao) {
        $resposta->assertSee('href="#'.$secao.'"', escape: false);
    }

    $resposta->assertSeeInOrder(['Serviços', 'Maquininha', 'Sobre', 'Parcerias', 'Credenciamento', 'Fale conosco'])
        ->assertSee('aria-controls="menu-movel"', escape: false);
});

it('coloca "Pular para o conteúdo" antes do cabeçalho', function () {
    $this->get(route('inicio'))
        ->assertSeeInOrder(['Pular para o conteúdo', '<header', 'id="conteudo"'], escape: false);
});

it('mostra no rodapé as duas empresas com CNPJ e endereço', function () {
    $this->get(route('inicio'))
        ->assertSee('B2BSAFE Floripa Ltda')
        ->assertSee('58.358.780/0001-26')
        ->assertSee('Av. Marechal Castelo Branco, 65')
        ->assertSee('B2BSafe Consulting Partners Ltda')
        ->assertSee('41.708.313/0001-86')
        ->assertSee('Rua Peruíbe, 397');
});

it('mostra no rodapé o contato e só as redes sociais atuais, sem Connect Partners', function () {
    $this->get(route('inicio'))
        ->assertSee('mailto:contato@b2bsafe.com.br', escape: false)
        ->assertSee('https://wa.me/5511984205023', escape: false)
        ->assertSee('(11) 98420-5023')
        ->assertSee('https://www.linkedin.com/company/b2bsafe-consulting/', escape: false)
        ->assertSee('https://www.instagram.com/b2b_bancos/', escape: false)
        ->assertSee('https://www.facebook.com/b2bsafe/', escape: false)
        ->assertDontSee('Connect Partners')
        ->assertDontSee('connect-partners', escape: false);
});

it('mostra o aviso de parceiro do C6 com os canais oficiais em todas as páginas públicas (RN-015)', function () {
    $this->get(route('inicio'))
        ->assertSee('A B2BSAFE é escritório parceiro e distribuidor do C6 Bank.')
        ->assertSee('As informações deste site não são canais oficiais do C6.')
        ->assertSee('0800 660 0060')
        ->assertSee('3003 6116')
        ->assertSee('0800 660 6060')
        ->assertSee('faleconosco@c6bank.com.br')
        ->assertSee('https://www.c6bank.com.br/parceiro-c6-empresas/', escape: false);
});

it('mostra no rodapé o botão de preferências de cookies', function () {
    $this->get(route('inicio'))
        ->assertSee('Preferências de cookies')
        ->assertSee('abrir-preferencias-cookies', escape: false);
});

it('não usa bordas de um lado só nem emojis no layout', function () {
    $html = $this->get(route('inicio'))->getContent();

    expect($html)->not->toMatch('/\bborder-(t|b|l|r|s|e|x|y)(-\d+)?\b/')
        ->and($html)->not->toMatch('/[\x{1F300}-\x{1FAFF}\x{2600}-\x{27BF}]/u');
});
