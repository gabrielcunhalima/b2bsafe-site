<?php

namespace App\Actions;

use App\Enums\CanalCaptacao;
use App\Enums\StatusLead;
use App\Enums\TipoConsentimento;
use App\Enums\TipoInteracao;
use App\Mail\NovoLead;
use App\Models\Consentimento;
use App\Models\Lead;
use App\Models\Origem;
use App\Support\Telefone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/**
 * Registra o contato do formulário como lead (RN-001), com o aceite versionado da política (RN-011),
 * a origem (RN-009) e a deduplicação da RN-003. Avisa a equipe por e-mail pela fila (RF-007).
 *
 * @phpstan-type DadosLead array{nome: string, whatsapp: string, email: string, servico: string, mensagem?: ?string}
 */
class RegistrarLead
{
    public const DIAS_DEDUPLICACAO = 30;

    /**
     * @param  DadosLead  $dados
     * @return array{lead: Lead, duplicado: bool}
     */
    public function executar(array $dados, ?Origem $origem, string $visitanteId): array
    {
        $whatsapp = Telefone::normalizar($dados['whatsapp']);
        $email = mb_strtolower(trim($dados['email']));
        $mensagem = filled($dados['mensagem'] ?? null) ? trim((string) $dados['mensagem']) : null;
        $conteudo = $this->conteudoInteracao($dados['servico'], $mensagem);

        $resultado = DB::transaction(function () use ($dados, $origem, $visitanteId, $whatsapp, $email, $mensagem, $conteudo): array {
            $consentimento = Consentimento::create([
                'visitante_id' => $visitanteId,
                'tipo' => TipoConsentimento::PoliticaFormulario,
                'versao_documento' => (string) config('b2bsafe.versoes.politica_privacidade'),
            ]);

            $anterior = Lead::query()
                ->whereNull('anonimizado_em')
                ->where(fn ($consulta) => $consulta->where('whatsapp', $whatsapp)->orWhere('email', $email))
                ->latest('id')
                ->lockForUpdate()
                ->first();

            // RN-003: lead aberto há até 30 dias recebe uma nova interação em vez de um lead novo
            if ($anterior !== null
                && in_array($anterior->status, StatusLead::abertos(), true)
                && $anterior->created_at?->gte(now()->subDays(self::DIAS_DEDUPLICACAO))) {
                $anterior->update([
                    'voltou_contato_em' => now(),
                    'ultima_interacao_em' => now(),
                    'consentimento_id' => $consentimento->id,
                ]);
                $anterior->interacoes()->create(['tipo' => TipoInteracao::Formulario, 'conteudo' => $conteudo]);

                return ['lead' => $anterior, 'duplicado' => true];
            }

            // Lead novo; se havia um anterior (fechado ou com mais de 30 dias), fica o vínculo (RN-003)
            $lead = Lead::create([
                'nome' => trim($dados['nome']),
                'whatsapp' => $whatsapp,
                'email' => $email,
                'servico' => $dados['servico'],
                'mensagem' => $mensagem,
                'canal_captacao' => CanalCaptacao::Formulario,
                'status' => StatusLead::Novo,
                'ultima_interacao_em' => now(),
                'lead_anterior_id' => $anterior?->id,
                'origem_id' => $origem?->id,
                'consentimento_id' => $consentimento->id,
            ]);
            $lead->interacoes()->create(['tipo' => TipoInteracao::Formulario, 'conteudo' => $conteudo]);

            return ['lead' => $lead, 'duplicado' => false];
        });

        $destinatario = config('b2bsafe.email_leads');

        if (filled($destinatario)) {
            // Pela fila: falha no SMTP não impede gravar o lead e gera nova tentativa (RF-007)
            Mail::to($destinatario)->queue(new NovoLead($resultado['lead'], $resultado['duplicado'], $mensagem, $dados['servico']));
        }

        return $resultado;
    }

    private function conteudoInteracao(string $servico, ?string $mensagem): string
    {
        $nomeServico = config("b2bsafe.servicos.{$servico}", $servico);

        return "Formulário do site · {$nomeServico}".($mensagem ? ": {$mensagem}" : '');
    }
}
