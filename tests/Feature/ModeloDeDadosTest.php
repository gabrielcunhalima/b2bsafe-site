<?php

use App\Enums\CanalCaptacao;
use App\Enums\MotivoPerda;
use App\Enums\PapelMensagem;
use App\Enums\PerfilUsuario;
use App\Enums\StatusLead;
use App\Enums\TipoConsentimento;
use App\Enums\TipoInteracao;
use App\Models\CacheGa4;
use App\Models\CliqueWhatsapp;
use App\Models\Consentimento;
use App\Models\Lead;
use App\Models\LogAuditoria;
use App\Models\Origem;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
 * Confere que migrations, chaves estrangeiras, relações e casts do docs/06-modelo-de-dados.md batem entre si.
 */

it('monta um lead completo com todas as relações do modelo', function () {
    $usuario = Usuario::factory()->create();
    $origem = Origem::factory()->googleAds()->create();
    $consentimento = Consentimento::create([
        'visitante_id' => (string) Str::uuid(),
        'tipo' => TipoConsentimento::PoliticaFormulario,
        'versao_documento' => '1',
        'categorias' => ['necessarios', 'estatisticos'],
    ]);
    $anterior = Lead::factory()->comStatus(StatusLead::Convertido)->create();

    $lead = Lead::factory()->create([
        'canal_captacao' => CanalCaptacao::Formulario,
        'origem_id' => $origem->id,
        'consentimento_id' => $consentimento->id,
        'lead_anterior_id' => $anterior->id,
    ]);
    $lead->interacoes()->create(['tipo' => TipoInteracao::Formulario, 'conteudo' => 'Quero crédito']);
    $lead->historicoStatus()->create(['usuario_id' => $usuario->id, 'status_anterior' => StatusLead::Novo, 'status_novo' => StatusLead::EmContato]);
    $lead->anotacoes()->create(['usuario_id' => $usuario->id, 'texto' => 'Ligar amanhã']);

    $conversa = $lead->conversas()->create(['origem_id' => $origem->id, 'consentimento_id' => $consentimento->id, 'pagina_inicial' => '/']);
    $conversa->mensagens()->create(['papel' => PapelMensagem::Visitante, 'conteudo' => 'meu CPF é ***.***.***-**']);
    $clique = CliqueWhatsapp::create(['numero' => '5511984205023', 'pagina' => '/', 'origem_id' => $origem->id, 'conversa_id' => $conversa->id, 'lead_id' => $lead->id]);

    $lead->refresh();
    $conversa->refresh();

    expect($lead->origem->is($origem))->toBeTrue()
        ->and($lead->consentimento->categorias)->toBe(['necessarios', 'estatisticos'])
        ->and($lead->leadAnterior->is($anterior))->toBeTrue()
        ->and($lead->status)->toBe(StatusLead::Novo)
        ->and($lead->interacoes->first()->tipo)->toBe(TipoInteracao::Formulario)
        ->and($lead->interacoes->first()->lead->is($lead))->toBeTrue()
        ->and($lead->historicoStatus->first()->status_novo)->toBe(StatusLead::EmContato)
        ->and($lead->historicoStatus->first()->usuario->is($usuario))->toBeTrue()
        ->and($lead->historicoStatus->first()->lead->is($lead))->toBeTrue()
        ->and($lead->anotacoes->first()->usuario->is($usuario))->toBeTrue()
        ->and($lead->anotacoes->first()->lead->is($lead))->toBeTrue()
        ->and($lead->cliquesWhatsapp->first()->is($clique))->toBeTrue()
        ->and($lead->estaAnonimizado())->toBeFalse();

    expect(Str::isUuid($conversa->id))->toBeTrue()
        ->and($conversa->lead->is($lead))->toBeTrue()
        ->and($conversa->origem->is($origem))->toBeTrue()
        ->and($conversa->consentimento->is($consentimento))->toBeTrue()
        ->and($conversa->transbordo)->toBeFalse()
        ->and($conversa->mensagens->first()->papel)->toBe(PapelMensagem::Visitante)
        ->and($conversa->mensagens->first()->conversa->is($conversa))->toBeTrue();

    expect($clique->origem->is($origem))->toBeTrue()
        ->and($clique->conversa->is($conversa))->toBeTrue()
        ->and($clique->lead->is($lead))->toBeTrue()
        ->and($origem->leads)->toHaveCount(1)
        ->and($origem->conversas)->toHaveCount(1)
        ->and($origem->cliquesWhatsapp)->toHaveCount(1)
        ->and($usuario->anotacoes)->toHaveCount(1)
        ->and($usuario->historicoStatus)->toHaveCount(1);
});

it('guarda o motivo de perda como enum (RN-006)', function () {
    $lead = Lead::factory()->comStatus(StatusLead::Perdido)->create();

    expect($lead->fresh()->motivo_perda)->toBe(MotivoPerda::SemRetorno);
});

it('registra log de auditoria e cache do GA4 com dados em JSON', function () {
    $usuario = Usuario::factory()->administrador()->create();
    $log = LogAuditoria::create(['usuario_id' => $usuario->id, 'acao' => 'exportacao_csv', 'detalhes' => ['quantidade' => 38]]);
    $cache = CacheGa4::create(['relatorio' => 'sessoes_por_canal', 'periodo' => '30d', 'dados' => ['organic' => 10], 'atualizado_em' => now()]);

    expect($log->fresh()->detalhes)->toBe(['quantidade' => 38])
        ->and($log->usuario->is($usuario))->toBeTrue()
        ->and($cache->fresh()->dados)->toBe(['organic' => 10])
        ->and($cache->fresh()->atualizado_em)->not->toBeNull();
});

it('grava a senha do usuário com hash na coluna senha, inclusive pelo campo password do Filament', function () {
    $usuario = Usuario::factory()->administrador()->create(['senha' => 'frase-secreta-longa']);

    expect(Hash::check('frase-secreta-longa', $usuario->senha))->toBeTrue()
        ->and($usuario->getAuthPassword())->toBe($usuario->senha)
        ->and($usuario->ehAdministrador())->toBeTrue()
        ->and($usuario->perfil)->toBe(PerfilUsuario::Administrador)
        ->and($usuario->getFilamentName())->toBe($usuario->nome);

    $usuario->update(['password' => Hash::make('outra-frase-secreta')]);

    expect(Hash::check('outra-frase-secreta', $usuario->fresh()->senha))->toBeTrue();
});
