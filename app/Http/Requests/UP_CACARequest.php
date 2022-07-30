<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UP_CACARequest extends FormRequest
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
            'id' => 'integer|required|exists:c_a_c_a,id,deleted_at,NULL',

            'cate_atrre_cate_id' => ['required','integer','exists:categories__attributes_categories,id,deleted_at,NULL',
            Rule::unique('c_a_c_a')->where(function($query){
                return $query->where('attributes_id', $this->attributes_id)
                ->where('deleted_at', );
            })->ignore($this->id),
            ],

            'attributes_id' => 'required|integer|exists:attributes,id,deleted_at,NULL',

        ];
    }
}
