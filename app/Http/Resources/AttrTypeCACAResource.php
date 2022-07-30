<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\AttributesTypes;
use App\Models\CACA;

class AttrTypeCACAResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $AttributesTypes = AttributesTypes::where('id' , $this->attribute_type_id)->first();
        $CACA = CACA::where('id' , $this->caa_id)->first();

        if(!is_null($AttributesTypes) && !is_null($CACA)){
            return [
                'id' => $this->id,
                'AttributesTypesName' => $AttributesTypes->name,
                'CACAId' => $this->caa_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ];
        }
    }
}
