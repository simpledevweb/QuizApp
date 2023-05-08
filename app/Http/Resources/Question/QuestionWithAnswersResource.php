<?php

namespace App\Http\Resources\Question;

use App\Http\Resources\Answer\AnswerResource;
use App\Http\Resources\Collection\CollectionResource;
use App\Http\Resources\User\UserResource;
use App\Models\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionWithAnswersResource extends JsonResource
{
    private $answers;
    public function setAnswers($answers): static
    {
        $this->answers = $answers;
        return $this;
    }

    public function toArray($request):array
    {
        return [
            'id' => $this->id,
            'collection' => new CollectionResource(Collection::find($this->collection_id)->first()),
            'question' => $this->question,
            'correct_answers'=>$this->correct_answers,            
            'answers' => AnswerResource::collection($this->answers),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}

?>