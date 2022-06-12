<?php

namespace App\Policies\Admin;

use App\Facades\Admin\AdminAuthRules;
use App\Models\Admin\AdminPolicy;
use App\Models\Admin\AdminRule;
use App\Models\Admin\Auth\AdminUserLogin;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class LanguagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param AdminUserLogin $userLogin
     * @return Response|bool
     */
    public function viewAny(AdminUserLogin $userLogin)
    {
        return $this->checkRule($userLogin, AdminRule::PERMISSION_SHOW);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param AdminUserLogin $userLogin
     * @return bool
     */
    public function view(AdminUserLogin $userLogin)
    {
        return $this->checkRule($userLogin, AdminRule::PERMISSION_SHOW);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param AdminUserLogin $userLogin
     * @return Response|bool
     */
    public function create(AdminUserLogin $userLogin)
    {
        return $this->checkRule($userLogin, AdminRule::PERMISSION_CREATE);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param AdminUserLogin $userLogin
     * @return Response|bool
     */
    public function update(AdminUserLogin $userLogin)
    {
        return $this->checkRule($userLogin, AdminRule::PERMISSION_UPDATE);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param AdminUserLogin $userLogin
     * @return bool
     */
    public function delete(AdminUserLogin $userLogin)
    {
        return $this->checkRule($userLogin, AdminRule::PERMISSION_DELETE);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param AdminUserLogin $userLogin
     * @return Response|bool
     */
    public function restore(AdminUserLogin $userLogin)
    {
        return $this->checkRule($userLogin, AdminRule::PERMISSION_DELETE);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param AdminUserLogin $userLogin
     * @return bool
     */
    public function forceDelete(AdminUserLogin $userLogin)
    {
        return $this->checkRule($userLogin, AdminRule::PERMISSION_DELETE);
    }

    /**
     * @param AdminUserLogin $userLogin
     * @param $policy
     * @param $permission
     * @return string|null
     */
    private function checkRule(AdminUserLogin $userLogin, $permission)
    {
        if (!AdminAuthRules::isAdmin()) {
            AdminAuthRules::setAdmin($userLogin->load('groupRules'));
        }
        $policy = AdminAuthRules::getPolicy(AdminPolicy::POLICY_LANGUAGES);

        return AdminAuthRules::check($policy, $permission);
    }
}
