<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return adminAuth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'description.*.name' => "required|string|min:3|max:50",
            'description.*.h1' => "required|string|min:3|max:100",
            'description.*.title' => "required|string|min:3|max:50",
            "description.*.description" => "string|max:200",
            "description.*.keywords" => "string|max:200",
            "description.*.short_description" => "string|max:500",
            "description.*.full_description" => "string",
            "main.categories" => "required|exists:categories,id",
            "main.alias" => "string|max:100|exists:products,alias",
            "main.img" => "file|mimes:jpg|max:11204",
            "main.status" => "required|integer",
            "main.sort" => "integer",
            "main.quantity" => "required|integer",
            "main.price" => "required|regex:/^\d*(\.\d{2})?$/"
        ];

        $data = $this->all();


        $img = isset($data['main']['img'])
            ? $data['main']['img']
            : '';

        if(empty($img) ) {
            unset($rules["main.img"]);
        }

        $alias = $data['main']['alias'];

        if(empty($alias)) {
            unset($rules["main.alias"]);
        }

        unset($parent, $img, $alias, $data);


        return $rules;
    }
}
