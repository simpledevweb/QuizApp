<?php

namespace App\Services\Question;

use App\Models\Answer;
use App\Models\Collection;
use App\Models\Question;
use App\Services\BasicService;

use function PHPUnit\Framework\isEmpty;

class UpdateQuestion extends BasicService
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:questions,id',
            'collection' => 'required|exists:collections,name',
            'question' => 'required',
            "answers.*.answer" => "required_unless:answers,null",
            "answers.*.id"=>"required_unless:answers,null|exists:answers,id"
        ];
    }

    public function execute(array $data): bool
    {
        $this->validate($data);

        Question::find($data['id'])->update([
            'collection_id' => Collection::where('name', $data['collection'])->first()->id,
            'question' => $data['question'],
        ]);
        if (isEmpty($data['answers'])) {
            for ($i = 0; $i < count($data['answers']); $i++) {
                Answer::find($data['answers'][$i]['id'])->update([
                    'answer' => $data['answers'][$i]['answer'],
                    'is_correct' => $data['answers'][$i]['is_correct']
                ]);
            }
            $answers=collect(Question::find($data['id'])->answers);
            Question::find($data['id'])->update([
                'correct_answers'=>$answers->where('is_correct',true)->count()
            ]);
        }
        return true;
    }
}
