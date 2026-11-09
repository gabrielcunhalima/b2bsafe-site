<?php

use App\Enums\CanalCaptacao;
use App\Enums\StatusLead;
use App\Enums\TipoConsentimento;
use App\Http\Middleware\RegistrarPrimeiroToque;
use App\Mail\NovoLead;
use App\Models\CliqueWhatsapp;
use App\Models\Consentimento;
use App\Models\Lead;
use App\Models\Origem;
use App\Support\PreferenciasCookies;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

// US-007 (#7), US-008 (#8), US-009 (#9), US-010 (#10) e US-011 (#11): captação de leads.

beforeEach(function () {
    Mail::fake();
    RateLimiter::clear('formulario-lead:127.0.0.1');
    config(['b2bsafe.email_leads' => 'leads@b2bsafe.test']);
});

function dadosFormulario(array $extra = []): array
{
    return array_merge([
        'nome' => 'Ana Souza',
        'whatsapp' => '(48) 99999-1234',
        'email' => 'Ana@Empresa.com.br',
        'servico' => 'credito',
        'mensagem' => 'Quero capital de giro.',
        'aceite' => '1',
    ], $extra);
}

function enviarFormulario(array $extra = [])
{
    return test()->postJson(route('leads.store'), dadosFormulario($extra));
}

describe('origem do visitante', function () {
    it('guarda o primeiro toque na sessão sem gravar nada no banco (RN-009)', function () {
        $this->get('/?utm_source=instagram&utm_medium=bio&utm_campaign=lancamento', ['referer' => 'https://l.instagram.com/'])
            ->assertOk()
            ->assertSessionHas('primeiro_toque.utm_source', 'instagram')
            ->assertSessionHas('primeiro_toque.referrer', 'https://l.instagram.com/')
            ->assertSessionHas('visitante_id');

        expect(Origem::count())->toBe(0);
    });

    it('mantém o primeiro toque quando o visitante navega de novo (first-touch, RN-008)', function () {
        $this->get('/?utm_source=google&utm_medium=cpc');
        $this->get('/?utm_source=newsletter&utm_medium=email')
            ->assertSessionHas('primeiro_toque.utm_source', 'google');
    });

    it('só grava o cookie de origem de 90 dias com consentimento estatístico (RN-009)', function () {
        $this->get('/?utm_source=google')->assertCookieMissing(RegistrarPrimeiroToque::COOKIE);

        $this->withCookie(PreferenciasCookies::COOKIE, json_encode(['versao' => config('b2bsafe.versoes.cookies'), 'estatisticos' => true]))
            ->get('/?utm_source=google')
            ->assertCookie(RegistrarPrimeiroToque::COOKIE);
    });

    it('grava a origem classificada quando o visitante vira lead (RN-008, RN-009)', function () {
        $this->get('/?utm_source=instagram&utm_medium=bio');
        enviarFormulario()->assertCreated();

        $lead = Lead::sole();
        expect($lead->origem->canal)->toBe('Campanha (instagram / bio)')
            ->and($lead->origem->utm_source)->toBe('instagram');
    });
});

