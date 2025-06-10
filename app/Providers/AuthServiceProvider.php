<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\dashboard\Vam;

use App\Policies\VamPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        \App\Models\dashboard\Vam::class => \App\Policies\VamPolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
