<?php

// US-002 (#2): Home institucional (RF-001, RN-015, RN-021, wireframe T-01).

it('mostra as seções da Home na ordem do wireframe, com as âncoras do menu', function () {
    $this->get(route('inicio'))
        ->assertOk()
        ->assertSeeInOrder([
            'Sua empresa em boas mãos.',
            'id="servicos"',
            'id="maquininha"',
            'id="sobre"',
            'id="parcerias"',
            'id="contato"',
            'id="credenciamento"',
            'Canais oficiais C6 Bank',
        ], escape: false);
});

it('mostra os 7 cards de serviço, cada um abrindo o WhatsApp com o serviço na mensagem (RN-021)', function () {
    $resposta = $this->get(route('inicio'));

    foreach (['credito' => 'Crédito', 'conta_corrente' => 'Conta Corrente', 'cambio' => 'Câmbio', 'investimentos' => 'Investimentos',
        'cartao' => 'Cartão C6 Business', 'consorcio' => 'Consórcio', 'seguros_previdencia' => 'Seguros e Previdência'] as $chave => $nome) {
        $resposta->assertSee('data-servico="'.$chave.'"', escape: false)
            ->assertSee('https://wa.me/5511984205023?text='.rawurlencode("Olá! Vim pelo site e quero saber sobre {$nome}."), escape: false);
    }

    expect(substr_count($resposta->getContent(), 'Fale com um atendente'))->toBe(7);
});

it('marca os links de WhatsApp para o registro do clique (RN-010)', function () {
    $html = $this->get(route('inicio'))->getContent();

    preg_match_all('/<a [^>]*href="https:\/\/wa\.me\/[^"]*"[^>]*>/', $html, $links);

    expect($links[0])->not->toBeEmpty();
    foreach ($links[0] as $link) {
        expect($link)->toContain('data-whatsapp=');
    }
});

it('usa o WhatsApp da maquininha na seção da C6 Pay (RN-021)', function () {
    $this->get(route('inicio'))
        ->assertSee('https://wa.me/5511924600991?text='.rawurlencode('Olá! Vim pelo site e quero saber sobre a maquininha C6 Pay.'), escape: false)
        ->assertSee('Quero minha C6 Pay')
        ->assertSee('(11) 92460-0991');
});

it('não leva à página da maquininha enquanto ela não existir (RF-002)', function () {
    $this->get(route('inicio'))
        ->assertDontSee('Ver taxas e condições')
        ->assertDontSee('href="'.url('/maquininha').'"', escape: false);
});

it('mostra o selo do Conexão Awards na seção Sobre', function () {
    $this->get(route('inicio'))
        ->assertSee('Escritório destaque 2025')
        ->assertSee('Conexão Awards C6 Empresas');
});

it('leva os botões de parceria ao Fale conosco com o serviço parceria', function () {
    $html = $this->get(route('inicio'))->getContent();

    expect(substr_count($html, 'href="#contato" data-servico="parceria"'))->toBe(2);
});

it('mostra o credenciamento com os três CNPJs e o link oficial do C6', function () {
    $this->get(route('inicio'))
        ->assertSee('Verifique nosso credenciamento')
        ->assertSee('58.358.780/0001-26')
        ->assertSee('41.708.313/0001-86')
        ->assertSee('Rosiane Mazzorana Ltda')
        ->assertSee('54.192.797/0001-03')
        ->assertSee('Verificar no C6 Bank');
});

it('não promete prazo de resposta', function () {
    $this->get(route('inicio'))
        ->assertDontSee('horário comercial')
        ->assertDontSee('em até 24')
        ->assertDontSee('minutos');
});

it('mostra o logo da B2BSAFE no cabeçalho e a versão clara no rodapé', function () {
    $this->get(route('inicio'))
        ->assertSee('img/b2bsafe-logo.webp', escape: false)
        ->assertSee('img/b2bsafe-logo-branco.webp', escape: false)
        ->assertSee('alt="B2BSAFE, página inicial"', escape: false);
});

it('mostra a imagem do selo Conexão Awards 2025 com texto alternativo', function () {
    $this->get(route('inicio'))
        ->assertSee('img/conexao-awards-2025.webp', escape: false)
        ->assertSee('alt="Selo Conexão Awards 2025 do C6 Empresas', escape: false);
});

it('serve as imagens da marca', function (string $arquivo) {
    expect(public_path("img/{$arquivo}"))->toBeFile();
})->with(['b2bsafe-logo.webp', 'b2bsafe-logo-branco.webp', 'conexao-awards-2025.webp']);
