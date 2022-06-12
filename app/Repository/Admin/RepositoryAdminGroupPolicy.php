<?php


namespace App\Repository\Admin;


use App\Helpers\Traits\Instanced;
use App\Models\Admin\AdminPolicy;
use App\Models\Admin\AdminRule;
use App\Repository\Base\BaseRepository;

class RepositoryAdminGroupPolicy extends BaseRepository
{
    use Instanced;

    private function __construct()
    {
        $this->setModel(AdminPolicy::class);
    }

    public function tablePolicyList()
    {
        $data = $this->getCondition()
            ->select('id', "name")
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();

        return $data;
    }

    public function getFormatPolicy($policies, $groupID, $adminID)
    {
        $policyRules = [];

        foreach ($policies as $id => $items) {
            $s = isset($items[AdminRule::PERMISSION_SHOW]) ? AdminRule::RULES[AdminRule::PERMISSION_SHOW] : 0;
            $c = isset($items[AdminRule::PERMISSION_CREATE]) ? AdminRule::RULES[AdminRule::PERMISSION_CREATE] : 0;
            $u = isset($items[AdminRule::PERMISSION_UPDATE]) ? AdminRule::RULES[AdminRule::PERMISSION_UPDATE] : 0;
            $d = isset($items[AdminRule::PERMISSION_DELETE]) ? AdminRule::RULES[AdminRule::PERMISSION_DELETE] : 0;

            $rules = $s | $c | $u | $d;
            $policyRules[$id] = [
                'admin_policy_id' => $id,
                'group_id' => $groupID,
                'rules' => $rules,
                'admin_id' => $adminID
            ];
        }

        return $policyRules;
    }

}
