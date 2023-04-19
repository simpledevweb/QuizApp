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

    public function execute(array $data):Category
    {
        $this->validate($data,$this->rules());
        //softddeletes  
        return Category::where('id',$data['id'])->withTrashed()->first();
    }
}
?>