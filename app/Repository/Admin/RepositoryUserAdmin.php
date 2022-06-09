<?php


namespace App\Repository\Admin;


use App\Helpers\Traits\Instanced;
use App\Models\Admin\AdminUser;
use App\Repository\Base\BaseRepository;

class RepositoryUserAdmin extends BaseRepository
{
    use Instanced;

    private function __construct()
    {
        $this->setModel(AdminUser::class);
    }

    public function adminTableList()
    {
        $data = $this->getCondition()
                    ->select('id', 'name', 'group_id', 'status')
                   // ->with('group:id,name')
                    ->paginate(5)
                    ->toArray();

        $items = $this->peeperListAdminTable($data['data']);

        //unset($data);

        return [
            'data' => $items,
            'pagination' => $data
        ];
    }

    public function editAdminUser($id)
    {
        return current($this->getCondition()
            ->select('id', 'name', 'group_id', 'email', 'status')
            ->where('id', $id)
            ->get()
            ->toArray());
    }

    private function peeperListAdminTable($data)
    {
        $items = collect($data)
            ->transform(function($item) {
                return [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'status_id' => $item['status'],
                    'status' => RepositoryAdminStatus::getStatus()[$item['status']],
                ];
            })
            ->toArray();

        return $items;
    }

}
