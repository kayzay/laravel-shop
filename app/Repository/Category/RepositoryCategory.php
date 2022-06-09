<?php
namespace App\Repository\Category;


use App\Helpers\Traits\Instanced;
use App\Repository\Base\BaseRepository;
use App\Models\Shop\Category\Category;
use App\Models\Shop\Category\CategoryStatus;

class RepositoryCategory extends BaseRepository
{
    use Instanced;

    private function __construct()
    {
        $this->setModel(Category::class);
    }


    public static function getDefaultLogo()
    {
        return 'img\avatar.png';
    }

    public function fromID($id)
    {
        $category = $this->getCondition()
            ->select('id', 'parent_id', 'alias', 'img', 'status')
            ->where('id', $id)
            ->with(['descriptions'])
            ->get();

        $category = current($category);

        return $category;
    }

    public function listCategoryTable()
    {
        $data = $this->getCondition()
            ->select('id', 'status')
            ->with(['description' => function ($qurey) {
                $qurey
                    ->select('name', 'category_id')
                    ->where('language_id', config('app.language_id'));
            }])
            ->orderBy('id', 'desc')
            ->paginate(5)
            ->toArray();

        $items = $this->peeperListCategoryTable($data['data']);

        // unset($data['data']);

        return [
            'data' => $items,
            'pagination' => $data
        ];
    }

    public function selectCategory($id = null)
    {
        $data = $this->getCondition()
            ->where('status', '=', CategoryStatus::STATUS_ACTIVE)
            ->with(['description' => function ($query) {
                $query
                    ->select('name', 'category_id')
                    ->where('language_id', 1);
            }])
            ->get()
            ->toArray();

        return $this->preperSelectCategory($id, $data);
    }

    public function editCategory($id)
    {
        $category = $this->getCondition()
            ->select('id', 'parent_id', 'alias', 'img', 'status')
            ->where('id', $id)
            ->with(['descriptions'])
            ->get()
            ->toArray();

        $category = current($category);

        if (is_array($category)) {
            $category['logo'] = ($category['img'] == self::getDefaultLogo())
                ? ''
                : $category['img'];
            $category['img'] = ($category['img'] == null)
                ? self::getDefaultLogo()
                : "/storage/img/" . $category['img'];

            $category['descriptions'] = collect($category['descriptions'])->keyBy('language_id')->toArray();
        }


        return $category;
    }


    private function peeperListCategoryTable($data)
    {

        $items = collect($data)
            ->transform(function ($item) {
                return [
                    'id' => $item['id'],
                    'name' => $item['description']['name'],
                    'status' => CategoryStatus::STATUS_LIST[$item['status']],
                    'status_id' => $item['status']
                ];
            })
            ->toArray();

        return $items;
    }

    private function preperSelectCategory($id, $data)
    {
        $items = collect($data);

        if ($id !== null) {
            $items->push([
                'id' => 0,
                'description' => ['name' => getTextAdmin('preSelected', 'custom')]
            ]);
        }

        $items->transform(function ($item) use ($id) {
            return [
                'id' => $item['id'],
                'name' => $item['description']['name'],
                'selected' => ($id !== null && $id == $item['id'])
            ];
        })
            ->sortBy('id')
            ->toArray();

        return $items;
    }
}
