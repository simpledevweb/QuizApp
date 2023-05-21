<?php

namespace App\Services\Result;

use App\Models\Question;
use App\Models\Result;
use App\Models\User;
use App\Services\BasicService;

class CalculateQuestionResult  extends BasicService
{
    public function rules(): array
    {
        return [];
    }

    public function duplicate($data)
    {
        $data_ret = [];
        foreach ($data as $val) {
            if (!in_array($val, $data_ret)) {
                $data_ret[] = $val;
            }
        }
        return $data_ret;
    }

    public function execute()
    {
        $data = [];
        $results = collect(Result::all());
        $users = collect(User::all());
        $questions = collect(Question::all());
        $questions_res = $results->pluck('question_id');
        $questions_res = $this->duplicate($questions_res);

        foreach ($questions_res as $question) {
            $data1 = [];
            $users_res = $results->where('question_id', $question)->pluck('user_id');
            foreach ($users_res as $user) {
                $data1[] = [
                    'user' => $users->where('id', $user)->first()->name
                ];
            }
            $data[] = [
                'question_id' => $questions->where('id', $question)->first()->question,
                'users' => $data1,
            ];
        }
        return response([
            'data' => $data
        ]);
    }
}
