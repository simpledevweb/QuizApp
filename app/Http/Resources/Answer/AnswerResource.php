<?php

namespace App\Http\Resources\Answer;

use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=> $this->id,
            'question_id'=>$this->question_id,
            'answer'=> $this->answer,
            'is_correct'=> $this->is_correct
        ];
    }
}
