<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //Gate::define('use-app-user', function ($user){
        //    return $user->hasAnyRoles(['admin','user']);
        //});

        Gate::define('use-app-user', function ($user){
            return $user->hasAnyRoles(['admin','user']);
        });

        Gate::define('use-app-download_csv', function ($user){
            return $user->hasAnyRoles(['download_csv','admin']);
        });

        Gate::define('use-app-delete', function ($user){
            return $user->hasAnyRoles(['delete','admin']);
        });

        Gate::define('use-app-admin', function ($user){
            return $user->hasRole('admin');
        });
        
    }
}
