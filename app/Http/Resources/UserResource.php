<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            'phone'=>$this->phone,
            'is_premium'=>$this->is_premium,
            'is_admin'=>$this->is_admin,
            'created_at'=>$this->created_at?->format('Y-m-d H:i:s'),
            'updated_at'=>$this->updated_at?->format('Y-m-d H:i:s'),
            'deleted_at'=>$this?->deleted_at?->format('Y-m-d H:i:s')
        ];
    }
}