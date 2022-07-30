<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Brands;
use App\Models\categories;
use App\Models\BrandsCategories;

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
            'id' => 'integer|required|exists:brands_categories,id,deleted_at,NULL',

            'brand_id' => ['required','integer','exists:brands,id,deleted_at,NULL',
            Rule::unique('brands_categories')->where(function($query){
                return $query->where('category_id', $this->category_id)
                ->where('deleted_at', );
            })->ignore($this->id),
            ],

            'category_id' => 'required|integer|exists:categories,id,deleted_at,NULL',

        ];
    }
}
