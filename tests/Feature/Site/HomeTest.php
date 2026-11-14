<?php

// US-002 (#2): Home institucional (RF-001, RN-015, RN-021, wireframe T-01).

it('mostra as seções da Home na ordem do wireframe, com as âncoras do menu', function () {
    $this->get(route('inicio'))
        ->assertOk()
        ->assertSeeInOrder([
            'boas mãos.',
            'id="servicos"',
            'id="sobre"',
            'id="maquininha"',
            'id="parcerias"',
            'id="contato"',
            'id="credenciamento"',
            'Canais oficiais C6 Bank',
        ], escape: false);
});

it('mostra os 8 serviços em cards pequenos logo abaixo do topo, cada um abrindo o WhatsApp com o serviço na mensagem (RN-021)', function () {
    $resposta = $this->get(route('inicio'));

    foreach (['credito' => 'Crédito', 'conta_corrente' => 'Conta Corrente', 'cambio' => 'Câmbio', 'investimentos' => 'Investimentos',
        'cartao' => 'Cartão C6 Business', 'consorcio' => 'Consórcio', 'seguros_previdencia' => 'Seguros e Previdência'] as $chave => $nome) {
        $resposta->assertSee('data-whatsapp="home" data-servico="'.$chave.'"', escape: false)
            ->assertSee('https://wa.me/5511984205023?text='.rawurlencode("Olá! Vim pelo site e quero saber sobre {$nome}."), escape: false);
    }

    $resposta->assertSee('data-whatsapp="home" data-servico="maquininha"', escape: false)
        ->assertSeeInOrder(['boas mãos.', 'id="servicos"', 'id="sobre"'], escape: false);

    expect(substr_count($resposta->getContent(), 'fale com um atendente no WhatsApp'))->toBe(8);
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

it('leva da seção Maquininha à página de taxas e condições (RF-001)', function () {
    $this->get(route('inicio'))
        ->assertSee('Ver taxas e condições')
        ->assertSee('href="'.route('maquininha').'"', escape: false);
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

it('mostra o logo da B2BSAFE no cabeçalho e o logo com C6 Empresas no rodapé', function () {
    $this->get(route('inicio'))
        ->assertSee('img/b2bsafe-logo.webp', escape: false)
        ->assertSee('img/b2bsafe-c6-empresas.webp', escape: false)
        ->assertSee('alt="B2BSAFE, página inicial"', escape: false);
});

it('mostra a imagem do selo Conexão Awards 2025 com texto alternativo', function () {
    $this->get(route('inicio'))
        ->assertSee('img/conexao-awards-2025.webp', escape: false)
        ->assertSee('alt="Selo Conexão Awards 2025 do C6 Empresas', escape: false);
});

it('serve as imagens da marca', function (string $arquivo) {
    expect(public_path("img/{$arquivo}"))->toBeFile();
})->with(['b2bsafe-logo.webp', 'b2bsafe-c6-empresas.webp', 'conexao-awards-2025.webp']);

it('mostra a imagem da C6 Pay na seção Maquininha', function () {
    $this->get(route('inicio'))
        ->assertSeeInOrder(['id="maquininha"', 'img/maquininha-c6-pay.webp', 'id="titulo-como"'], escape: false)
        ->assertSee('alt="Maquininha C6 Pay', escape: false);

    expect(public_path('img/maquininha-c6-pay.webp'))->toBeFile();
});

it('junta Sobre e Conta PJ numa seção de largura total no fundo da hero, sem foto da conta PJ', function () {
    $html = $this->get(route('inicio'))
        ->assertSeeInOrder(['id="servicos"', 'id="sobre"', 'Sua empresa e seus investimentos', 'id="conta-pj"', 'Abra a conta PJ', 'id="maquininha"'], escape: false)
        ->assertDontSee('foto-caixa-compra', escape: false)
        ->assertDontSee('conta-pj-c6.webp', escape: false)
        ->getContent();

    $secao = (string) str($html)->after('<section id="sobre"')->before('</section>');

    expect(substr_count($secao, '<img'))->toBe(1)
        ->and($secao)->toContain('img/conexao-awards-2025.webp')
        ->and(str($html)->contains('<section id="sobre" aria-labelledby="titulo-sobre" class="bg-gelo">'))->toBeTrue();
});

it('junta Fale conosco e Credenciamento numa seção só, com o formulário', function () {
    $html = $this->get(route('inicio'))->getContent();
    $secao = (string) str($html)->after('<section id="contato"')->before('</section>');

    expect($secao)->toContain('id="credenciamento"')
        ->toContain('Verifique nosso credenciamento')
        ->toContain('<form');
});

it('tira a faixa de confiança', function () {
    $this->get(route('inicio'))->assertDontSee('Por que a B2BSAFE');
});

it('não usa badges flutuantes, marca-texto amarelo nem zoom no hover', function () {
    $this->get(route('inicio'))
        ->assertDontSee('flutuar', escape: false)
        ->assertDontSee('destaque-amarelo', escape: false)
        ->assertDontSee('hover:scale', escape: false)
        ->assertDontSee('hover:-translate', escape: false)
        ->assertDontSee('moldura', escape: false);
});

it('leva o botão da seção Conta PJ ao formulário com Conta Corrente e o WhatsApp citando o serviço', function () {
    $this->get(route('inicio'))
        ->assertSee('href="#contato" data-servico="conta_corrente"', escape: false)
        ->assertSee(rawurlencode('Olá! Vim pelo site e quero saber sobre Conta Corrente.'), escape: false);
});
