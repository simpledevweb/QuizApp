<?php 

namespace App\Services\Collection;

use App\Models\Collection;
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
        $category=Collection::find($data['id']);
        $category->delete();
        return true;
    }
}
?>