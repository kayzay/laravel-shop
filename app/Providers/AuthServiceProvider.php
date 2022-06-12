<?php

namespace App\Providers;

use App\Models\Admin\AdminUser;
use App\Models\Admin\AdminUserGroup;
use App\Models\Language;
use App\Models\Shop\Category\Category;
use App\Models\Shop\Price\Currency;
use App\Models\Shop\Product\Product;
use App\Policies\Admin\Admin\AdminGroupPolicy;
use App\Policies\Admin\Admin\AdminPolicy;
use App\Policies\Admin\LanguagePolicy;
use App\Policies\Admin\Shop\CategoryTest;
use App\Policies\Admin\Shop\CategoryPolicy;
use App\Policies\Admin\Shop\CurrenyPolicy;
use App\Policies\Admin\Shop\ProductPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Category::class => CategoryPolicy::class,
        Product::class => ProductPolicy::class,
        Language::class => LanguagePolicy::class,
        Currency::class => CurrenyPolicy::class,
        AdminUser::class => AdminPolicy::class,
        AdminUserGroup::class => AdminGroupPolicy::class,


    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
