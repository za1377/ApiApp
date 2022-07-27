<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'id' => 'integer|required|exists:categories,id',
            'name' => 'filled|string|unique:categories,name,'.$this->id,
            'slug' => 'filled|string|unique:categories,slug,'.$this->id,
            'parent_id' => 'filled|integer',
        ];
    }
}
