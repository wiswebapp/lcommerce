<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
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
            'name' => 'required|max:255|regex:/^[\pL\s\-]+$/u',
            'status' => 'required',
        ];
        
        if($method == "POST"){
            $rules += [
                'email' => ['required', Rule::unique('admin', 'email'), 'email:rfc'],
                'password' => 'required|min:6',
            ];
        }else{
            $rules += [
                'email' => ['required', Rule::unique('admin', 'email')->ignore($this->route('id')), 'email:rfc'],
            ];
        }

        return $rules;
    }
}
