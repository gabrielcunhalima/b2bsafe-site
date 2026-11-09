<?php

use App\Enums\TipoConsentimento;
use App\Http\Middleware\RegistrarPrimeiroToque;
use App\Models\Consentimento;
use App\Support\PreferenciasCookies;

// US-012 (#12) e US-013 (#13): banner de cookies e GA4 com Consent Mode v2.

function cookiePreferencias(bool $estatisticos, ?string $versao = null): string
{
    return json_encode(['versao' => $versao ?? (string) config('b2bsafe.versoes.cookies'), 'estatisticos' => $estatisticos]);
}

it('mostra o banner com Aceitar, Recusar e Personalizar no primeiro acesso (RF-009)', function () {
    $this->get(route('inicio'))
        ->assertSee('Cookies neste site')
        ->assertSeeInOrder(['Personalizar', 'Recusar', 'Aceitar todos'])
        ->assertSee('\u0022escolha\u0022:null', escape: false);
});

it('dá a "Recusar" o mesmo destaque de "Aceitar todos" (RF-009)', function () {
    $html = $this->get(route('inicio'))->getContent();

    preg_match('/<button[^>]*class="([^"]*)"[^>]*>Recusar<\/button>/', $html, $recusar);
    preg_match('/<button[^>]*class="([^"]*)"[^>]*>Aceitar todos<\/button>/', $html, $aceitar);

    expect($recusar[1])->toBe($aceitar[1]);
});

it('registra a escolha com data, versão e categorias e grava o cookie de 12 meses (RN-011)', function () {
    config(['b2bsafe.versoes.cookies' => '2']);

    $this->postJson(route('cookies.preferencias'), ['estatisticos' => true])
        ->assertOk()
        ->assertJson(['versao' => '2', 'estatisticos' => true])
        ->assertCookie(PreferenciasCookies::COOKIE);

    $consentimento = Consentimento::sole();
    expect($consentimento->tipo)->toBe(TipoConsentimento::Cookies)
        ->and($consentimento->versao_documento)->toBe('2')
        ->and($consentimento->categorias)->toBe(['necessarios', 'estatisticos'])
        ->and($consentimento->created_at)->not->toBeNull();
});

it('registra a recusa só com os necessários e apaga o cookie de origem (RN-009, RN-011)', function () {
    $resposta = $this->postJson(route('cookies.preferencias'), ['estatisticos' => false])->assertOk();

    expect(Consentimento::sole()->categorias)->toBe(['necessarios']);
    $cookieOrigem = collect($resposta->headers->getCookies())->first(fn ($c) => $c->getName() === RegistrarPrimeiroToque::COOKIE);
    expect($cookieOrigem?->isCleared())->toBeTrue();
});

it('não mostra o banner para quem já escolheu na versão atual', function () {
    $this->withCookie(PreferenciasCookies::COOKIE, cookiePreferencias(false))
        ->get(route('inicio'))
        ->assertDontSee('\u0022escolha\u0022:null', escape: false)
        ->assertSee('\u0022estatisticos\u0022:false', escape: false);
});

it('mostra o banner de novo quando a versão da política de cookies muda (RN-011)', function () {
    config(['b2bsafe.versoes.cookies' => '2']);

    $this->withCookie(PreferenciasCookies::COOKIE, cookiePreferencias(true, '1'))
        ->get(route('inicio'))
        ->assertSee('\u0022escolha\u0022:null', escape: false);
});

it('exige a escolha dos estatísticos', function () {
    $this->postJson(route('cookies.preferencias'), [])->assertJsonValidationErrors('estatisticos');
});

it('liga o GA4 só com ID configurado e fora dos ambientes local e de teste (RF-010)', function () {
    config(['b2bsafe.ga4_id' => 'G-TESTE123']);
    $this->get(route('inicio'))->assertDontSee('ga4-id', escape: false);

    app()['env'] = 'production';
    $this->get(route('inicio'))->assertSee('<meta name="ga4-id" content="G-TESTE123">', escape: false);

    config(['b2bsafe.ga4_id' => null]);
    $this->get(route('inicio'))->assertDontSee('ga4-id', escape: false);
});

it('não carrega o script do Google no HTML: só depois do consentimento, pelo JavaScript (RF-010)', function () {
    config(['b2bsafe.ga4_id' => 'G-TESTE123']);
    app()['env'] = 'production';

    $this->get(route('inicio'))->assertDontSee('googletagmanager.com', escape: false);
});
