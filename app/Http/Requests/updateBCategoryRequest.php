<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateBCategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'integer|required',
            'BrandName' => 'filled|string|exists:brands,name',
            'CategoryName' => 'filled|string|exists:categories,name',
        ];
    }
}
