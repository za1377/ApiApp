<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CateAttrCateRequest extends FormRequest
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

            'attribute_category_id' => ['required','integer','exists:attribute_categories,id,deleted_at,NULL',
            Rule::unique('categories__attributes_categories')->where(function($query){
                return $query->where('category_id', $this->category_id)
                ->where('deleted_at' , );
            }),],

            'category_id' => 'required|integer|exists:categories,id,deleted_at,NULL',
        ];
    }
}
