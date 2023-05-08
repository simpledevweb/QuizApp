<?php 
namespace App\Services\Question;

use App\Models\Question;
use App\Services\BasicService;

class DestroyQuestion extends BasicService
{
    public function rules():array
    {
        return [
            'id'=>'required|exists,questions,id'
        ];
    }

    public function execute(array $data):bool
    {
        $question=Question::find($data['id']);
        $answers=$question->answers();
        $answers->delete();
        $question->delete();
        return true;
    }

}

?>