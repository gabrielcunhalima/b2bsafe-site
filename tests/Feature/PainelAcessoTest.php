<?php

use App\Models\Usuario;

it('mostra a tela de login do painel', function () {
    $this->get('/painel/login')->assertOk();
});

it('redireciona visitante sem login para a tela de login', function () {
    $this->get('/painel')->assertRedirect('/painel/login');
});

it('deixa usuário ativo entrar no painel', function () {
    $this->actingAs(Usuario::factory()->create())
        ->get('/painel')
        ->assertOk();
});

it('bloqueia usuário desativado (RF-018)', function () {
    $this->actingAs(Usuario::factory()->inativo()->create())
        ->get('/painel')
        ->assertForbidden();
});
