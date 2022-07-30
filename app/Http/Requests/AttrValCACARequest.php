<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttrValCACARequest extends FormRequest
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
            'attribute_value_id' => ['required','integer','exists:attributes_values,id,deleted_at,NULL',
            Rule::unique('attributes_values_caas')->where(function($query){
                return $query->where('caa_id', $this->caa_id)->where('deleted_at' , );
            }),],

            'caa_id' => 'required|integer|exists:c_a_c_a,id,deleted_at,NULL',
        ];
    }
}
