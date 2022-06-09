<?php


namespace App\Repository\Product;


use App\Helpers\Traits\Instanced;
use App\Models\Shop\Product\Product;
use App\Repository\Base\BaseRepository;

class RepositoryProduct  extends BaseRepository
{
    use Instanced;

    public const ACTIVE_STATUS = 1;
    public const INACTIVE_STATUS = 2;

    private function __construct()
    {
        $this->setModel(Product::class);
    }

    public function productStatusList($id, $useDefValue = false)
    {
        $data = self::getProductStatus();

        if ($useDefValue) {
            $data[0] = __('category.preSelected');
        }

        $items = collect($data)
            ->transform(function($item, $key) use($id){
                return [
                    'id' => $key,
                    'name' => $item,
                    'selected' => $id == $key
                ];
            })
            ->sortBy('id')
            ->toArray();

       // dbg($items);die;

        return $items;
    }

    public function editProduct($id)
    {
        $product = $this->getCondition()
            ->select('id',  'alias', 'quantity', 'sort', 'img', 'status', 'price')
            ->where('id', $id)
            ->with(['descriptions', 'category' => function($query) {
                $query
                    ->select('category_description.name', 'category_description.category_id')
                    ->where('language_id', config('app.language_id'));
            }])
            ->get()
            ->toArray();

        $product = current($product);

        if(is_array($product)) {
            $category['logo'] = ($product['img'] == self::getDefaultLogo())
                ? ''
                : $product['img'];
            $product['img'] = ($product['img'] == null || $product['img'] == self::getDefaultLogo())
                ? $product['img']
                : "/storage/img/" . $product['img'];

            $product['descriptions'] = collect($product['descriptions'])->keyBy('language_id')->toArray();
        }


        return $product;
    }

    public function listProductTable()
    {
        $data = $this->getCondition()
            ->select('id',  'alias', 'quantity', 'status')
            ->with(['description' => function ($query) {
                $query
                    ->select('name', 'product_id')
                    ->where('language_id', config('app.language_id'));
            },
                'category' => function($query) {
                    $query
                        ->select('category_description.name', 'category_description.category_id')
                        ->where('language_id', config('app.language_id'));
                }])
            ->orderBy('id', 'desc')
            ->paginate(5)
            ->toArray();
      //  dbg($data);
        $items = $this->peeperListProductTable($data['data']);

         //unset($data);

        return [
            'data' => $items,
            'pagination' => $data
        ];
    }

    public static function getProductStatus()
    {
        return [
            self::ACTIVE_STATUS => 'Active',
            self::INACTIVE_STATUS => 'Inactive'
        ];
    }

    public static function getDefaultLogo()
    {
        return 'img/AdminLTELogo.png';
    }


    private function peeperListProductTable($data)
    {

        $items = collect($data)
            ->transform(function($item) {
                return [
                    'id' => $item['id'],
                    'name' => $item['description']['name'],
                    'status' => self::getProductStatus()[$item['status']],
                    'alias' => $item['alias'],
                    'quantity' => $item['quantity'],
                    'categories' => $item['category'],
                    'status_id' => $item['status']
                ];
            })
            ->toArray();

        return $items;
    }
}
