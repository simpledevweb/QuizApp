<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\BasicService;
use Illuminate\Support\Facades\DB;

class UpdateCategory extends BasicService
{

    public function rules(): array
    {
        return [
            'name' => 'required',
            'id'=> 'required|exists:categories,id'
        ];
    }

    public function execute(array $data)
    {
        $this->validate($data);
        Category::where('id',$data['id'])->update([
            'name'=>$data['name']
        ]);
        return true;
    }
}

?>