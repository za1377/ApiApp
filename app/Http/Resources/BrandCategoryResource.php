<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Brands;
use App\Models\categories;

class BrandCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $brand = Brands::where('id' , $this->brand_id)->first();
        $category = categories::where('id' , $this->category_id)->first();

        if(!is_null($brand) && !is_null($category)){
            return [
                'id' => $this->id,
                'BrandName' => $brand->name,
                'CategoryName' => $category->name,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ];
        }
    }
}
