<?php 
namespace App\Services\Collection;

use App\Models\Collection;
use App\Services\BasicService;

class ShowCollection extends BasicService
{
    public function rules(): array
    {
        return [
            'id'=>'required|exists:collections,id',
        ];
    }

    public function execute(array $data)
    {
        $this->validate($data);
        return Collection::where('id',$data['id'])->withTrashed()->first();
    }
}

?>