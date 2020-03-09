<?php

namespace App\Providers;

use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        Gate::define('view-profile', function ($user, $usersProfile) {
            return $usersProfile->id === auth()->user()->id
                        ? Response::allow()
                        : Response::deny(__('Not authorized to view this profile.'));
        });

        Gate::define('create-user', function ($user) {
            return $user->isAdmin ? Response::allow()
                                  : Response::deny(__('Unauthorized.'));
        });
    }
}
