<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UPcategoryRequest extends FormRequest
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
            'id' => 'integer|required|exists:categories,id,deleted_at,NULL',
            'name' => 'filled|min:1|unique:categories,name,'.$this->id.',id,deleted_at,NULL',
            'slug' => 'filled|min:1|unique:categories,slug,'.$this->id.',id,deleted_at,NULL',
            'parent_id' => 'filled|integer|nullable',
        ];

    }
}
