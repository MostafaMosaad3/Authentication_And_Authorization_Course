<?php

namespace App\Providers;


use App\Models\Admin;
use App\Policies\AdminPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('add_user', function (Admin $admin) {
            return $admin->hasAnyPermission('add_user')
                ? Response::allow()
                : Response::deny('You must be an administrator.');
        });
    }
}
