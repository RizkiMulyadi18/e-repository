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

            ->font('Plus Jakarta Sans')
            // --- 2. CSS CUSTOM NEOBRUTALISM (Saweria Style) ---
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn(): string => Blade::render(<<<HTML
                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
                    <style>
                        /* Neobrutalism Admin Theme (Saweria Aesthetic) */
                        :root {
                            --brutal-yellow: #FFE600;
                            --brutal-yellow-hover: #F0D800;
                            --brutal-coral: #FF6B6B;
                            --brutal-mint: #4ECCA3;
                            --brutal-sky: #7DD3FC;
                            --brutal-lavender: #D8B4FE;
                            --brutal-cream: #FAF7EE;
                            --brutal-cream-light: #FFFDF7;
                        }

                        body, .fi-body {
                            background-color: var(--brutal-cream) !important;
                            font-family: 'Plus Jakarta Sans', sans-serif !important;
                            color: #121212 !important;
                        }

                        /* 1. TOPBAR */
                        .fi-topbar {
                            background-color: var(--brutal-cream-light) !important;
                            border-bottom: 3px solid #000000 !important;
                            box-shadow: 0 3px 0px #000000 !important;
                        }

                        /* 2. SIDEBAR */
                        aside.fi-sidebar {
                            background-color: var(--brutal-cream-light) !important;
                            border-right: 3px solid #000000 !important;
                        }

                        .fi-sidebar-header {
                            border-bottom: 2px solid #000000 !important;
                            padding-bottom: 1rem !important;
                        }

                        .fi-sidebar-group-label span {
                            font-size: 0.75rem !important;
                            font-weight: 900 !important;
                            text-transform: uppercase !important;
                            letter-spacing: 0.05em !important;
                            color: #000000 !important;
                        }

                        /* Sidebar Items */
                        .fi-sidebar-item-btn {
                            border: 2px solid transparent !important;
                            border-radius: 12px !important;
                            margin-bottom: 4px !important;
                            padding: 0.6rem 0.85rem !important;
                            transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1) !important;
                        }

                        .fi-sidebar-item-label {
                            font-size: 0.95rem !important;
                            font-weight: 700 !important;
                        }

                        .fi-sidebar-item-btn:hover {
                            background-color: #FAF7EE !important;
                            border-color: #000000 !important;
                            transform: translate(-1px, -1px) !important;
                            box-shadow: 3px 3px 0px #000000 !important;
                            color: #000000 !important;
                        }

                        .fi-sidebar-item-active .fi-sidebar-item-btn,
                        .fi-sidebar-item-btn[aria-current="page"] {
                            background-color: var(--brutal-yellow) !important;
                            color: #000000 !important;
                            border: 2px solid #000000 !important;
                            box-shadow: 3px 3px 0px #000000 !important;
                            font-weight: 800 !important;
                            transform: translate(-1px, -1px) !important;
                        }

                        /* 3. WIDGETS & STAT CARDS */
                        .fi-wi-stats-overview-stat {
                            background-color: #FFFFFF !important;
                            border: 3px solid #000000 !important;
                            border-radius: 18px !important;
                            box-shadow: 5px 5px 0px #000000 !important;
                            transition: all 0.2s ease !important;
                            padding: 1.25rem !important;
                        }

                        .fi-wi-stats-overview-stat:hover {
                            transform: translate(-2px, -2px) !important;
                            box-shadow: 7px 7px 0px #000000 !important;
                        }

                        .fi-wi-stats-overview-stat-value {
                            font-size: 2rem !important;
                            font-weight: 900 !important;
                            color: #000000 !important;
                        }

                        .fi-wi-stats-overview-stat-label {
                            font-weight: 800 !important;
                            text-transform: uppercase !important;
                            font-size: 0.8rem !important;
                            letter-spacing: 0.05em !important;
                        }

                        /* 4. TABLES */
                        .fi-ta-ctn, .fi-ta {
                            border: 3px solid #000000 !important;
                            border-radius: 20px !important;
                            box-shadow: 6px 6px 0px #000000 !important;
                            background-color: #FFFFFF !important;
                            overflow: hidden !important;
                        }

                        .fi-ta-header {
                            background-color: var(--brutal-cream-light) !important;
                            border-bottom: 2px solid #000000 !important;
                            padding: 1rem 1.25rem !important;
                        }

                        .fi-ta-header-heading {
                            font-size: 1.25rem !important;
                            font-weight: 900 !important;
                            color: #000000 !important;
                        }

                        thead th.fi-ta-header-cell {
                            background-color: var(--brutal-cream) !important;
                            border-bottom: 2px solid #000000 !important;
                            font-weight: 900 !important;
                            text-transform: uppercase !important;
                            font-size: 0.75rem !important;
                            color: #000000 !important;
                        }

                        tbody tr.fi-ta-row {
                            border-bottom: 1.5px solid #EEEEEE !important;
                            transition: background-color 0.15s ease !important;
                        }

                        tbody tr.fi-ta-row:hover {
                            background-color: #FFFDF5 !important;
                        }

                        /* 5. FORM SECTIONS & CARDS */
                        .fi-section {
                            border: 3px solid #000000 !important;
                            border-radius: 20px !important;
                            box-shadow: 6px 6px 0px #000000 !important;
                            background-color: #FFFFFF !important;
                            overflow: hidden !important;
                        }

                        .fi-section-header {
                            background-color: var(--brutal-cream-light) !important;
                            border-bottom: 2px solid #000000 !important;
                            padding: 1rem 1.25rem !important;
                        }

                        .fi-section-header-heading {
                            font-weight: 900 !important;
                            font-size: 1.15rem !important;
                            color: #000000 !important;
                        }

                        /* 6. INPUTS & SELECTS */
                        .fi-input-wrp {
                            border: 2px solid #000000 !important;
                            border-radius: 12px !important;
                            box-shadow: 2px 2px 0px #000000 !important;
                            background-color: #FFFFFF !important;
                            transition: all 0.15s ease !important;
                        }

                        .fi-input-wrp:focus-within {
                            box-shadow: 4px 4px 0px #000000 !important;
                            transform: translate(-1px, -1px) !important;
                            border-color: #000000 !important;
                            outline: none !important;
                        }

                        /* 7. BUTTONS */
                        .fi-btn {
                            border: 2px solid #000000 !important;
                            border-radius: 12px !important;
                            font-weight: 800 !important;
                            text-transform: uppercase !important;
                            font-size: 0.8rem !important;
                            letter-spacing: 0.03em !important;
                            transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1) !important;
                        }

                        /* Primary Buttons (Yellow Saweria) */
                        .fi-btn-color-primary,
                        .fi-btn-color-amber {
                            background-color: var(--brutal-yellow) !important;
                            color: #000000 !important;
                            box-shadow: 3px 3px 0px #000000 !important;
                        }

                        .fi-btn-color-primary:hover,
                        .fi-btn-color-amber:hover {
                            background-color: var(--brutal-yellow-hover) !important;
                            transform: translate(-1px, -1px) !important;
                            box-shadow: 5px 5px 0px #000000 !important;
                        }

                        .fi-btn-color-primary:active,
                        .fi-btn-color-amber:active {
                            transform: translate(1px, 1px) !important;
                            box-shadow: 1px 1px 0px #000000 !important;
                        }

                        /* Danger Buttons (Coral Pink) */
                        .fi-btn-color-danger,
                        .fi-btn-color-red {
                            background-color: var(--brutal-coral) !important;
                            color: #FFFFFF !important;
                            box-shadow: 3px 3px 0px #000000 !important;
                        }

                        .fi-btn-color-danger:hover,
                        .fi-btn-color-red:hover {
                            transform: translate(-1px, -1px) !important;
                            box-shadow: 5px 5px 0px #000000 !important;
                        }

                        /* Gray / Secondary Buttons */
                        .fi-btn-color-gray,
                        .fi-btn-color-neutral {
                            background-color: #FFFFFF !important;
                            color: #000000 !important;
                            box-shadow: 2px 2px 0px #000000 !important;
                        }

                        .fi-btn-color-gray:hover,
                        .fi-btn-color-neutral:hover {
                            background-color: var(--brutal-cream) !important;
                            transform: translate(-1px, -1px) !important;
                            box-shadow: 4px 4px 0px #000000 !important;
                        }

                        /* Success Buttons (Mint) */
                        .fi-btn-color-success,
                        .fi-btn-color-emerald {
                            background-color: var(--brutal-mint) !important;
                            color: #000000 !important;
                            box-shadow: 3px 3px 0px #000000 !important;
                        }

                        /* 8. BADGES */
                        .fi-badge {
                            border: 1.5px solid #000000 !important;
                            border-radius: 8px !important;
                            font-weight: 800 !important;
                            box-shadow: 2px 2px 0px #000000 !important;
                        }

                        /* 9. MODALS & DROPDOWNS */
                        .fi-modal-window,
                        .fi-dropdown-panel {
                            border: 3px solid #000000 !important;
                            border-radius: 20px !important;
                            box-shadow: 8px 8px 0px #000000 !important;
                            background-color: #FFFFFF !important;
                            overflow: hidden !important;
                        }

                        /* 10. PAGINATION */
                        .fi-pagination-item {
                            border: 1.5px solid #000000 !important;
                            border-radius: 10px !important;
                            font-weight: 800 !important;
                            box-shadow: 2px 2px 0px #000000 !important;
                            background-color: #FFFFFF !important;
                        }

                        .fi-pagination-item-active {
                            background-color: var(--brutal-yellow) !important;
                            color: #000000 !important;
                        }

                        /* 11. LOGIN & SIMPLE PAGES */
                        .fi-simple-main {
                            background-color: #FFFFFF !important;
                            border: 4px solid #000000 !important;
                            border-radius: 24px !important;
                            box-shadow: 8px 8px 0px #000000 !important;
                            padding: 2rem !important;
                        }

                        .fi-simple-page {
                            background-color: var(--brutal-cream) !important;
                        }

                        /* Main Content Container Spacing */
                        .fi-main {
                            padding: 1.5rem 2rem !important;
                            max-width: 100% !important;
                        }

                        .fi-header-heading {
                            font-size: 1.75rem !important;
                            font-weight: 900 !important;
                            letter-spacing: -0.02em !important;
                            color: #000000 !important;
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
