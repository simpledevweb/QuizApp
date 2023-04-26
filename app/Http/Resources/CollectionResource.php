<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CollectionResource extends JsonResource
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
            'id'=>$this->id,
            'category_id'=>$this->category_id,
            'user_id'=>$this->user_id,
            'name'=>$this->name,
            'description'=>$this->description,
            'code'=>$this->code,
            'allowed_type'=>$this->allowed_type,
            'created_at'=>$this->created_at?->format('Y-m-d H:i:s'),
            'updated_at'=>$this->updated_at?->format('Y-m-d H:i:s'),
            'deleted_at'=>$this->deleted_at?->format('Y-m-d H:i:s')
        ];
    }
}
