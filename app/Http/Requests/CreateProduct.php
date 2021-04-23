<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $method = $this->method();

        $rules = [
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'product_name' => 'required|max:255',
            'product_description' => 'required|max:255',
            'price' => 'required|integer',
            'status' => 'required',
        ];

        if ($method == "POST") {
            $rules += [
                'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
        }else{
            $rules += [
                'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ];
        }

        return $rules;
    }
}
