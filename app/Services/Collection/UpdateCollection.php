<?php

namespace App\Services\Collection;

use App\Models\Category;
use App\Models\Collection;
use App\Services\BasicService;

class UpdateCollection extends BasicService
{
    public function rules(): array
    {
        return [
            'id'=>'required|exists:collections,id',
            'category'=>'required|exists:categorie,name',
            'name'=>'required',
            'description'=>'required',
            'allowed_type'=>'required_with:public,limited users,url',
        ];
    }

    public function execute(array $data)
    {
        $this->validate($data);
        Collection::find($data['id'])->update([
            'category_id'=>Category::where('name',$data['category'])->first()->id,
            'name'=>$data['name'],
            'description'=>$data['description'],
            'allowed_type'=>$data['allowed_type']
        ]);
        return true;
        
    }
}

?>