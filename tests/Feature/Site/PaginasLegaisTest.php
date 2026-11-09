<?php

// US-004 (#4) e US-005 (#5): Política de Privacidade do site e /policy do B2BSafe Connect.

it('mostra a Política de Privacidade com versão e data da configuração (RF-003, RN-011)', function () {
    config(['b2bsafe.versoes.politica_privacidade' => '2', 'b2bsafe.documentos.privacidade_atualizada_em' => '2026-11-20']);

    $this->get(route('privacidade'))
        ->assertOk()
        ->assertSee('<title>Política de Privacidade | B2BSAFE</title>', escape: false)
        ->assertSee('Versão 2')
        ->assertSee('20/11/2026');
});

it('cobre formulário, assistente (Mistral, França), cookies, GA4, 24 meses, direitos e o encarregado (RF-003)', function () {
    $this->get(route('privacidade'))
        ->assertSee('Formulário de contato')
        ->assertSee('Assistente virtual')
        ->assertSee('Mistral AI')
        ->assertSee('França')
        ->assertSee('Google Analytics')
        ->assertSee('24 meses')
        ->assertSee('Seus direitos')
        ->assertSee('mailto:ti@b2bsafe.com.br', escape: false);
});

it('numera as seções da Política de Privacidade em sequência, sem repetir (RF-003)', function () {
    $html = $this->get(route('privacidade'))->getContent();

    preg_match_all('/<h2 id="[^"]+-titulo">(\d+)\./', $html, $numeros);

    expect(array_map('intval', $numeros[1]))->toBe(range(1, 11));
});

it('publica /policy com as seções do B2BSafe Connect corrigidas (RF-004)', function () {
    $html = $this->get(route('policy'))->assertOk()->assertSee('Termos de Uso do B2BSafe Connect')->getContent();

    [$privacidade, $termos] = explode('id="connect-termos"', $html);
    preg_match_all('/Seção (\d+)\./', $privacidade, $secoesPrivacidade);
    preg_match_all('/Seção (\d+)\./', $termos, $secoesTermos);

    expect(array_map('intval', $secoesPrivacidade[1]))->toBe(range(1, 11))
        ->and(array_map('intval', $secoesTermos[1]))->toBe(range(1, 10))
        ->and($termos)->toContain('Seção 10. Alterações e foro')
        ->and($html)->not->toContain('/policy.<');
});

it('redireciona o link quebrado /policy. para /policy com 301 (RF-004)', function () {
    $this->get('/policy.')->assertMovedPermanently()->assertRedirect('/policy');
});

it('liga a Política de Privacidade no rodapé e no aceite do formulário (RF-003)', function () {
    $this->get(route('inicio'))
        ->assertSee('href="'.route('privacidade').'" class="inline-flex', escape: false)
        ->assertSee('href="'.route('privacidade').'" target="_blank"', escape: false)
        ->assertSee('href="'.route('policy').'"', escape: false);
});
