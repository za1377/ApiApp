<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UPbrandRequest extends FormRequest
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
            'id' => 'integer|required|exists:brands,id',
            'name' => 'filled|string|unique:brands,name,'.$this->id,
            'slug' => 'filled|string|unique:brands,slug,'.$this->id,
        ];
    }
}
