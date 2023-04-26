<?php

namespace App\Services\Collection;

use App\Models\Collection;
use App\Services\BasicService;

class UpdateCollection extends BasicService
{
    public function rules(): array
    {
        return [
            'id'=>'required|exists:collections,id',
            'category_id'=>'required|exists:categories,id',
            'user_id'=>'required|exists:users,id',
            'name'=>'required',
            'description'=>'required',
            'allowed_type'=>'required_with:public,limited users,url',
        ];
    }

    public function execute(array $data)
    {
        $this->validate($data);
        Collection::find($data['id'])->update([
            'category_id'=>$data['category_id'],
            'user_id'=>$data['user_id'],
            'name'=>$data['name'],
            'description'=>$data['description'],
            'allowed_type'=>$data['allowed_type']
        ]);
        return true;
        
    }
}

?>