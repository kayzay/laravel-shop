<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Helpers\Products\PreparationEditProduct;
use App\Helpers\Products\PreparationAddProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Shop\Product\Product;
use App\Models\Shop\Product\ProductCategoryTree;
use App\Models\Shop\Product\ProductDescription;
use App\Repository\Category\RepositoryCategory;
use App\Repository\Product\RepositoryProduct;
use App\Repository\RepositoryLanguage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Product::class, Product::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = RepositoryProduct::getInstance()->listProductTable();

        return view('admin.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $locale = RepositoryLanguage::getInstance()->activeLanguageList();
        $repositoryCategory = RepositoryCategory::getInstance();
        $repositoryProduct = RepositoryProduct::getInstance();

        $data = [
            'defaultPage' => RepositoryLanguage::getDefaultLanguageAbr(),
            'categoryList' => $repositoryCategory->selectCategory(null),
            'languages' => $locale,
            'statusList' => $repositoryProduct->productStatusList(1),
            'logo' => $repositoryProduct::getDefaultLogo(),
        ];

        return view('admin.products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        $data = PreparationAddProduct::getInstance();
        $main = $data->addProduct($request->all())
            ->saveLogo($request->file('main.img'), RepositoryProduct::getDefaultLogo())
            ->getData('main');
        $categories = $data->getData('categories');

        $newProduct = new Product($main);
        $newProduct->save();

        if ($newProduct->id) {
            $descriptions = $data->addProductDescriptions($newProduct->id)->getData('descriptions');
            foreach ($descriptions as $description) {
                ProductDescription::create($description);
            }
        }

        if ($categories) {
            foreach ($categories as $category) {
                ProductCategoryTree::create([
                    'product_id' => $newProduct->id,
                    'category_id' => $category
                ]);
            }
        }


        /**
         * ON future
         */
        /*  $priceGroup = UserGroup::all()->toArray();

          foreach ($priceGroup as $item) {
              Price::create([
                  'name' =>  'base_price_' . $item['name'],
                  'user_group_id' => $item['id'],
                  'price' => $main['price'],
                  'origin_price' => $main['price'],
                  'currency_id' => app('app.currency_id'),
                  'product_id' => $newProduct->id
              ]);
          }*/
        //TODO: ADD Price list save amd next step atribute and option
        return redirect()
            ->route('product.index')
            ->with('status', getTextAdmin('mess_add_pr', 'custom'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $locale = RepositoryLanguage::getInstance()->activeLanguageList();
        $langID = RepositoryLanguage::getDefaultLanguageID();
        $repositoryCategory = RepositoryCategory::getInstance();
        $repositoryProduct = RepositoryProduct::getInstance();

        $product = $repositoryProduct->editProduct($id);
        $categoryIds = array_column($product['category'], 'category_id');

        $data  = [
            'defaultPage' => RepositoryLanguage::getDefaultLanguageAbr(),
            'languages' => $locale,
            'statusList' => $repositoryProduct->productStatusList(1),
            'categoryList' => $repositoryCategory->selectCategory(),
            'categoryIds' => $categoryIds,
            'logo' => $product['img'],
            'info' => $product,
            'h1Mame' => $product['descriptions'][$langID]['name']
        ];

        return view('admin.products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $preparation = PreparationEditProduct::getInstance();
        $data = $preparation
            ->editProduct($request->all())
            ->saveLogo($request->file('main.img'))
            ->editDescription($id)
            ->getData();
        $product = Product::find($id);
        $product->fill($data['main']);

        if ($product->isDirty()) {
            $product->update();
        }
        $productDescriptions = ProductDescription::where('product_id', $id)->get();
        foreach($productDescriptions as $item) {
            $langID = $item->language_id;
            $description = $data['descriptions'][$langID];

            $item->fill($description);

            if($item->isDirty()) {
                $item->update();
            }
        }
        return redirect()
            ->route('product.index')
            ->with('status', getTextAdmin('mess_edit_pr', 'custom'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Product::find($id);
        $category->update(['status' => RepositoryProduct::INACTIVE_STATUS]);

        return redirect()
            ->route('product.index')
            ->with('status', getTextAdmin('mess_delete_pr', 'custom'));
    }
}
