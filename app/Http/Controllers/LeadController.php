<?php

namespace App\Http\Controllers;

use App\Actions\RegistrarLead;
use App\Actions\RegistrarOrigem;
use App\Http\Requests\EnviarLeadRequest;
use App\Support\WhatsApp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

/**
 * Recebe o formulário de lead (RF-006). Responde JSON para o envio sem recarregar e redireciona
 * de volta ao "Fale conosco" quando o navegador envia sem JavaScript.
 */
class LeadController extends Controller
{
    /** RN-016: até 5 envios por IP por hora. */
    public const LIMITE_POR_HORA = 5;

    public function store(EnviarLeadRequest $request, RegistrarLead $registrarLead, RegistrarOrigem $registrarOrigem): JsonResponse|RedirectResponse
    {
        $chave = 'formulario-lead:'.$request->ip();

        if (RateLimiter::tooManyAttempts($chave, self::LIMITE_POR_HORA)) {
            $mensagem = 'Não conseguimos enviar agora. Tente de novo em alguns minutos ou fale com a gente pelo WhatsApp.';

            return $request->expectsJson()
                ? response()->json(['message' => $mensagem], 429)
                : redirect()->to(url()->previous().'#contato')->withInput()->with('lead_falha', $mensagem);
        }

        RateLimiter::hit($chave, 3600);

        $dados = $request->dadosLead();

        // Robô que preencheu a armadilha: responde como sucesso, sem gravar nada (RN-016)
        if (! $request->ehRobo()) {
            $registrarLead->executar(
                $dados,
                $registrarOrigem->executar($request),
                (string) $request->session()->get('visitante_id', (string) Str::uuid()),
            );
        }

        $resposta = [
            'nome' => Str::of($dados['nome'])->trim()->before(' ')->toString(),
            'servico' => $dados['servico'],
            'nome_servico' => config("b2bsafe.servicos.{$dados['servico']}"),
            'whatsapp' => WhatsApp::linkDoServico($dados['servico']),
        ];

        return $request->expectsJson()
            ? response()->json($resposta, 201)
            : redirect()->to(url()->previous().'#contato')->with('lead_enviado', $resposta);
    }
}
