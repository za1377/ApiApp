<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttributeTypeRequest extends FormRequest
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
            'name' => ['required','string',
            Rule::unique('attributes_types')->where(function($query){
                return $query->where('deleted_at' , );
            }),],
            'slug' => ['required','string',
            Rule::unique('attributes_types')->where(function($query){
                return $query->where('deleted_at' , );
            }),],
        ];

    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'slug.required' => 'A slug is required',
        ];
    }
}
