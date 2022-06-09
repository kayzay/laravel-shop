<?php
namespace App\Repository\Category;


use App\Helpers\Traits\Instanced;
use App\Repository\Base\BaseRepository;
use App\Models\Shop\Category\CategoryStatus;

class RepositoryCategoryStatus extends BaseRepository
{
    use Instanced;

    private function __construct()
    {
        $this->setModel(CategoryStatus::class);
    }

    public static function staticListStatus($id = null)
    {
        return [
           [
               'id' => 0,
                'name' => 'Selected',
               'selected' => 0 == $id
           ],
           [
               'id' => CategoryStatus::STATUS_ACTIVE,
                'name' => 'Active',
               'selected' => CategoryStatus::STATUS_ACTIVE == $id
           ],
            [
                'id' => CategoryStatus::STATUS_INACTIVE,
                'name' => 'Inactive',
                'selected' => CategoryStatus::STATUS_INACTIVE == $id
            ]
        ];
    }

    public function listStatus($id = null)
    {
        $data = $this->getCondition()->all()->toArray();

        $data = collect($data)->push([
                'id' => 0,
                'name' => getTextAdmin('preSelected', 'custom'),
                'selected' => false
            ])
            ->transform(function ($item) use($id){
                return [
                    'id' => $item['id'],
                    'name' =>  $item['name'],
                    'selected' => ($id === $item['id'])
                ];
            })->sortBy('id')->toArray();

        return $data;
    }
}
