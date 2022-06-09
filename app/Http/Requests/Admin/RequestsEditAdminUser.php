<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RequestsEditAdminUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return  adminAuth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:12',
            'email' => 'required|string|max:100',
            'group' => 'required|integer|exists:admin_user_group,id',
            'password' => "required|string|max:100",
            'status' => 'required|integer|exists:admin_status,id'
        ];

        if (empty($this->get('password'))) {
            unset($rules['password']);
        }

        return $rules;
    }
}
