<?php

namespace App\Http\Resources\Question;

use App\Http\Resources\Answer\AnswerResource;
use App\Http\Resources\Collection\CollectionResource;
use App\Models\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=> $this->id,
            'collection'=>$this->collection->name,
            'question'=> $this->question,
            'correct_answers'=> $this->correct_answers,
            'answers'=> AnswerResource::collection($this->answers),
            'created_at'=> $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
