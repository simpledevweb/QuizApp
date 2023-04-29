<?php 

namespace App\Services\Collection;

use App\Models\Answer;
use App\Models\Collection;
use App\Models\Question;
use App\Services\BasicService;

class DestroyCollection extends BasicService
{
    public function rules(): array
    {
        return [
            'id'=>'required|exists:collections,id'
        ];
    }

    public function execute($data)
    {
        $this->validate($data);
        $collection=Collection::find($data['id']);
        $questions=Question::where('collection_id',$data['id'])->get();
        foreach($questions as $question){
            $question_id=$question['id'];
            $answers=Answer::where('question_id' ,$question_id)->get();
            foreach($answers as $answer){
                $delete_answer=Answer::find($answer['id']);
                $delete_answer->delete();
            }
            $delete_question=Question::find($question_id);
            $delete_question->delete();
        }
        $collection->delete();
        return true;
    }
}
