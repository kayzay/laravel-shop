<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategotyRequest extends FormRequest
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
            "main.parent" => "integer|exists:categories,id",
            "main.alias" => "string|max:100|exists:categories,alias",
            "main.img" => "file|mimes:jpg|max:11204",
            "main.status" => "required|integer"
        ];

        $data = $this->all();

        $parent = $data['main']['parent'] ?? 0;

        if(empty($parent) || $parent === 0) {
            unset($rules["main.parent"]);
        }

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
