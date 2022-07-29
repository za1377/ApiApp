<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UPattributeValueRequest extends FormRequest
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
            'id' => ['integer','required', Rule::exists('attributes_values')->where(function($query){
                return $query->where('deleted_at' , );
            })],

            'name' => ['filled','string',
            Rule::unique('attributes_values')->where(function($query){
                return $query->where('deleted_at' , );
            })->ignore($this->id),],

            'slug' => ['filled','string',
            Rule::unique('attributes_values')->where(function($query){
                return $query->where('deleted_at' , );
            })->ignore($this->id),],
        ];
    }
}
