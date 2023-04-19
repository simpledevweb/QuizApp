<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\BasicService;
use Illuminate\Validation\ValidationException;

class StoreCategory extends BasicService
{
    public function rules(): array
    {
        return [
            'name' => 'required|unique:categories,name'
        ];
    }

    public function execute(array $data): Category
    {
        $this->validate($data,$this->rules());
        
        return Category::create($data);
    }
}
