<?php

namespace App\Http\Resources\Allowed_user;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AllowedResource extends JsonResource
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
            'id' => $this->id,
            'collection' =>  $this->collection->name,
            'allowed_user' => new UserResource($this->user),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
