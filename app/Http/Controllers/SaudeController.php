<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Health check para o monitor de disponibilidade (RNF-001): aplicação, banco e fila.
 * Responde 503 quando algum item falha. Não expõe detalhes internos do erro.
 */
class SaudeController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $verificacoes = [
            'aplicacao' => ['ok' => true],
            'banco' => $this->verificar(fn (): array => ['ok' => DB::select('select 1 as ok')[0]->ok == 1]),
            'fila' => $this->verificar(fn (): array => [
                'ok' => true,
                'pendentes' => DB::table('jobs')->count(),
                'falhas' => DB::table('failed_jobs')->count(),
            ]),
        ];

        $saudavel = collect($verificacoes)->every(fn (array $item): bool => $item['ok']);

        return response()->json([
            'status' => $saudavel ? 'ok' : 'falha',
            'verificacoes' => $verificacoes,
            'verificado_em' => now()->toIso8601String(),
        ], $saudavel ? 200 : 503);
    }

    /**
     * @param  callable(): array<string, mixed>  $verificacao
     * @return array<string, mixed>
     */
    private function verificar(callable $verificacao): array
    {
        try {
            return $verificacao();
        } catch (Throwable $erro) {
            Log::error('Health check falhou', ['erro' => $erro->getMessage()]);

            return ['ok' => false];
        }
    }
}
