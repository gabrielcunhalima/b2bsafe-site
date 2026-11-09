<?php

namespace App\Http\Controllers;

use App\Actions\RegistrarCliqueWhatsapp;
use App\Actions\RegistrarOrigem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

/**
 * Recebe o aviso de clique no WhatsApp enviado pelo navegador (sendBeacon), sem atrasar a abertura
 * do WhatsApp. Só aceita os números configurados do site (RN-010, RN-021).
 */
class CliqueWhatsappController extends Controller
{
    public function __invoke(Request $request, RegistrarCliqueWhatsapp $registrarClique, RegistrarOrigem $registrarOrigem): Response
    {
        $dados = $request->validate([
            'numero' => ['required', 'string', Rule::in(array_values(config('b2bsafe.whatsapp')))],
            'pagina' => ['nullable', 'string', 'max:2048'],
            'servico' => ['nullable', 'string', Rule::in(array_keys(config('b2bsafe.servicos')))],
        ]);

        $registrarClique->executar(
            $dados['numero'],
            $dados['pagina'] ?? null,
            $dados['servico'] ?? null,
            $registrarOrigem->executar($request),
        );

        return response()->noContent();
    }
}
