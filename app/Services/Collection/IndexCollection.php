<?php 

namespace App\Services\Collection;

use App\Services\BasicService;
use App\Models\Collection;
use Illuminate\Database\Eloquent\Collection as Collect;

class IndexCollection extends BasicService
{
    public function rules(): array
    {
        return [];
    }

    public function execute():Collect
    {
        return Collection::all();
    }
}
?>