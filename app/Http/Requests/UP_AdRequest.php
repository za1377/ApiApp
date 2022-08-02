<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\checkType;

class UP_AdRequest extends FormRequest
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
            'id' => 'integer|required|exists:ads,id,deleted_at,NULL',
            'brand_id' => 'filled|integer|exists:brands,id,deleted_at,NULL',
            'category_id' => 'required|integer|exists:categories,id,deleted_at,NULL',
            'attributes' => ['required','array', new checkType] ,
        ];
    }
}
