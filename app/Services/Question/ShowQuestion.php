<?php 
namespace App\Services\Question;

use App\Models\Question;
use App\Services\BasicService;

class ShowQuestion extends BasicService
{
    public function rules(): array
    {
        return [
            'id'=>'required|exists:questions,id',
        ];
    }

    public function execute(array $data)
    {
        $this->validate($data);
        $question = Question::find($data['id']);
        $answers = $question->answers;
        return [$question, $answers];
    }

}
