<?php 

namespace App\Services\Collection;

use App\Services\BasicService;
use App\Models\Collection;
use Illuminate\Support\Facades\Auth;

class IndexCollection extends BasicService
{
    public function rules(): array
    {
        return [
            'search'=>'nullable',
        ];
    }

    public function execute(array $data)
    {
        $this->validate($data);
        return Collection::with('user')->when($data['search'] ?? null, function($query,$search){
            $query->search($search);
        })->paginate(15);
    }
}
?>