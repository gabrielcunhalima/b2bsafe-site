<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentTimezone;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Datas gravadas em UTC e exibidas no painel no fuso de São Paulo (RN-020)
        FilamentTimezone::set(config('b2bsafe.fuso_exibicao'));

        // Fora da produção, falha cedo em consultas N+1 e atributos inexistentes
        Model::shouldBeStrict(! $this->app->isProduction());

        // Cliques no WhatsApp: generoso para quem navega, mas barra abuso do endpoint (RN-016)
        RateLimiter::for('cliques-whatsapp', fn (Request $request) => Limit::perMinute(30)->by($request->ip()));
    }
}
