<?php 
namespace App\Services\Answer;

use App\Models\Answer;
use App\Services\BasicService;

class IndexAnswer  extends BasicService
{
    public function rules(): array
    {
        return [];
    }

    public function execute()
    {
        return Answer::all();
    }
}

?>