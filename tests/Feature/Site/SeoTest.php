<?php

// US-033 (#39): SEO técnico (RF-011).

it('dá a cada página pública título e descrição próprios', function () {
    $titulos = collect(['inicio', 'maquininha', 'privacidade', 'policy'])->map(function (string $rota) {
        $html = $this->get(route($rota))->assertOk()->getContent();
        preg_match('/<title>(.*?)<\/title>/', $html, $titulo);
        preg_match('/<meta name="description" content="(.*?)">/', $html, $descricao);

        return [$titulo[1], $descricao[1]];
    });

    expect($titulos->pluck(0)->unique())->toHaveCount(4)
        ->and($titulos->pluck(1)->unique())->toHaveCount(4);
});

it('usa URL canônica sem os parâmetros de campanha', function () {
    $this->get('/?utm_source=instagram&gclid=abc')
        ->assertSee('<link rel="canonical" href="'.route('inicio').'">', escape: false);
});

it('traz Open Graph e Twitter Card com a imagem de 1200 × 630', function () {
    $this->get(route('maquininha'))
        ->assertSee('<meta property="og:title" content="Maquininha C6 Pay | B2BSAFE">', escape: false)
        ->assertSee('<meta property="og:image" content="'.asset('img/og-b2bsafe.jpg').'">', escape: false)
        ->assertSee('<meta property="og:image:width" content="1200">', escape: false)
        ->assertSee('<meta name="twitter:card" content="summary_large_image">', escape: false);

    expect(getimagesize(public_path('img/og-b2bsafe.jpg')))->toMatchArray([0 => 1200, 1 => 630]);
});

it('publica os dados estruturados FinancialService com os dois endereços', function () {
    $html = $this->get(route('inicio'))->getContent();
    preg_match('/<script type="application\/ld\+json">(.*?)<\/script>/s', $html, $json);
    $dados = json_decode($json[1], true);

    expect($dados['@type'])->toBe('FinancialService')
        ->and($dados['address'])->toHaveCount(2)
        ->and(array_column($dados['address'], 'addressLocality'))->toBe(['São José', 'Vinhedo'])
        ->and(array_column($dados['subOrganization'], 'taxID'))->toBe(['58.358.780/0001-26', '41.708.313/0001-86']);
});

it('lista no sitemap só as páginas públicas', function () {
    $xml = $this->get(route('sitemap'))
        ->assertOk()
        ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
        ->getContent();

    $urls = simplexml_load_string($xml)->url;
    $locs = array_map(fn ($url) => (string) $url->loc, iterator_to_array($urls, false));

    expect($locs)->toBe([route('inicio'), route('maquininha'), route('privacidade'), route('policy')])
        ->and($xml)->not->toContain('/painel');
});

it('bloqueia tudo no robots.txt fora da produção', function () {
    $this->get('/robots.txt')->assertOk()->assertSeeText("User-agent: *\nDisallow: /");
});

it('libera o site no robots.txt da produção, sem a área restrita, e aponta o sitemap', function () {
    app()['env'] = 'production';

    $linhas = explode("\n", $this->get('/robots.txt')->assertSeeText('Disallow: /painel')->getContent());

    expect($linhas)->toContain('Sitemap: '.route('sitemap'))
        ->not->toContain('Disallow: /');
});

it('marca a área restrita com noindex', function () {
    $this->get('/painel/login')->assertHeader('X-Robots-Tag', 'noindex, nofollow');
});

it('só tira o noindex das páginas em produção', function () {
    $this->get(route('inicio'))->assertSee('<meta name="robots" content="noindex, nofollow">', escape: false);

    app()['env'] = 'production';
    $this->get(route('inicio'))->assertDontSee('noindex', escape: false);
});
