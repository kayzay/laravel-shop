<?php


namespace App\Repository\Admin;


use App\Helpers\Traits\Instanced;
use App\Models\Admin\AdminStatus;
use App\Repository\Base\BaseRepository;

class RepositoryAdminStatus extends BaseRepository
{
    use Instanced;

    private function __construct()
    {
        $this->setModel(AdminStatus::class);
    }

    public static function getStatus()
    {
        return [
            AdminStatus::ADMIN_STATUS_ACTIVE => "Active",
            AdminStatus::ADMIN_STATUS_INACTIVE => "Inactive",
            AdminStatus::ADMIN_STATUS_BLOCKED => "Blocked"
        ];
    }

    public function selectStatus($id = null)
    {
        $data = collect($this->_selectStatus());

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

    private function _selectStatus()
    {
        return $this->getCondition()->all()->toArray();
    }
}
