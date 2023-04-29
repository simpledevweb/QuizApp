<?php

namespace App\Http\Resources\Answer;

use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=> $this->id,
            'answer'=> $this->answer,
        ];
    }
}
