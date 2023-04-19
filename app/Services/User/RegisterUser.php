<?php 
namespace App\Services\User;

use App\Models\User;
use App\Services\BasicService;
use Illuminate\Support\Facades\Hash;

class RegisterUser extends BasicService
{
    public function rules(): array
    {
        return [
            'name'=> 'required',
            'phone'=> 'required|unique:users,phone',
            'password'=>'required',
            'is_admin'=>'required',
            'is_premium'=>'required',
        ];
    }

    public function execute(array $data): User
    {
        $this->validate($data,$this->rules());
        return User::create([
            'name'=>$data['name'],
            'phone'=>$data['phone'],
            'password'=>Hash::make($data['password']),
            'is_premium'=>$data['is_premium'],
            'is_admin'=>$data['is_admin']  
        ]);
    }
}

?>