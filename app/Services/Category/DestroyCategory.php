<?php
namespace App\Services\Category;

use App\Models\Category;
use App\Services\BasicService;
use App\Services\Collection\DestroyCollection;
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
        $this->validate($data);
        $category=Category::find($data['id']);
        $collections=$category->collections;
        foreach ($collections as $collection) {
            app(DestroyCollection::class)->execute([
                'id' => $collection->id,
            ]);
        }
        $category->delete();
        return true;
    }
}

?>