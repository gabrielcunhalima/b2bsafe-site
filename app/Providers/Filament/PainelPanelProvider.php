<?php

namespace App\Providers\Filament;

use App\Http\Middleware\NaoIndexar;
use Filament\FontProviders\LocalFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

/**
 * Área restrita em /painel (ADR-002): atendentes e administradores.
 */
class PainelPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('painel')
            ->path('painel')
            ->login()
            ->passwordReset()
            ->brandName('B2BSAFE')
            // Amarelo do logo; a fonte Urbanist vem do tema (sem serviço externo de fontes)
            ->colors([
                'primary' => Color::hex('#FFCC29'),
                'gray' => Color::Zinc,
            ])
            ->font('Urbanist Variable', provider: LocalFontProvider::class)
            ->viteTheme('resources/css/filament/painel/theme.css')
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                // Área restrita fora dos buscadores (RF-011)
                NaoIndexar::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
