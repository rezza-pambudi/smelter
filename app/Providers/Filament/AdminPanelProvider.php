<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationItem;
use App\Filament\Pages\HomePageSettings;
use App\Filament\Resources\PageResource;
use Filament\Navigation\NavigationGroup;
use App\Filament\Resources\BrandResource;
use App\Filament\Resources\ResultResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Navigation\NavigationBuilder;
use App\Filament\Resources\CategoryResource;
use App\Filament\Resources\ManageUserResource;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use App\Filament\Resources\RequestDesignResource;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use App\Filament\Resources\UserResource;
use Filament\Pages\Dashboard;
use Filament\Notifications\Livewire\DatabaseNotifications;
use Althinect\FilamentSpatieRolesPermissions\Middleware\SyncSpatiePermissionsWithFilamentTenants;
use App\Filament\Auth\Register;
use App\Filament\Pages\Request;
use App\Models\Roles;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        DatabaseNotifications::trigger('filament.notifications.database-notifications-trigger');

        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->registration(Register::class)
            ->passwordReset()
            ->emailVerification()
            ->plugin(
                FilamentSpatieRolesPermissionsPlugin::make()
            )
            ->profile()
            ->sidebarCollapsibleOnDesktop(true)
            ->colors([
                'primary' => Color::Purple,

            ])
            ->font('Poppins')
            ->favicon(url: '/images/logo/favicon.png')
            ->darkMode(condition: true)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Request::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,

            ])
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
            ])
            ->tenantMiddleware([
                SyncSpatiePermissionsWithFilamentTenants::class,
            ], isPersistent: true)
            ->navigationGroups([
                'Design Management',
                'Roles and Permissions',
                'Settings',
            ])
            // ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
            //     return $builder->groups([
            //         NavigationGroup::make()
            //             ->items([
            //                 NavigationItem::make('Dashboard')
            //                     ->icon('heroicon-o-home')
            //                     ->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.pages.dashboard'))
            //                     ->url(fn (): string => Dashboard::getUrl()),
            //                 NavigationItem::make('Request')
            //                     ->icon('heroicon-o-star')
            //                     ->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.pages.request'))
            //                     ->url(fn (): string => Request::getUrl()),
            //             ]),
            //         NavigationGroup::make('Design Management')
            //             ->items([
            //                 ...ResultResource::getNavigationItems(),
            //                 ...RequestDesignResource::getNavigationItems(),
            //                 // ...ManageUserResource::getNavigationItems(),
            //             ]),
            //         NavigationGroup::make('Setting')
            //             ->items([
            //                 ...BrandResource::getNavigationItems(),
            //                 ...UserResource::getNavigationItems(),
            //                 NavigationItem::make('Roles')
            //                 // ->visible(fn (): bool => auth()->user('admin')->can('viewAny', Roles::class))
            //                     ->icon('heroicon-o-user-group')
            //                     ->isActiveWhen(fn (): bool => request()->routeIs([
            //                         'filament.admin.resources.roles.index',
            //                         'filament.admin.resources.roles.create',
            //                         'filament.admin.resources.roles.view',
            //                         'filament.admin.resources.roles.edit'
            //                     ]))
            //                     ->url(fn (): string => '/admin/roles'),
            //                 NavigationItem::make('Permissions')
            //                     ->icon('heroicon-o-lock-closed')
            //                     ->isActiveWhen(fn (): bool => request()->routeIs([
            //                         'filament.admin.resources.permissions.index',
            //                         'filament.admin.resources.permissions.create',
            //                         'filament.admin.resources.permissions.view',
            //                         'filament.admin.resources.permissions.edit'
            //                     ]))
            //                     ->url(fn (): string => '/admin/permissions'),
            //             ]),
            //     ]);
            // })
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s');
    }
}
