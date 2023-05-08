<?php

namespace App\Services\Allowed_user;

use App\Models\AllowedUser;
use App\Services\BasicService;

class DestroyAllowed  extends BasicService
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:allowed_users,id'
        ];
    }

    public function execute($data)
    {
        $this->validate($data);
        AllowedUser::find($data['id'])->delete();
        return true;
    }
}
