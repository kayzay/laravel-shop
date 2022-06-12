<?php

namespace App\Providers;

use App\Models\Admin\AdminUser;
use App\Models\Admin\Auth\AdminUserLogin;
use App\Services\Admin\ServicesAdminAuthRules;
use Illuminate\Support\ServiceProvider;

class AdminAuthRule extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ServicesAdminAuthRules::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
