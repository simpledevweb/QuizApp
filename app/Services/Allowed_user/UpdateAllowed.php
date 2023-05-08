<?php 
namespace App\Services\Allowed_user;

use App\Models\AllowedUser;
use App\Services\BasicService;
use Illuminate\Validation\ValidationException;

class UpdateAllowed  extends BasicService
{
    public function rules(): array
    {
        return [
            'id'=>'required|exists:allowed_users,id',
            'user_id'=>'required|exists:users,id',
            'collection_id'=>'required|exists:collections,id'
        ];
    }

    public function execute($data)
    {
        $this->validate($data);
            AllowedUser::find($data['id'])->update([
                'user_id'=>$data['user_id'],
                'collection_id'=>$data['collection_id'],
            ]);
        return true;
    }
}
