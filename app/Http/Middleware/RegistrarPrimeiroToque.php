<?php

namespace App\Http\Middleware;

use App\Support\PreferenciasCookies;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

/**
 * Guarda o primeiro toque do visitante (UTM, gclid, fbclid, referrer, página de entrada) na sessão.
 * Com consentimento estatístico, também num cookie de 90 dias (RN-009). Nada vai para o banco aqui:
 * a origem só é gravada quando o visitante vira lead ou clica no WhatsApp (RegistrarOrigem).
 */
class RegistrarPrimeiroToque
{
    public const COOKIE = 'b2b_origem';

    private const VALIDADE_MINUTOS = 60 * 24 * 90;

    private const CAMPOS = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'gclid', 'fbclid'];

    public function handle(Request $request, Closure $next): Response
    {
        $sessao = $request->session();

        if (! $sessao->has('visitante_id')) {
            $sessao->put('visitante_id', (string) Str::uuid());
        }

        if (! $sessao->has('primeiro_toque')) {
            $sessao->put('primeiro_toque', $this->doCookie($request) ?? $this->daRequisicao($request));
        }

        $resposta = $next($request);

        if (PreferenciasCookies::aceitouEstatisticos($request) && ! $request->hasCookie(self::COOKIE)) {
            Cookie::queue(self::COOKIE, (string) json_encode($sessao->get('primeiro_toque')), self::VALIDADE_MINUTOS);
        }

        return $resposta;
    }

    /** @return array<string, string|null>|null */
    private function doCookie(Request $request): ?array
    {
        if (! PreferenciasCookies::aceitouEstatisticos($request)) {
            return null;
        }

        $bruto = $request->cookie(self::COOKIE);
        $toque = is_string($bruto) ? json_decode($bruto, true) : null;

        return is_array($toque) && isset($toque['primeiro_acesso_em']) ? $toque : null;
    }

    /** @return array<string, string|null> */
    private function daRequisicao(Request $request): array
    {
        $toque = [];

        foreach (self::CAMPOS as $campo) {
            $valor = $request->query($campo);
            $toque[$campo] = is_string($valor) && $valor !== '' ? mb_substr($valor, 0, 255) : null;
        }

        $referrer = $request->headers->get('referer');
        $hostReferrer = $referrer ? parse_url($referrer, PHP_URL_HOST) : null;

        // O referrer do próprio site não conta (RN-008)
        $toque['referrer'] = $referrer && $hostReferrer !== $request->getHost() ? mb_substr($referrer, 0, 2048) : null;
        $toque['pagina_entrada'] = mb_substr($request->fullUrl(), 0, 2048);
        $toque['primeiro_acesso_em'] = now()->toIso8601String();

        return $toque;
    }
}
