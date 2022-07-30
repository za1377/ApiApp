<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\AttributesValues;
use App\Models\CACA;

class AttrValCACAResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $AttributesValues = AttributesValues::where('id' , $this->attribute_value_id)->first();
        $CACA = CACA::where('id' , $this->caa_id)->first();

        if(!is_null($AttributesValues) && !is_null($CACA)){
            return [
                'id' => $this->id,
                'AttributesValuesName' => $AttributesValues->name,
                'CACAId' => $this->caa_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ];
        }
    }
}