describe('formulário de lead', function () {
    it('grava o lead como Novo, pelo canal formulário, com o telefone normalizado (RN-001, RN-002)', function () {
        enviarFormulario()
            ->assertCreated()
            ->assertJson(['nome' => 'Ana', 'servico' => 'credito', 'nome_servico' => 'Crédito']);

        $lead = Lead::sole();
        expect($lead->status)->toBe(StatusLead::Novo)
            ->and($lead->canal_captacao)->toBe(CanalCaptacao::Formulario)
            ->and($lead->whatsapp)->toBe('+5548999991234')
            ->and($lead->email)->toBe('ana@empresa.com.br')
            ->and($lead->interacoes)->toHaveCount(1);
    });

    it('exige nome, WhatsApp, e-mail, serviço e o aceite; a mensagem é opcional (RN-001)', function () {
        $this->postJson(route('leads.store'), ['mensagem' => ''])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['nome', 'whatsapp', 'email', 'servico', 'aceite'])
            ->assertJsonMissingValidationErrors(['mensagem']);

        enviarFormulario(['mensagem' => null])->assertCreated();
    });

    it('recusa WhatsApp sem DDD válido com mensagem em português (RN-002)', function () {
        enviarFormulario(['whatsapp' => '99999-12'])
            ->assertJsonValidationErrors(['whatsapp' => 'Informe um celular com DDD, por exemplo (48) 99999-1234.']);
    });

    it('recusa envio sem o aceite da política (RN-011)', function () {
        enviarFormulario(['aceite' => null])
            ->assertJsonValidationErrors(['aceite' => 'Para enviar, aceite a Política de Privacidade.']);

        expect(Lead::count())->toBe(0);
    });

    it('registra o aceite com a versão da política (RN-011)', function () {
        config(['b2bsafe.versoes.politica_privacidade' => '3']);
        enviarFormulario()->assertCreated();

        $consentimento = Lead::sole()->consentimento;
        expect($consentimento->tipo)->toBe(TipoConsentimento::PoliticaFormulario)
            ->and($consentimento->versao_documento)->toBe('3');
    });

    it('recusa serviço fora da lista', function () {
        enviarFormulario(['servico' => 'emprestimo-pessoal'])->assertJsonValidationErrors(['servico']);
    });

    it('finge sucesso e não grava nada quando o robô preenche a armadilha (RN-016)', function () {
        enviarFormulario(['site' => 'http://spam.example'])->assertCreated();

        expect(Lead::count())->toBe(0)->and(Consentimento::count())->toBe(0);
        Mail::assertNothingQueued();
    });

    it('aceita até 5 envios por IP por hora e recusa o sexto (RN-016)', function () {
        foreach (range(1, 5) as $i) {
            enviarFormulario(['email' => "pessoa{$i}@empresa.com.br", 'whatsapp' => "(48) 99999-12{$i}0"])->assertCreated();
        }

        enviarFormulario(['email' => 'sexta@empresa.com.br', 'whatsapp' => '(48) 98888-0000'])
            ->assertTooManyRequests()
            ->assertJsonPath('message', fn ($mensagem) => str_contains($mensagem, 'WhatsApp'));

        expect(Lead::count())->toBe(5);
    });

    it('sem JavaScript, volta para o Fale conosco com a mensagem de sucesso', function () {
        $this->from(route('inicio'))
            ->post(route('leads.store'), dadosFormulario())
            ->assertRedirect(route('inicio').'#contato')
            ->assertSessionHas('lead_enviado.nome', 'Ana');

        $this->get(route('inicio'))->assertSee('Recebemos seu contato');
    });

    it('sem JavaScript, mostra os erros e mantém o que foi digitado', function () {
        $this->from(route('inicio'))
            ->post(route('leads.store'), dadosFormulario(['whatsapp' => '123']))
            ->assertRedirect(route('inicio'))
            ->assertSessionHasErrors('whatsapp');

        $this->get(route('inicio'))
            ->assertSee('Informe um celular com DDD')
            ->assertSee('value="Ana Souza"', escape: false);
    });
});

