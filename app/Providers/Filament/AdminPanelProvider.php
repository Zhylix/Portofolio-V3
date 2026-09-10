<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\LatestContactMessagesWidget;
use App\Filament\Widgets\PortfolioStatsOverview;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
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
            ->brandName('ZEPHYR ADMIN')
            ->colors([
                'primary' => [
                    50 => '#fdf6f0',
                    100 => '#fbe9dc',
                    200 => '#f7d3b8',
                    300 => '#f2b58c',
                    400 => '#e47a2e',
                    500 => '#c45a19',
                    600 => '#a84712',
                    700 => '#87360f',
                    800 => '#6b2c12',
                    900 => '#562512',
                    950 => '#301107',
                ],
                'gray' => [
                    50 => '#f5f1ea',
                    100 => '#e5dfd4',
                    200 => '#c9beaf',
                    300 => '#9e958b',
                    400 => '#70685f',
                    500 => '#544d46',
                    600 => '#3d352e',
                    700 => '#2a2520',
                    800 => '#151311',
                    900 => '#0e0d0c',
                    950 => '#080808',
                ],
            ])
            ->darkMode(true, isForced: true)
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => Blade::render('
                    <style>
                        :root, .dark {
                            --brand-bg: #080808;
                            --brand-charcoal: #0E0D0C;
                            --brand-surface: #151311;
                            --brand-border: #2A2520;
                            --brand-orange: #C45A19;
                            --brand-orange-light: #E47A2E;
                            --brand-text: #F5F1EA;
                        }
                        body, .fi-body {
                            background-color: #080808 !important;
                            color: #F5F1EA !important;
                        }
                        .fi-sidebar, aside.fi-sidebar {
                            background-color: #0E0D0C !important;
                            border-right-color: #2A2520 !important;
                        }
                        .fi-topbar, header.fi-topbar {
                            background-color: #0E0D0C !important;
                            border-bottom-color: #2A2520 !important;
                        }
                        .fi-section, .fi-widget, .fi-ta-ctn, .fi-modal-window {
                            background-color: #151311 !important;
                            border-color: #2A2520 !important;
                        }
                        .fi-sidebar-group-label {
                            letter-spacing: 0.08em;
                            font-weight: 700 !important;
                            font-size: 0.7rem !important;
                            color: #C45A19 !important;
                        }
                        .fi-sidebar-item-active .fi-sidebar-item-button {
                            background-color: #1E1A17 !important;
                            color: #E47A2E !important;
                        }
                        .fi-sidebar-item-button:hover {
                            background-color: #151311 !important;
                        }
                    </style>
                ')
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                PortfolioStatsOverview::class,
                LatestContactMessagesWidget::class,
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
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
