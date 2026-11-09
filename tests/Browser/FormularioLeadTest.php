<?php

use App\Models\Lead;
use Illuminate\Support\Facades\Mail;

// US-008 (#8): formulário de lead no navegador (wireframe T-03).

beforeEach(fn () => Mail::fake());

it('mostra o resumo de erros e foca nele ao enviar vazio', function () {
    visit('/#contato')
        ->click('#contato button[type="submit"]')
        ->assertSee('Corrija 5 campos para enviar:')
        ->assertScript('document.activeElement.getAttribute("role")', 'alert')
        ->assertAttribute('#lead-whatsapp', 'aria-invalid', 'true');

    expect(Lead::count())->toBe(0);
});

it('envia sem recarregar e troca o formulário pela mensagem de sucesso', function () {
    visit('/#contato')
        ->type('#lead-nome', 'Ana Souza')
        ->type('#lead-whatsapp', '48999991234')
        ->assertValue('#lead-whatsapp', '(48) 99999-1234')
        ->type('#lead-email', 'ana@empresa.com.br')
        ->select('#lead-servico', 'credito')
        ->check('#lead-aceite')
        ->click('#contato button[type="submit"]')
        ->assertSee('Recebemos seu contato, Ana!')
        ->assertSee('Crédito')
        ->assertNoSmoke();

    expect(Lead::sole()->whatsapp)->toBe('+5548999991234');
});

it('escolhe "Parceria" no formulário ao clicar em "Quero ser parceiro"', function () {
    visit('/')
        ->click('Quero ser parceiro')
        ->assertValue('#lead-servico', 'parceria');
});

it('marca o aceite com um clique logo depois de corrigir um campo com erro', function () {
    visit('/#contato')
        ->click('#contato button[type="submit"]')
        ->type('#lead-nome', 'Ana Souza')
        ->type('#lead-whatsapp', '48999991234')
        ->type('#lead-email', 'ana@empresa.com.br')
        ->select('#lead-servico', 'credito')
        ->check('#lead-aceite')
        ->assertChecked('#lead-aceite');
});
