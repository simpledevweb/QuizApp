<?php 
namespace App\Services\Allowed_user;

use App\Models\AllowedUser;
use App\Services\BasicService;

class IndexAllowed  extends BasicService
{
    public function rules(): array
    {
        return [];
    }

    public function execute()
    {
        return AllowedUser::all();
    }
}

?>