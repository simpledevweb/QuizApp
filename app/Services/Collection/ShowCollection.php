<?php 
namespace App\Services\Collection;

use App\Models\Collection;
use App\Services\BasicService;
use Illuminate\Support\Facades\Auth;

class ShowCollection extends BasicService
{
    public function rules(): array
    {
        return [
            'id'=>'required|exists:collections,id',
        ];
    }

    public function execute(array $data)
    {
        $this->validate($data);
        $collection = Collection::find($data['id']);
        $questions = $collection->questions;
        return [$collection, $questions];
    }
}

?>