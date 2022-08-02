<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\DataAwareRule;
use App\Models\CACA;
use Validator;

class checkType implements Rule ,DataAwareRule
{
    /**
     * All of the data under validation.
     *
     * @var array
     */
    protected $data = [];

    // ...

    /**
     * Set the data under validation.
     *
     * @param  array  $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }


    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach($this->data["attributes"] as $attr){
            $CACA = CACA::where('attributes_id' ,$attr["attribute_id"])->get();
            foreach($CACA as $caca){
                if($caca->cate_attr_cate->category_id != $this->data['category_id']){
                    return false;
                }
            }
            $AttributeType = $CACA[0]->CACA_attrType->attrType->name;

            if($AttributeType == 'string'){
                $validator = Validator::make($attr, [
                    'attribute_value' => 'max:1',
                    'attribute_value.*' => 'string',
                ]);
                if($validator->fails()){
                    return false;
                }
            }

            if($AttributeType == 'integer'){
                $validator = Validator::make($attr, [
                    'attribute_value' => 'max:1',
                    'attribute_value.*' => 'integer',
                ]);
                if($validator->fails()){
                    return false;
                }
            }

            if($AttributeType == 'selectbox'){
                $validator = Validator::make($attr, [
                    'attribute_value' => 'max:1',
                ]);
                if($validator->fails()){
                    return false;
                }
            }

        }
        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The attribute has problem in checktype rule.';
    }
}
