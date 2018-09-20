<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyProductRequest extends FormRequest
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
        return [
            'product_categories_id' => 'required|int',
            'name' => 'required|min:2',
            'type' => 'min:2',
            'size' => 'min:1',
            'cost' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
            'time_to_prepare' => 'numeric|required',
            // 'picture' => 'mimes:jpg,jpeg,bmp,png,gif|max:10000'
        ];
    }
}
