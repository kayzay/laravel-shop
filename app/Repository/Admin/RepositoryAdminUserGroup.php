<?php


namespace App\Repository\Admin;


use App\Helpers\Traits\Instanced;
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

    private function _selectGroup()
    {
        return $this->getCondition()->all()->toArray();
    }
}
