<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\User\RegisterUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try{
            $user=app(RegisterUser::class)->execute([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'password'=>$request->password,
                'is_premium'=>$request->is_premium,
                'is_admin'=>$request->is_admin
            ]);
            return new UserResource($user);
        }catch (ValidationException $exception) {
            return $exception->validator->errors()->all();
        }
        
    }
}
