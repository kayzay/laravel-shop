<?php


namespace App\Repository\Admin;


use App\Helpers\Traits\Instanced;
use App\Models\Admin\AdminRule;
use App\Models\Admin\AdminUserGroup;
use App\Repository\Base\BaseRepository;

class RepositoryAdminUserGroup extends BaseRepository
{
    use Instanced;

    private function __construct()
    {
        $this->setModel(AdminUserGroup::class);
    }

    public function groupTableList()
    {
        $data = $this->getCondition()->paginate(5)->toArray();
        $items = $data['data'];

        unset($data['data']);

        return [
            'data' => $items,
            'pagination' => $data
        ];
    }

    public function selectGroup($id = null)
    {
        $data = collect($this->_selectGroup());

        if ($id !== null) {
            $data->push([
                'id' => 0,
                'name' => getTextAdmin('preSelected', 'custom')
            ]);
        }
        $data = $data->transform(function ($item) use ($id) {
            return [
                'id' => $item['id'],
                'name' => $item['name'],
                'selected' => ($id !== null && $id == $item['id'])
            ];
        })
            ->sortBy('id')
            ->toArray();

        return $data;
    }

    public function getRules($id)
    {
        $rules = $this->getCondition()
            ->where('id', $id)
            ->with(['roles'])
            //  ->with(['roles:rules, group_id, admin_policy_id'])
            ->get()
            ->toArray();

        $rules = current($rules);

        $rules['roles'] = collect($rules['roles'])
            ->transform(function ($item) {
                return [
                    'admin_policy_id' => $item['admin_policy_id'],
                    's' => (AdminRule::RULES['show'] & $item['rules']),
                    'c' => (AdminRule::RULES['create'] & $item['rules']),
                    'u' => (AdminRule::RULES['update'] & $item['rules']),
                    'd' => (AdminRule::RULES['delete'] & $item['rules']),
                ];
            })
            ->keyBy('admin_policy_id')
            ->toArray();

        return $rules;
    }

    private function _selectGroup()
    {
        return $this->getCondition()->all()->toArray();
    }
}
