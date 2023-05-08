<?php 
namespace App\Services\Answer;

use App\Models\Answer;
use App\Models\Question;
use App\Services\BasicService;

class DestroyAnswer  extends BasicService
{
    public function rules(): array
    {
        return [
            'id'=>'required|exists:answers,id'
        ];
    }

    public function execute($data)
    {
        $this->validate($data);
        $answer=Answer::find($data['id']);
        if($answer->is_correct){
            Question::find($answer->question_id)->update([
                'correct_answers' => (Question::find($answer->question_id)->correct_answers - 1)
            ]);
        }
        Answer::find($data['id'])->delete();
        return true;
    }
}

?>