<?php

namespace App\Mail;

use App\Models\Lead;
use App\Support\Telefone;
use App\Support\WhatsApp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * E-mail para a equipe a cada lead novo ou "voltou a entrar em contato" (RF-007, RN-003, wireframe E-01).
 * Vai pela fila: com falha no SMTP, tenta de novo (3 tentativas, com intervalo crescente).
 */
class NovoLead extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public int $tries = 3;

    /** @var list<int> */
    public array $backoff = [60, 300, 900];

    public function __construct(
        public Lead $lead,
        public bool $voltouContato,
        public ?string $mensagem,
        public string $servico,
    ) {
        $this->afterCommit();
    }

    public function envelope(): Envelope
    {
        $nomeServico = config("b2bsafe.servicos.{$this->servico}", $this->servico);

        return new Envelope(
            subject: $this->voltouContato
                ? "{$this->lead->nome} voltou a entrar em contato · {$nomeServico}"
                : "Novo lead: {$this->lead->nome} · {$nomeServico} (Formulário)",
        );
    }

    public function content(): Content
    {
        $this->lead->loadMissing('origem');

        return new Content(
            markdown: 'emails.novo-lead',
            with: [
                'nomeServico' => config("b2bsafe.servicos.{$this->servico}", $this->servico),
                'whatsappExibicao' => $this->lead->whatsapp ? Telefone::formatar($this->lead->whatsapp) : '—',
                'linkWhatsapp' => $this->lead->whatsapp
                    ? 'https://wa.me/'.ltrim($this->lead->whatsapp, '+').'?text='.rawurlencode('Olá, '.strtok((string) $this->lead->nome, ' ').'! Aqui é da B2BSAFE, recebemos seu contato pelo site.')
                    : WhatsApp::link(),
                'quando' => now()->timezone(config('b2bsafe.fuso_exibicao'))->format('d/m/Y H:i'),
            ],
        );
    }
}
