<?php 
namespace App\Services\Category;

use App\Models\Category;
use App\Services\BasicService;

class ShowCategory extends BasicService
{
    public function rules(): array
    {
        return [
            'id'=>'required|exists:categories,id'
        ];
    }

    public function execute(array $data)
    {
        $this->validate($data,$this->rules());
        return Category::where('id',$data['id'])->withTrashed()->first();
    }
}
?>