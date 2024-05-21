<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Brand;
use App\Models\RequestDesign;
use App\Models\Result;
use App\Models\User;
use App\Policies\BrandPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\RequestDesignPolicy;
use App\Policies\ResultPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role as ModelsRole;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Brand::class => BrandPolicy::class,
        User::class => UserPolicy::class,
        Result::class => ResultPolicy::class,
        RequestDesign::class => RequestDesignPolicy::class,
        ModelsRole::class => RolePolicy::class,
        ModelsPermission::class => PermissionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
