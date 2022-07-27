<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandCategoryRequest extends FormRequest
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
            'brand_id' => ['required','integer','exists:brands,id',
            Rule::unique('brands_categories')->where(function($query){
                return $query->where('category_id', $this->category_id);
            }),
            ],
            'category_id' => 'required|integer|exists:categories,id',
        ];
    }
}
