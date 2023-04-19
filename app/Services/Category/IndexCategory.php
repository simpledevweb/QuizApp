<?php 
namespace App\Services\Category;

use App\Models\Category;
use App\Services\BasicService;
use Illuminate\Database\Eloquent\Collection;

class IndexCategory  extends BasicService
{
    public function rules(): array
    {
        return [];
    }

    public function execute():Collection
    {
        //all(['id','name','created_at','updated_at'])
        //softddeletes  
        return Category::withTrashed()->get();
    }
}

?>