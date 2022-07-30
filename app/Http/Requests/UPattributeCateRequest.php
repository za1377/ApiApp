<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UPattributeCateRequest extends FormRequest
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
            'id' => 'integer|required|exists:attribute_categories,id,deleted_at,NULL',
            'name' => 'filled|min:1|unique:attribute_categories,name,'.$this->id.',id,deleted_at,NULL',
            'slug' => 'filled|min:1|unique:attribute_categories,slug,'.$this->id.',id,deleted_at,NULL',

        ];
    }
}
