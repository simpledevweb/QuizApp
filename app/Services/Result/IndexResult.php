<?php 
namespace App\Services\Result;

use App\Models\Result;
use App\Services\BasicService;

class IndexResult  extends BasicService
{
    public function rules(): array
    {
        return [];
    }

    public function execute()
    {
        return Result::all();
    }
}

?>