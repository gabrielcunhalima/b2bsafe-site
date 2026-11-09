<?php

use App\Http\Controllers\SaudeController;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;

Route::view('/', 'paginas.inicio')->name('inicio');

// Sem sessão nem cookies: a sessão fica no banco, e o health check precisa responder 503 (não 500) quando o banco cai.
Route::get('/saude', SaudeController::class)
    ->withoutMiddleware([StartSession::class, ShareErrorsFromSession::class, PreventRequestForgery::class, EncryptCookies::class, AddQueuedCookiesToResponse::class])
    ->name('saude');
