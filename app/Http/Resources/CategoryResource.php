<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request):array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'created_at'=>$this->created_at?->format('Y-m-d H:i:s'),
            'updated_at'=>$this->updated_at?->format('Y-m-d H:i:s'),
            'deleted_at'=>$this->deleted_at?->format('Y-m-d H:i:s')
        ];
    }
}