describe('lead duplicado', function () {
    it('vira nova interação no lead aberto de até 30 dias, pelo mesmo WhatsApp (RN-003)', function () {
        $existente = Lead::factory()->comStatus(StatusLead::EmContato)->create([
            'whatsapp' => '+5548999991234', 'email' => 'outro@empresa.com.br', 'created_at' => now()->subDays(10),
        ]);

        enviarFormulario()->assertCreated();

        expect(Lead::count())->toBe(1)
            ->and($existente->fresh()->voltou_contato_em)->not->toBeNull()
            ->and($existente->interacoes()->count())->toBe(1);
        Mail::assertQueued(NovoLead::class, fn (NovoLead $mail) => $mail->voltouContato && $mail->lead->is($existente));
    });

    it('reconhece o duplicado também pelo e-mail (RN-003)', function () {
        Lead::factory()->create(['whatsapp' => '+5511988887777', 'email' => 'ana@empresa.com.br', 'status' => StatusLead::Novo]);

        enviarFormulario()->assertCreated();

        expect(Lead::count())->toBe(1);
    });

    it('cria lead novo ligado ao anterior quando o existente está fechado (RN-003)', function (StatusLead $status) {
        $anterior = Lead::factory()->comStatus($status)->create(['whatsapp' => '+5548999991234']);

        enviarFormulario()->assertCreated();

        $novo = Lead::latest('id')->first();
        expect(Lead::count())->toBe(2)->and($novo->lead_anterior_id)->toBe($anterior->id);
        Mail::assertQueued(NovoLead::class, fn (NovoLead $mail) => ! $mail->voltouContato);
    })->with([StatusLead::Convertido, StatusLead::Perdido]);

    it('cria lead novo ligado ao anterior quando o existente tem mais de 30 dias (RN-003)', function () {
        $anterior = Lead::factory()->create(['whatsapp' => '+5548999991234', 'status' => StatusLead::Novo, 'created_at' => now()->subDays(31)]);

        enviarFormulario()->assertCreated();

        expect(Lead::count())->toBe(2)->and(Lead::latest('id')->first()->lead_anterior_id)->toBe($anterior->id);
    });

    it('mostra ao visitante a mesma mensagem de sucesso no duplicado (RN-003)', function () {
        Lead::factory()->create(['whatsapp' => '+5548999991234', 'status' => StatusLead::Novo]);

        enviarFormulario()->assertCreated()->assertJson(['nome' => 'Ana']);
    });
});

describe('aviso por e-mail', function () {
    it('envia o e-mail de novo lead pela fila para o destinatário configurado (RF-007)', function () {
        enviarFormulario()->assertCreated();

        Mail::assertQueued(NovoLead::class, fn (NovoLead $mail) => $mail->hasTo('leads@b2bsafe.test') && ! $mail->voltouContato);
    });

    it('não envia e-mail quando não há destinatário configurado', function () {
        config(['b2bsafe.email_leads' => null]);
        enviarFormulario()->assertCreated();

        Mail::assertNothingQueued();
        expect(Lead::count())->toBe(1);
    });

    it('monta o e-mail com os dados, a origem e o link do WhatsApp do lead (RF-007)', function () {
        $this->get('/?utm_source=instagram&utm_medium=bio');
        enviarFormulario()->assertCreated();

        $mail = new NovoLead(Lead::sole(), false, 'Quero capital de giro.', 'credito');

        $mail->assertHasSubject('Novo lead: Ana Souza · Crédito (Formulário)');
        $mail->assertSeeInHtml('(48) 99999-1234');
        $mail->assertSeeInHtml('Campanha (instagram / bio)');
        $mail->assertSeeInHtml('https://wa.me/5548999991234');
        $mail->assertSeeInHtml('Quero capital de giro.');
    });

    it('usa o assunto "voltou a entrar em contato" no duplicado (RN-003)', function () {
        $lead = Lead::factory()->create(['nome' => 'Ana Souza']);

        (new NovoLead($lead, true, null, 'credito'))->assertHasSubject('Ana Souza voltou a entrar em contato · Crédito');
    });
});

describe('clique no WhatsApp', function () {
    it('registra o clique com página, serviço e origem, sem criar lead (RN-010)', function () {
        $this->get('/?gclid=abc123');

        $this->post(route('whatsapp.clique'), ['numero' => '5511984205023', 'pagina' => '/#home', 'servico' => 'credito'])
            ->assertNoContent();

        $clique = CliqueWhatsapp::sole();
        expect($clique->servico)->toBe('credito')
            ->and($clique->pagina)->toBe('/#home')
            ->and($clique->origem->canal)->toBe('Google Ads')
            ->and(Lead::count())->toBe(0);
    });

    it('reaproveita a mesma origem na mesma sessão', function () {
        $this->get('/');
        $this->post(route('whatsapp.clique'), ['numero' => '5511984205023']);
        $this->post(route('whatsapp.clique'), ['numero' => '5511924600991', 'servico' => 'maquininha']);

        expect(CliqueWhatsapp::count())->toBe(2)->and(Origem::count())->toBe(1);
    });

    it('recusa número que não é do site', function () {
        $this->postJson(route('whatsapp.clique'), ['numero' => '5511900000000'])->assertJsonValidationErrors('numero');

        expect(CliqueWhatsapp::count())->toBe(0);
    });
});
