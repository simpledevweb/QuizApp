<?php 
namespace App\Services\Answer;

use App\Models\Answer;
use App\Services\BasicService;

class ShowAnswer  extends BasicService
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
        return Answer::find($data['id']);
    }
}

?>