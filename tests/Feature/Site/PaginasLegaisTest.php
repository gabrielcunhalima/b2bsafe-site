<?php

// US-004 (#4) e US-005 (#5): a Política de Privacidade e os Termos de Uso são o texto original de
// https://www.b2bsafe.com.br/policy, sem alterações (pedido do responsável em 2026-11-17).

it('publica em /policy o Termo de LGPD e os Termos de Uso do site antigo (RF-003, RF-004)', function () {
    $this->get(route('policy'))
        ->assertOk()
        ->assertSee('<title>Política de Privacidade | B2BSAFE</title>', escape: false)
        ->assertSeeInOrder(['Termo de LGPD', 'SEÇÃO 1 - Controlador, operador e contatos', 'SEÇÃO 11 - Alterações desta política', 'Termos de Uso', 'SEÇÃO 1 - Objeto do serviço', 'SEÇÃO 10 - Suspensão e encerramento', 'Dúvidas:'])
        ->assertSee('mailto:ti@b2bsafe.com.br', escape: false);
});

it('mantém o texto exatamente como no site antigo, inclusive a numeração original (RF-003)', function () {
    $html = $this->get(route('policy'))->getContent();
    [$privacidade, $termos] = explode('id="termos-de-uso"', $html);

    preg_match_all('/SEÇÃO (\d+) -/', $privacidade, $secoesPrivacidade);
    preg_match_all('/SEÇÃO (\d+) -/', $termos, $secoesTermos);

    expect(array_map('intval', $secoesPrivacidade[1]))->toBe([1, 2, 3, 4, 5, 6, 7, 8, 6, 10, 11])
        ->and(array_map('intval', $secoesTermos[1]))->toBe([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
});

it('não fala de assistente virtual nem de Google Analytics, que não estão no texto original', function () {
    $html = $this->get(route('policy'))->assertDontSee('Última atualização')->getContent();
    $documento = (string) str($html)->after('<article class="texto-legal')->before('</article>');

    expect($documento)->toContain('Termo de LGPD')
        ->not->toContain('ssistente virtual')
        ->not->toContain('Mistral')
        ->not->toContain('Analytics');
});

it('leva /privacidade para /policy com 301', function () {
    $this->get('/privacidade')->assertMovedPermanently()->assertRedirect('/policy');
});

it('redireciona o link quebrado /policy. para /policy com 301 (RF-004)', function () {
    $this->get('/policy.')->assertMovedPermanently()->assertRedirect('/policy');
});

it('liga a Política de Privacidade e os Termos de Uso no rodapé e no aceite do formulário (RF-003)', function () {
    $this->get(route('inicio'))
        ->assertSee('href="'.route('policy').'" class="inline-flex', escape: false)
        ->assertSee('href="'.route('policy').'" target="_blank"', escape: false)
        ->assertSee('href="'.route('policy').'#termos-de-uso"', escape: false)
        ->assertDontSee('href="'.url('/privacidade').'"', escape: false);
});
