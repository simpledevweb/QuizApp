<?php

namespace App\Services\Answer;

use App\Models\Answer;
use App\Models\Question;
use App\Services\BasicService;

class StoreAnswer  extends BasicService
{
    public function rules(): array
    {
        return [
            'question_id' => 'required|exists:questions,id',
            'answer' => 'required',
            'is_correct' => 'required|boolean',
        ];
    }

    public function execute($data)
    {
        $this->validate($data);
        Answer::create([
            'question_id' => $data['question_id'],
            'answer' => $data['answer'],
            'is_correct' => $data['is_correct']
        ]);
        if ($data['is_correct']) {
            $corrects = Question::find($data['question_id'])->first();
            $corrects = $corrects['correct_answers'];
            $corrects++;
            Question::find($data['question_id'])->update([
                'correct_answers' => $corrects
            ]);
        }
        return true;
    }
}
