<?php

namespace App\Helpers\Products;


use App\Helpers\Traits\Instanced;
use App\Repository\RepositoryLanguage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PreparationAddProduct {

    use Instanced;
    /**
     *  @method getInstance()
     */
    private $data = [];

    public function addProduct($data)
    {
        $langID = RepositoryLanguage::getDefaultLanguageId();
        $name = $data['description'][$langID]['name'];

        $this->data['main']['alias'] = $this->bildAlias($data['main']['alias'], $name);
        $this->data['main']['quantity'] = (int)$data['main']['quantity'] ?? 0;
        $this->data['main']['sort'] =  (int)$data['main']['sort'] ?? 0;
        $this->data['main']['status'] =  $data['main']['status'] ?? 2;


        $this->data['main']['price'] =  (float)$data['main']['price'];
        $this->data['categories'] = $this->bilCategories($data['main']['categories']);
        $this->data['tmp'] = $data['description'];

        return $this;
    }

    public function saveLogo(UploadedFile $file, $defaultPage)
    {
        $fileName = $defaultPage;
        if($file) {
            $fileName = "pr_" . strtotime("now") . ".{$file->extension()}";
           /* $path = public_path('img/products');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $file->move($path, $fileName);*/

            $file->storeAs('public/img/products', $fileName);
            $fileName = "products/" . $fileName;
        }

        $this->data['main']['img'] = $fileName;

        return $this;
    }

    public function addProductDescriptions($productID)
    {

        $this->data['descriptions'] = collect($this->data['tmp'])
                ->transform(function($item, $key) use($productID) {
                    return [
                        'product_id' => $productID,
                        'language_id' => $key,
                        'name' => $item['name'],
                        'h1' => $item['h1'],
                        'title' => $item['title'],
                        'description' => $item['description'],
                        'keywords' => $item['keywords'],
                        'short_description' => $item['short_description'],
                        'full_description' => $item['full_description']
                    ];
                })->toArray();

        unset($this->data['tmp']);

        return $this;
    }


    public function getData($key = null)
    {
        return ($key === null)
            ? $this->data
            : (isset($this->data[$key])
                ? $this->data[$key]
                : null);
    }

    private function bildAlias($alias, $nameCategory)
    {
        return (empty($alias))
                    ? Str::slug($nameCategory)
                    : Str::slug($alias);
    }

    private function bilCategories($categories)
    {
        return (is_array($categories)) ?  array_unique($categories) : [$categories];
    }


}
