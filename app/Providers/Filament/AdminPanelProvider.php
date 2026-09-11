<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Login;
use App\Filament\Pages\Dashboard;
use App\Filament\Widgets\ContentHealthWidget;
use App\Filament\Widgets\DashboardHeroWidget;
use App\Filament\Widgets\LatestContactMessagesWidget;
use App\Filament\Widgets\PortfolioStatsOverview;
use App\Filament\Widgets\RecentActivityWidget;
use App\Filament\Widgets\RecentProjectsWidget;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
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
            ->login(Login::class)
            ->brandName('ZEPHYR ADMIN')
            ->navigationGroups([
                'PORTFOLIO',
                'BACKGROUND',
                'SYSTEM',
            ])
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
                PanelsRenderHook::HEAD_START,
                fn (): string => Blade::render('
                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
                    @vite("resources/css/app.css")
                ')
            )
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => Blade::render('
                    <style>
                        :root, .dark {
                            --brand-bg: #080808;
                            --brand-sidebar: #0B0A09;
                            --brand-surface: #0E0D0C;
                            --brand-card: #151311;
                            --brand-card-hover: #1A1714;
                            --brand-border: #2A2520;
                            --brand-orange: #C45A19;
                            --brand-orange-hover: #E47A2E;
                            --brand-text: #F5F1EA;
                            --brand-muted: #9E958B;
                            --font-sans: "Inter", -apple-system, BlinkMacSystemFont, sans-serif;
                            --font-heading: "Space Grotesk", sans-serif;
                            --font-mono: "JetBrains Mono", monospace;
                        }

                        /* Global base & typography */
                        body, .fi-body, .fi-layout {
                            background-color: #080808 !important;
                            color: #F5F1EA !important;
                            font-family: var(--font-sans) !important;
                            overflow-x: hidden !important;
                        }

                        h1, h2, h3, .fi-header-heading, .fi-section-header-heading, .fi-ta-header-heading {
                            font-family: var(--font-heading) !important;
                            color: #F5F1EA !important;
                            letter-spacing: -0.02em !important;
                        }

                        /* Sidebar styling */
                        .fi-sidebar, aside.fi-sidebar {
                            background-color: #0B0A09 !important;
                            border-right: 1px solid #2A2520 !important;
                        }

                        .fi-sidebar-header {
                            border-bottom: 1px solid #2A2520 !important;
                        }

                        .fi-sidebar-group-label {
                            font-family: var(--font-mono) !important;
                            font-size: 0.65rem !important;
                            font-weight: 700 !important;
                            letter-spacing: 0.1em !important;
                            color: #9E958B !important;
                            text-transform: uppercase !important;
                        }

                        .fi-sidebar-item-button {
                            color: #9E958B !important;
                            transition: all 0.15s ease !important;
                            border-radius: 0.5rem !important;
                        }

                        .fi-sidebar-item-button:hover {
                            background-color: #151311 !important;
                            color: #F5F1EA !important;
                        }

                        .fi-sidebar-item-active .fi-sidebar-item-button {
                            background-color: rgba(196, 90, 25, 0.12) !important;
                            color: #F5F1EA !important;
                            border-left: 3px solid #C45A19 !important;
                            border-radius: 0 0.5rem 0.5rem 0 !important;
                            font-weight: 600 !important;
                        }

                        .fi-sidebar-item-active .fi-sidebar-item-icon {
                            color: #E47A2E !important;
                        }

                        /* Topbar styling */
                        .fi-topbar, header.fi-topbar {
                            background-color: #0E0D0C !important;
                            border-bottom: 1px solid #2A2520 !important;
                        }

                        /* Sections & Cards */
                        .fi-section, .fi-widget, .fi-modal-window {
                            background-color: #151311 !important;
                            border-color: #2A2520 !important;
                            border-radius: 1rem !important;
                        }

                        /* Stats cards */
                        .fi-wi-stats-overview-stat {
                            background-color: #151311 !important;
                            border: 1px solid #2A2520 !important;
                            border-radius: 1rem !important;
                            transition: all 0.2s ease !important;
                        }

                        .fi-wi-stats-overview-stat:hover {
                            background-color: #1A1714 !important;
                            border-color: #3D352E !important;
                        }

                        .fi-wi-stats-overview-stat-label {
                            font-family: var(--font-mono) !important;
                            font-size: 0.7rem !important;
                            letter-spacing: 0.08em !important;
                            color: #9E958B !important;
                            text-transform: uppercase !important;
                        }

                        .fi-wi-stats-overview-stat-value {
                            font-family: var(--font-heading) !important;
                            font-weight: 700 !important;
                            color: #F5F1EA !important;
                        }

                        /* Tables */
                        .fi-ta-ctn {
                            background-color: #151311 !important;
                            border: 1px solid #2A2520 !important;
                            border-radius: 1rem !important;
                            overflow: hidden !important;
                        }

                        .fi-ta-header-cell {
                            background-color: #0E0D0C !important;
                            font-family: var(--font-mono) !important;
                            font-size: 0.72rem !important;
                            letter-spacing: 0.05em !important;
                            color: #9E958B !important;
                            text-transform: uppercase !important;
                            border-bottom: 1px solid #2A2520 !important;
                        }

                        .fi-ta-row {
                            border-color: #2A2520 !important;
                            transition: background-color 0.15s ease !important;
                        }

                        .fi-ta-row:hover {
                            background-color: #1A1714 !important;
                        }

                        /* Inputs & form elements */
                        .fi-input-wrp {
                            background-color: #0E0D0C !important;
                            border-color: #2A2520 !important;
                            border-radius: 0.625rem !important;
                            color: #F5F1EA !important;
                        }

                        .fi-input-wrp:focus-within {
                            border-color: #C45A19 !important;
                            box-shadow: 0 0 0 1px #C45A19 !important;
                        }

                        /* Buttons */
                        .fi-btn-primary, button[type="submit"].fi-btn {
                            background-color: #C45A19 !important;
                            color: #F5F1EA !important;
                            font-family: var(--font-mono) !important;
                            font-size: 0.8rem !important;
                            font-weight: 600 !important;
                            letter-spacing: 0.04em !important;
                            border-radius: 0.625rem !important;
                            transition: all 0.2s ease !important;
                        }

                        .fi-btn-primary:hover, button[type="submit"].fi-btn:hover {
                            background-color: #E47A2E !important;
                            box-shadow: 0 0 16px rgba(196, 90, 25, 0.35) !important;
                        }

                        /* Badges */
                        .fi-badge {
                            font-family: var(--font-mono) !important;
                            font-size: 0.68rem !important;
                            letter-spacing: 0.05em !important;
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
                DashboardHeroWidget::class,
                PortfolioStatsOverview::class,
                RecentProjectsWidget::class,
                ContentHealthWidget::class,
                RecentActivityWidget::class,
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
