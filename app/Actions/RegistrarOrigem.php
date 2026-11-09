<?php

namespace App\Actions;

use App\Models\Origem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

/**
 * Grava no banco o primeiro toque guardado na sessão, quando o visitante vira lead ou clica no
 * WhatsApp (RN-009). Na mesma sessão, reaproveita a origem já gravada.
 */
class RegistrarOrigem
{
    public function __construct(private ClassificarCanal $classificarCanal) {}

    public function executar(Request $request): Origem
    {
        $sessao = $request->session();
        $origemId = $sessao->get('origem_id');

        if ($origemId !== null && ($origem = Origem::find($origemId)) !== null) {
            return $origem;
        }

        /** @var array<string, string|null> $toque */
        $toque = $sessao->get('primeiro_toque', []);

        $origem = Origem::create([
            'canal' => $this->classificarCanal->executar($toque, $request->getHost()),
            'utm_source' => $toque['utm_source'] ?? null,
            'utm_medium' => $toque['utm_medium'] ?? null,
            'utm_campaign' => $toque['utm_campaign'] ?? null,
            'utm_term' => $toque['utm_term'] ?? null,
            'utm_content' => $toque['utm_content'] ?? null,
            'gclid' => $toque['gclid'] ?? null,
            'fbclid' => $toque['fbclid'] ?? null,
            'referrer' => $toque['referrer'] ?? null,
            'pagina_entrada' => $toque['pagina_entrada'] ?? null,
            'primeiro_acesso_em' => isset($toque['primeiro_acesso_em']) ? Carbon::parse($toque['primeiro_acesso_em']) : now(),
        ]);

        $sessao->put('origem_id', $origem->id);

        return $origem;
    }
}
