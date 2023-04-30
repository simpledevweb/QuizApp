<?php
namespace App\Services\User;

use App\Models\User;
use App\Services\BasicService;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserLogin extends BasicService
{
    public function rules(): array
    {
        return [
            'phone'=>'required',
            'password'=>'required'
        ];
    }

    public function execute(array $data)
    {
        $this->validate($data);
        $user=User::where('phone',$data['phone'])->first();
        if(!$user or !Hash::check($data['password'], $user->password)){
            throw new Exception("User not found or password incorrect", 401);
        }
        $role=$user->is_admin?'admin':'user';
        $token=$user->createToken('user model',[$role])->plainTextToken;
        return [$user,$token,$role];
    }
}
?>