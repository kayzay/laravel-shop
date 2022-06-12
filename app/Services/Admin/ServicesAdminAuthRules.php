<?php


namespace App\Services\Admin;


use App\Models\Admin\AdminRule as AdminRuleAlias;
use App\Models\Admin\Auth\AdminUserLogin;

class ServicesAdminAuthRules
{
    private $admin = [];

    public const KEY_RULES = 'group_rules';

    /**
     * @return bool|null
     */
    public function isAdmin()
    {
        return (bool) $this->admin ?? null;
    }

    /**
     * @param $id
     * @return array|mixed|string
     */
    public function getPolicy($id)
    {
        $data = collect($this->admin[self::KEY_RULES])
            ->where('politics_id', '=', $id)->toArray();
        $data = current($data);

        return $data['politics_name'] ?? '';
    }

    /**
     * @param $policy
     * @param $permission
     * @return bool
     */
    public function check($policy, $permission)
    {
        if (isset($this->admin[self::KEY_RULES][$policy])) {
            $rules = AdminRuleAlias::RULES;

            if (isset($rules[$permission])) {
                return (bool)($this->admin[self::KEY_RULES][$policy]['rules'] & $rules[$permission]);
            }

            return false;
        }

        return false;
    }

    /**
     * @param AdminUserLogin $admin
     */
    public function setAdmin(AdminUserLogin $admin)
    {

        $this->admin = $admin->toArray();
        if (isset($this->admin[self::KEY_RULES])) {
            $this->admin[self::KEY_RULES] = collect($this->admin[self::KEY_RULES])
                ->keyBy('politics_name')
                ->toArray();
        }
    }

    /**
     * @return array
     */
    public function getAdmin()
    {
        return $this->admin;
    }
}
