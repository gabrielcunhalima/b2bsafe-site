<?php

// US-002 (#2): Home institucional (RF-001, RN-015, RN-021, wireframe T-01).

it('mostra as seções da Home na ordem do wireframe, com as âncoras do menu', function () {
    $this->get(route('inicio'))
        ->assertOk()
        ->assertSeeInOrder([
            'aria-label="Serviços da B2BSAFE"',
            'id="sobre"',
            'id="parcerias"',
            'id="credenciamento"',
            'id="contato"',
            'Canais oficiais C6 Bank',
        ], escape: false);
});

it('abre a Home com o carrossel dos 8 serviços como hero, cada um com WhatsApp citando o serviço (RF-001, RN-021)', function () {
    $resposta = $this->get(route('inicio'))
        ->assertSee('id="servicos" aria-roledescription="carrossel"', escape: false)
        ->assertDontSee('boas mãos.');

    foreach (['credito' => 'Crédito', 'conta_corrente' => 'Conta Corrente', 'cambio' => 'Câmbio', 'investimentos' => 'Investimentos',
        'cartao' => 'Cartão C6 Business', 'consorcio' => 'Consórcio', 'seguros_previdencia' => 'Seguros e Previdência'] as $chave => $nome) {
        $resposta->assertSee('data-whatsapp="carrossel" data-servico="'.$chave.'"', escape: false)
            ->assertSee('https://wa.me/5511984205023?text='.rawurlencode("Olá! Vim pelo site e quero saber sobre {$nome}."), escape: false);
    }

    expect(substr_count($resposta->getContent(), 'aria-roledescription="slide"'))->toBe(8);
});

it('mostra embaixo do carrossel os nomes dos 8 serviços, cada um levando ao seu slide', function () {
    $html = $this->get(route('inicio'))->getContent();
    $barra = (string) str($html)->after('aria-label="Escolha o serviço"')->before('</nav>');

    foreach (array_keys(config('b2bsafe.carrossel')) as $indice => $chave) {
        $ancora = 'servico-'.str_replace('_', '-', $chave);
        expect($barra)->toContain('href="#'.$ancora.'" @click.prevent="escolher('.$indice.')"')
            ->and($html)->toContain('id="'.$ancora.'"');
    }
});

it('guarda a hero antiga no código, desligada, e mostra de volta quando a configuração pede', function () {
    $this->get(route('inicio'))->assertDontSee('Sua empresa em boas mãos.');

    config(['b2bsafe.home.hero_antiga' => true]);

    $this->get(route('inicio'))->assertSee('Sua empresa em boas mãos.');
});

it('tem foto em todos os slides do carrossel', function () {
    $html = $this->get(route('inicio'))->getContent();

    foreach (config('b2bsafe.carrossel') as $chave => $slide) {
        $artigo = (string) str($html)->after('data-slide="'.str_replace('_', '-', $chave).'"')->before('</article>');
        expect($artigo)->toContain($slide['imagem'])
            ->and(public_path($slide['imagem']))->toBeFile();
    }
});

it('marca os links de WhatsApp para o registro do clique (RN-010)', function () {
    $html = $this->get(route('inicio'))->getContent();

    preg_match_all('/<a [^>]*href="https:\/\/wa\.me\/[^"]*"[^>]*>/', $html, $links);

    expect($links[0])->not->toBeEmpty();
    foreach ($links[0] as $link) {
        expect($link)->toContain('data-whatsapp=');
    }
});

it('usa o WhatsApp da maquininha no slide da C6 Pay (RN-021)', function () {
    $html = $this->get(route('inicio'))->getContent();
    $slide = (string) str($html)->after('data-slide="maquininha"')->before('</article>');

    expect($slide)->toContain('https://wa.me/5511924600991?text='.rawurlencode('Olá! Vim pelo site e quero saber sobre a maquininha C6 Pay.'))
        ->toContain('Falar sobre a C6 Pay');
});

it('leva do slide da Maquininha à página de taxas e condições (RF-001)', function () {
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

it('mostra o credenciamento numa seção própria antes do Fale conosco, com os dois jeitos de conferir no C6 (RN-015)', function () {
    $html = $this->get(route('inicio'))
        ->assertSeeInOrder(['id="credenciamento"', 'Pela lista oficial de parceiros', 'Pelo site do C6 Bank', 'Nossas empresas credenciadas', 'id="contato"'], escape: false)
        ->assertSee('href="'.config('b2bsafe.verificacao_c6').'"', escape: false)
        ->assertSee('href="'.config('b2bsafe.verificacao_c6_pagina').'"', escape: false)
        ->assertSee('Tem uma empresa e quer consultar nossos escritórios autorizados')
        ->assertSee('58.358.780/0001-26')
        ->assertSee('41.708.313/0001-86')
        ->assertSee('Rosiane Mazzorana Ltda')
        ->assertSee('54.192.797/0001-03')
        ->getContent();

    expect(substr_count((string) str($html)->after('id="credenciamento"')->before('</section>'), 'Copiar CNPJ</span>'))->toBe(3);
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

it('mostra a imagem da C6 Pay no slide da Maquininha', function () {
    $this->get(route('inicio'))
        ->assertSeeInOrder(['data-slide="maquininha"', 'img/maquininha-c6-pay.webp', 'data-slide="conta-corrente"'], escape: false)
        ->assertSee('alt="Maquininha C6 Pay', escape: false);

    expect(public_path('img/maquininha-c6-pay.webp'))->toBeFile();
});

it('junta Sobre e Conta PJ numa seção de largura total no fundo da hero, sem foto da conta PJ', function () {
    $html = $this->get(route('inicio'))
        ->assertSeeInOrder(['id="servicos"', 'id="sobre"', 'Sua empresa e seus investimentos', 'id="conta-pj"', 'Abra a conta PJ', 'id="titulo-como"'], escape: false)
        ->assertDontSee('foto-caixa-compra', escape: false)
        ->assertDontSee('conta-pj-c6.webp', escape: false)
        ->getContent();

    $secao = (string) str($html)->after('<section id="sobre"')->before('</section>');

    expect(substr_count($secao, '<img'))->toBe(1)
        ->and($secao)->toContain('img/conexao-awards-2025.webp')
        ->and(str($html)->contains('<section id="sobre" aria-labelledby="titulo-sobre" class="bg-gelo">'))->toBeTrue();
});

it('mostra os canais oficiais do C6 depois do formulário no Fale conosco (ordem do celular)', function () {
    $this->get(route('inicio'))
        ->assertSeeInOrder(['id="contato"', '<form', 'id="canais-c6"'], escape: false);
});

it('deixa o Fale conosco com o formulário numa seção separada do credenciamento', function () {
    $html = $this->get(route('inicio'))->getContent();
    $secao = (string) str($html)->after('<section id="contato"')->before('</section>');

    expect($secao)->toContain('<form')->not->toContain('id="credenciamento"');
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
