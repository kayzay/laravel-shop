<?php


namespace App\Repository\Admin;


use App\Helpers\Traits\Instanced;
use App\Models\Admin\AdminRule;
use App\Repository\Base\BaseRepository;

class RepositoryAdminRules extends BaseRepository
{
    use Instanced;

    private function __construct()
    {
        $this->setModel(AdminRule::class);
    }

    public function getRules($groupId)
    {
        $rules = $this->getCondition()
            ->where('group_id', $groupId)
            ->get();

        return $rules;
    }

}
