<?php

namespace App\Services\Result;

use App\Models\Question;
use App\Models\Result;
use App\Services\BasicService;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StoreResult  extends BasicService
{
    public function rules(): array
    {
        return [
            'results' => 'required|array',
            'results.*.collection_id' => 'required|exists:collections,id',
            'results.*.question_id' => 'required|exists:questions,id',
            'results.*.user_id' => 'required|exists:users,id',
            'results.*.answer_id' => 'required|exists:answers,id',
            'results.*.is_correct' => 'required|boolean',
        ];
    }

    public function execute($data)
    {
        $this->validate($data);
        $results = [];
        foreach ($data['results'] as $k=>$result) {
            if(Question::find($result['question_id'])->collection_id==$result['collection_id']){
                $results[] = [
                    'collection_id' => $result['collection_id'],
                    'question_id' => $result['question_id'],
                    'user_id' => $result['user_id'],
                    'answer_id' => $result['answer_id'],
                    'is_correct' => $result['is_correct'],
                    'created_at'=>now(),
                    'updated_at'=>now(),
                ];
            }else{
                $msg="results".".".$k."."."collection_id => does not exists in question_id table";
                throw ValidationException::withMessages([
                    'message' => [$msg]
                ]);
            }
        
        }
        DB::table('results')->insert($results);
        return true;
    }
}
