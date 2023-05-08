<?php 
namespace App\Services\Result;

use App\Models\Result;
use App\Services\BasicService;

class ShowResult  extends BasicService
{
    public function rules(): array
    {
        return [
            'id'=>'required|exists:results,id'
        ];
    }

    public function execute($data)
    {
        $this->validate($data);
        return Result::find($data['id'])->first();
    }
}

?>