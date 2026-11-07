<?php

use App\Http\Controllers\SaudeController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'paginas.inicio')->name('inicio');

Route::get('/saude', SaudeController::class)->name('saude');
