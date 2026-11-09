<?php

use App\Actions\ClassificarCanal;

// RN-008: classificação do canal de origem pelo primeiro toque, em ordem de prioridade.

function canal(array $toque, ?string $host = 'b2bsafe.com.br'): string
{
    return (new ClassificarCanal)->executar($toque, $host);
}

it('classifica como Google Ads quando há gclid, acima de qualquer UTM (RN-008)', function () {
    expect(canal(['gclid' => 'abc', 'utm_source' => 'instagram', 'utm_medium' => 'bio']))->toBe('Google Ads');
});

it('classifica como Meta Ads com fbclid ou fonte Meta com mídia paga (RN-008)', function () {
    expect(canal(['fbclid' => 'xyz']))->toBe('Meta Ads')
        ->and(canal(['utm_source' => 'Instagram', 'utm_medium' => 'cpc']))->toBe('Meta Ads')
        ->and(canal(['utm_source' => 'facebook', 'utm_medium' => 'paid']))->toBe('Meta Ads');
});

it('classifica como Mídia paga quando utm_medium é cpc, ppc, paid ou ads (RN-008)', function (string $midia) {
    expect(canal(['utm_source' => 'bing', 'utm_medium' => $midia]))->toBe('Mídia paga (bing)');
})->with(['cpc', 'ppc', 'paid', 'ads', 'CPC']);

it('classifica outros UTMs como Campanha com fonte e mídia (RN-008)', function () {
    expect(canal(['utm_source' => 'instagram', 'utm_medium' => 'bio']))->toBe('Campanha (instagram / bio)')
        ->and(canal(['utm_campaign' => 'black-friday']))->toBe('Campanha (sem fonte / sem mídia)');
});

it('classifica referrer de buscador como Busca orgânica (RN-008)', function () {
    expect(canal(['referrer' => 'https://www.google.com.br/']))->toBe('Busca orgânica')
        ->and(canal(['referrer' => 'https://duckduckgo.com/?q=b2bsafe']))->toBe('Busca orgânica');
});

it('classifica referrer de rede social como Redes sociais (RN-008)', function () {
    expect(canal(['referrer' => 'https://l.instagram.com/']))->toBe('Redes sociais')
        ->and(canal(['referrer' => 'https://www.linkedin.com/feed/']))->toBe('Redes sociais')
        ->and(canal(['referrer' => 'https://t.co/abc']))->toBe('Redes sociais');
});

it('classifica outro referrer como Referência com o domínio (RN-008)', function () {
    expect(canal(['referrer' => 'https://www.portaldoempreendedor.com.br/artigo']))->toBe('Referência (portaldoempreendedor.com.br)');
});

it('classifica sem UTM nem referrer como Direto (RN-008)', function () {
    expect(canal([]))->toBe('Direto')
        ->and(canal(['utm_source' => '  ', 'referrer' => null]))->toBe('Direto');
});

it('ignora o referrer do próprio site (RN-008)', function () {
    expect(canal(['referrer' => 'https://www.b2bsafe.com.br/maquininha']))->toBe('Direto');
});
