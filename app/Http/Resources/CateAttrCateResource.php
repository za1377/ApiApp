<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\AttributeCategories;
use App\Models\categories;

class CateAttrCateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $attributeCategory = AttributeCategories::where('id' , $this->attribute_category_id)->first();
        $category = categories::where('id' , $this->category_id)->first();

        if(!is_null($attributeCategory) && !is_null($category)){
            return [
                'id' => $this->id,
                'AttributeCategoriesName' => $attributeCategory->name,
                'CategoryName' => $category->name,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ];
        }

    }
}
