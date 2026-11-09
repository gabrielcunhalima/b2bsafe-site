<?php

namespace App\Http\Controllers;

use App\Actions\RegistrarPreferenciasCookies;
use App\Http\Middleware\RegistrarPrimeiroToque;
use App\Support\PreferenciasCookies;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

/**
 * Salva a escolha do banner de cookies (RF-009): registro em "consentimentos" e cookie de 12 meses.
 * Recusar os estatísticos apaga o cookie de origem de 90 dias (RN-009).
 */
class PreferenciasCookiesController extends Controller
{
    public function __invoke(Request $request, RegistrarPreferenciasCookies $registrar): JsonResponse
    {
        $estatisticos = $request->validate(['estatisticos' => ['required', 'boolean']])['estatisticos'];
        $estatisticos = filter_var($estatisticos, FILTER_VALIDATE_BOOLEAN);

        $sessao = $request->session();
        if (! $sessao->has('visitante_id')) {
            $sessao->put('visitante_id', (string) Str::uuid());
        }

        $registrar->executar((string) $sessao->get('visitante_id'), $estatisticos);

        $preferencias = ['versao' => (string) config('b2bsafe.versoes.cookies'), 'estatisticos' => $estatisticos];
        Cookie::queue(PreferenciasCookies::COOKIE, (string) json_encode($preferencias), PreferenciasCookies::VALIDADE_MINUTOS);

        if (! $estatisticos) {
            Cookie::queue(Cookie::forget(RegistrarPrimeiroToque::COOKIE));
        }

        return response()->json($preferencias);
    }
}
