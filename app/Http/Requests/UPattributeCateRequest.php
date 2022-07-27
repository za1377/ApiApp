<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'id' => 'integer|required|exists:attribute_categories,id',
            'name' => 'filled|string|unique:attribute_categories,name,'.$this->id,
            'slug' => 'filled|string|unique:attribute_categories,slug,'.$this->id,
        ];
    }
}
