<?php


namespace App\Repository\Product;


use App\Helpers\Traits\Instanced;
use App\Models\Shop\Product\ProductCategoryTree;
use App\Repository\Base\BaseRepository;

class RepositoryProductCategoryTree extends BaseRepository
{
    use Instanced;

    private function __construct()
    {
        $this->setModel(ProductCategoryTree::class);
    }

    public function fromProductID($id)
    {
        $data = $this->getCondition()
            ->select('category_id')
            ->where('product_id', $id)
            ->get()
            ->toArray();
        dbg($data);
        return $data;
    }
}
