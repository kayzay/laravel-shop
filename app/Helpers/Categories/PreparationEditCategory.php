<?php

namespace App\Helpers\Categories;


use App\Helpers\Traits\Instanced;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class PreparationEditCategory {

    use Instanced;

    private $data = [];


    public function editCategory($data)
    {
        $name = $data['description'][config('app.language_id')]['name'];

        $this->data['main']['alias'] = $this->bildAlias($data['main']['alias'], $name);
        $this->data['main']['parent_id'] =  $data['main']['parent'] ?? 0;
        $this->data['main']['img'] = $data['main']['load_logo'];
        $this->data['main']['status'] = $data['main']['status'];
        $this->data['tmp'] = $data['description'];

        return $this;
    }

    public function editDescription($categoryID)
    {
        $this->data['descriptions'] = collect($this->data['tmp'])
            ->transform(function($item, $key) use($categoryID){
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

    public function saveLogo(UploadedFile $file = null)
    {
        if($file !== null) {
            $fileName = "cat_" . strtotime("now") . ".{$file->extension()}";
            $file->storeAs('public/img/catgories', $fileName);
            $this->data['main']['img'] = "catgories/" . $fileName;
        }


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
