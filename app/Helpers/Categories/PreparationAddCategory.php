<?php

namespace App\Helpers\Categories;


use App\Helpers\Traits\Instanced;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;


class PreparationAddCategory {

    use Instanced;
    /**
     *  @method getInstance()
     */
    private $data = [];

    public function addCategory($data)
    {
        $name = $data['description'][config('app.language_id')]['name'];

        $this->data['main']['alias'] = $this->bildAlias($data['main']['alias'], $name);
        $this->data['main']['parent_id'] =  $data['main']['parent'] ?? 0;
        $this->data['main']['status'] =  $data['main']['status'] ?? 2;
        $this->data['tmp'] = $data['description'];

        return $this;
    }

    public function saveLogo(UploadedFile $file, $defaultPage)
    {
        $fileName = $defaultPage;
        if($file) {
            $fileName = "cat_" . strtotime("now") . ".{$file->extension()}";
            $file->storeAs('public/img/categories', $fileName);
            $fileName = "categories/" . $fileName;
        }

        $this->data['main']['img'] = $fileName;

        return $this;
    }

    public function addCategoryDescription($categoryID)
    {
      //  dbg($this->data['tmp']);
        $this->data['descriptions'] = collect($this->data['tmp'])
                ->transform(function($item, $key) use($categoryID) {
                    return [
                        'category_id' => $categoryID,
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


}
