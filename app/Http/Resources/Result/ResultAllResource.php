<?php

namespace App\Http\Resources\Result;

use App\Http\Resources\Answer\AnswerResource;
use App\Http\Resources\Collection\CollectionResource;
use App\Http\Resources\Question\QuestionResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ResultAllResource extends JsonResource
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
            'collection'=>new CollectionResource($this->collection),
            'question'=>new QuestionResource($this->question),
            'user'=>new UserResource($this->user),
            'answer'=>new AnswerResource($this->answer),
            'is_correct'=>$this->is_correct,
            'created_at'=> $this->created_at->format('Y-m-d H:i:s'),
            
        ];
    }
}
