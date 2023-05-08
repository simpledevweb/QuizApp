<?php 

namespace App\Services\Question;

use App\Models\Question;
use App\Services\BasicService;

class IndexQuestion extends BasicService
{
    public function rules(): array
    {
        return [
            'search'=>'nullabel'
        ];
    }

    public function execute(array $data)
    {
        return Question::when($data['search'] ?? null, function($query,$search){
            $query->search($search);
        })->paginate(15);
    }
}
?>