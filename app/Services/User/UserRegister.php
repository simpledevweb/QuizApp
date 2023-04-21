<?php 
namespace App\Services\User;

use App\Models\User;
use App\Services\BasicService;

class UserRegister extends BasicService
{
    public function rules(): array
    {
        return [
            'name'=> 'required',
            'phone'=> 'required|unique:users,phone',
            'email'=> 'required|unique:users,email',
            'password'=>'required'
        ];
    }

    public function execute(array $data): array
    {
        $this->validate($data,$this->rules());
        $user=User::create([
            'name'=>$data['name'],
            'phone'=>$data['phone'],
            'email'=>$data['email'],
            'password'=>$data['password'],
            'is_premium'=>false,
            'is_admin'=>false 
        ]);
        $token=$user->createToken('user model', ['user'])->plainTextToken;
        return [$user,$token]; 
    }
}

?>