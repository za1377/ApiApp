<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Brands;
use App\Models\categories;
use App\Models\AdsAttribute;

class AdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $brandName = "no Brand";
        $brand = null;
        if(!is_null($this->brand_id)){
            $brand = Brands::where('id' , $this->brand_id)->first();
        }
        if(!is_null($brand)){
            $brandName = $brand->name;
        }

        $category = categories::where('id' , $this->category_id)->first();
        $attribute = AdsAttribute::where('ads_id' , $this->id)->get("attribute_value");

        if(!is_null($category) && !is_null($attribute)){
            return [
                'id' => $this->id,
                'BrandName' => $brandName,
                'CategoryName' => $category->name,
                'AttributeName' => $attribute,
            ];
        }
    }
}
