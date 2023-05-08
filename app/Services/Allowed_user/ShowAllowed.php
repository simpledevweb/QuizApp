<?php 
namespace App\Services\Allowed_user;

use App\Models\AllowedUser;
use App\Services\BasicService;

class ShowAllowed  extends BasicService
{
    public function rules(): array
    {
        return [
            'id'=>'required|exists:allowed_users,id'
        ];
    }

    public function execute($data)
    {
        $this->validate($data);
        return AllowedUser::find($data['id']);
    }
}

?>