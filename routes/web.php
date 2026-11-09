<?php

use App\Http\Controllers\CliqueWhatsappController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PreferenciasCookiesController;
use App\Http\Controllers\SaudeController;
use App\Http\Middleware\RegistrarPrimeiroToque;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;

// Páginas públicas: guardam o primeiro toque do visitante para a atribuição de origem (RN-008, RN-009)
Route::middleware(RegistrarPrimeiroToque::class)->group(function () {
    Route::view('/', 'paginas.inicio')->name('inicio');
    Route::view('/maquininha', 'paginas.maquininha')->name('maquininha');
    Route::view('/privacidade', 'paginas.privacidade')->name('privacidade');
    Route::view('/policy', 'paginas.policy')->name('policy');
});

// Link quebrado do site antigo: "/policy." (com ponto) vai para /policy (RF-004)
Route::permanentRedirect('/policy.', '/policy');

// Formulário de lead (RF-006); o limite de 5 envios por hora fica no controller (RN-016)
Route::post('/contato', [LeadController::class, 'store'])->name('leads.store');

// Clique no WhatsApp (RF-005, RN-010), enviado por sendBeacon
Route::post('/whatsapp/clique', CliqueWhatsappController::class)
    ->middleware('throttle:cliques-whatsapp')
    ->name('whatsapp.clique');

// Escolha do banner de cookies (RF-009, RN-011)
Route::post('/cookies/preferencias', PreferenciasCookiesController::class)
    ->middleware('throttle:cliques-whatsapp')
    ->name('cookies.preferencias');

// Sem sessão nem cookies: a sessão fica no banco, e o health check precisa responder 503 (não 500) quando o banco cai.
Route::get('/saude', SaudeController::class)
    ->withoutMiddleware([StartSession::class, ShareErrorsFromSession::class, PreventRequestForgery::class, EncryptCookies::class, AddQueuedCookiesToResponse::class])
    ->name('saude');
