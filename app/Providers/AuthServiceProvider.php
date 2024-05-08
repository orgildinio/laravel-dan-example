<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Providers\DanServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Socialite::extend('dan', function ($app) {
            return Socialite::buildProvider(DanServiceProvider::class, config('services.dan'));
        });

        Socialite::extend('org', function ($app) {
            return Socialite::buildProvider(DanServiceProvider::class, config('services.org'));
        });
    }
}
