<?php

namespace App\Services\Question;

use App\Models\Collection;
use App\Models\Question;
use App\Services\BasicService;
use Illuminate\Support\Facades\DB;

class StoreQuestion extends BasicService
{
    private array $answers;
    public function rules(): array
    {
        return [
            // "collection_id" => 'required|exists:collections,id',
            // "question" => "required",
            // "answers" => "required",
            // "answers.*.answer" => "required",
            // "answers.*.is_correct" => "required|boolean",
            "questions" => "required|array",
            "questions.*.question" => "required",
            "questions.*.answers" => "required",
            "questions.*.answers.*.answer" => "required",
            "questions.*.answers.*.is_correct" => "required",
        ];
    }

    public function execute(array $data)
    {
        $this->validate($data);
        foreach($data['questions'] as $questions){
            $answers = collect($questions['answers']);
            $question = Question::create([
                'collection_id' => $data['collection_id'],
                'question' => $questions['question'],
                'correct_answers' => $answers->where('is_correct', true)->count(),
            ]);
            foreach ($answers as $answer) {
                $this->answers[] = [
                    'question_id' => $question->id,
                    'answer' => $answer['answer'],
                    'is_correct' => $answer['is_correct'],
                ];
            }
            DB::table('answers')->insert($this->answers);
            $this->answers = [];
        }
        return true;
    }
}
