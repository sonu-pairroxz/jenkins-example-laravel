<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" =>$this->id,
            "full_name" =>$this->full_name,
            "mobile_no" =>$this->mobile_no,
            "email" =>$this->email,
            "address" =>$this->address,
            "city" =>$this->city,
            "state" =>$this->state,
            "country" =>$this->country,
            "zipcode" =>$this->zipcode,
        ];
    }
}
