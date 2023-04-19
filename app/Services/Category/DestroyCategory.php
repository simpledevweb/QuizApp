<?php
namespace App\Services\Category;

use App\Models\Category;
use App\Services\BasicService;

class DestroyCategory extends BasicService
{
    public function rules(): array
    {
        return [
            'id'=>'required|exists:categories,id'
        ];
    }

    public function execute(array $data):bool
    {
        $this->validate($data,$this->rules());
        $category=Category::find($data['id']);
        $category->delete();
        return true;
    }
}

?>