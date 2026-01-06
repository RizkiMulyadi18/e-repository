<?php

namespace App\Providers\Filament;

use App\Settings\GeneralSettings;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors(fn(GeneralSettings $settings) => [
                'primary' => match ($settings->theme_color) {
                    'danger'  => Color::Red,      // Jika pilih Merah
                    'success' => Color::Emerald,  // Jika pilih Hijau
                    'warning' => Color::Amber,    // Jika pilih Kuning
                    default   => Color::Indigo,   // Default Biru
                },
            ])
            // --- 1. SETTING DINAMIS (Nama & Logo dari Database) ---
            ->brandName(fn(GeneralSettings $settings) => $settings->site_name)
            ->favicon(fn(GeneralSettings $settings) => $settings->site_logo ? asset('storage/' . $settings->site_logo) : null)
            // -----------------------------------------------------

            ->globalSearch(false) // Pilihan Anda tadi

            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])

            // --- 2. CSS CUSTOM (Layout Rapi & Full Width) ---
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn(): string => Blade::render(<<<HTML
                    <style>
                        /* Memperbesar Teks & Padding Menu Sidebar */
                        .fi-sidebar-item-label {
                            font-size: 1.1rem !important;
                            font-weight: 600 !important;
                        }
                        .fi-sidebar-item-btn {
                            padding-top: 0.75rem !important;
                            padding-bottom: 0.75rem !important;
                        }
                        
                        /* Menghapus Garis Batas Sidebar */
                        aside.fi-sidebar {
                            border-right: none !important;
                        }

                        /* Menggeser Tabel ke Kiri (Mengurangi Jarak Kosong) */
                        .fi-main {
                            padding-left: 0.5rem !important;
                            padding-right: 1rem !important;
                        }

                        /* Memaksa Konten Selebar Mungkin */
                        .fi-section, .fi-header {
                            max-width: 100% !important;
                        }
                    </style>
                HTML)
            )

            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
