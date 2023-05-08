<?php

namespace App\Services\Answer;

use App\Models\Answer;
use App\Models\Question;
use App\Services\BasicService;

class UpdateAnswer  extends BasicService
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:answers,id',
            'question_id' => 'required|exists:questions,id',
            'answer' => "required",
            'is_correct' => 'required|boolean',
        ];
    }

    public function execute($data)
    {
        $this->validate($data);
        $answer = Answer::find($data['id']);
        if (($answer->question_id != $data['question_id'])) {
            if ($answer->is_correct) {
                Question::find($answer->question_id)->update([
                    'correct_answers' => (Question::find($answer->question_id)->correct_answers - 1)
                ]);
            }
            if($data['is_correct']){
                Question::find($data['question_id'])->update([
                    'correct_answers' => (Question::find($data['question_id'])->correct_answers + 1)
                ]);
            }
        }else{
            if($answer->is_correct&&!$data['is_correct']){
                Question::find($data['question_id'])->update([
                    'correct_answers' => (Question::find($data['question_id'])->correct_answers - 1)
                ]);
            }elseif(!$answer->is_correct&&$data['is_correct']){
                Question::find($data['question_id'])->update([
                    'correct_answers' => (Question::find($data['question_id'])->correct_answers + 1)
                ]);
            }
        }

        Answer::find($data['id'])->update([
            'question_id' => $data['question_id'],
            'answer' => $data['answer'],
            'is_correct' => $data['is_correct'],
        ]);
        return true;
    }
}
