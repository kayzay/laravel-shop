<?php


namespace App\Facades\Admin;


use App\Models\Admin\Auth\AdminUserLogin;
use App\Services\Admin\ServicesAdminAuthRules;
use Illuminate\Support\Facades\Facade;

/**
 * Class AdminAuthRules
 * @package App\Facades\Admin
 * @method static string|null getPolicy($id)
 * @method static bool check($policy, $permission)
 * @method static void setAdmin(AdminUserLogin $admin)
 * @method static bool isAdmin()
 */
class AdminAuthRules extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ServicesAdminAuthRules::class;
    }
}
