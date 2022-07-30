<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Categories_AttributesCategories;
use App\Models\Attributes;

class CACAResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $cate_attr_cate = Categories_AttributesCategories::where('id' , $this->cate_atrre_cate_id)->first();
        $attribute = Attributes::where('id' , $this->attributes_id)->first();

        if(!is_null($cate_attr_cate) && !is_null($attribute)){
            return [
                'id' => $this->id,
                'Category_AttributeCategoryId' => $cate_attr_cate->id,
                'AttributeName' => $attribute->name,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ];
        }
    }
}
