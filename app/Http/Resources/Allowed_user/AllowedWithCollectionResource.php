<?php

namespace App\Http\Resources\Allowed_user;

use App\Http\Resources\Collection\CollectionWithQuestionsResource;
use App\Http\Resources\Question\QuestionResource;
use App\Http\Resources\User\UserResource;
use App\Models\Question;
use Illuminate\Http\Resources\Json\JsonResource;

class AllowedWithCollectionResource extends JsonResource
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
            'collection' => $this->collection->name,
            'questions'=> QuestionResource::collection(Question::where('collection_id',$this->collection->id)->get()),
            'allowed_user' => new UserResource($this->user),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}