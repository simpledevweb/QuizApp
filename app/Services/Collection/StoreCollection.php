<?php 
namespace App\Services\Collection;

use App\Models\Collection;
use App\Services\BasicService;
use Illuminate\Support\Str;
class StoreCollection extends BasicService
{
    public function rules(): array
    {
        return [
            'category_id'=>'required|exists:categories,id',
            'user_id'=>'required|exists:users,id',
            'name'=>'required',
            'description'=>'required',
            'code'=>'required|unique:collections,code',
            'allowed_type'=>'required_with:public, url, limited users'
        ];
    }

    public function execute(array $data)
    {
        $data['code']=Str::random(30);
        $this->validate($data);
        return Collection::create([
            'category_id'=>$data['category_id'],
            'user_id'=>$data['user_id'],
            'name'=>$data['name'],
            'description'=>$data['description'],
            'code'=>$data['code'],
            'allowed_type'=>$data['allowed_type'],
        ]);
    }
}

?>