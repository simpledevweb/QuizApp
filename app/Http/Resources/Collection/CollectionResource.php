<?php

namespace App\Http\Resources\Collection;

use App\Http\Resources\User\UserResource;
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
            'id'=> $this->id,
            'code'=> $this->code,
            'category_id'=>$this->category_id,
            'name'=> $this->name,
            'description'=> $this->description,
            'user'=> new UserResource($this->user),
            'allowed_type'=> $this->allowed_type,
            'created_at'=> $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
