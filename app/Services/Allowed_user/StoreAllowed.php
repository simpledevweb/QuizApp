<?php 
namespace App\Services\Allowed_user;

use App\Models\AllowedUser;
use App\Services\BasicService;
use Illuminate\Validation\ValidationException;

class StoreAllowed  extends BasicService
{
    public function rules(): array
    {
        return [
            'user_id'=>'required|exists:users,id',
            'collection_id'=>'required|exists:collections,id'
        ];
    }

    public function execute($data)
    {
        $this->validate($data);
        $allowed=AllowedUser::where('user_id',$data['user_id'])->where('collection_id',$data['collection_id']);
        if($allowed==null){
            AllowedUser::create([
                'user_id'=>$data['user_id'],
                'collection_id'=>$data['collection_id'],
            ]);
        }else{
            throw ValidationException::withMessages([
                'message' => ['This allowed user is exists'],
            ]);
        }
        return true;
    }
}
