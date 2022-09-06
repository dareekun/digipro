<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('isDeveloper', function($user) {
            if ($user->role == 'developer') {
                return true;
            }
        });
        Gate::define('isManager', function($user) {
            if ($user->role == 'developer' || $user->role == 'manager')  {
                return true;
            }
        });
        Gate::define('isAdmin', function($user) {
            if ($user->role == 'admin' || $user->role == 'developer') {
                return true;
            }
         });
         Gate::define('isUser', function($user) {
            if ($user->role == 'manager' || $user->role == 'admin' || $user->role == 'user' || $user->role == 'developer') {
                return true;
            }
         });
    }
}
