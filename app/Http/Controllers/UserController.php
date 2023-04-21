<?php

namespace App\Http\Controllers;

use App\Services\User\UserLogin;
use App\Services\User\UserRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try{
            [$user,$token]=app(UserRegister::class)->execute([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'password'=>$request->password
            ]);
            return response([
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'email' => $user->email,
                    'token' => $token,
                ]
            ]);
        }catch (ValidationException $exception) {
            return $exception->validator->errors()->all();
        }
        
    }

    public function show()
    {
            $user=Auth::user();
            return response([
                'id'=>$user->id,
                'name'=>$user->name,
                'phone'=>$user->phone,
                'email'=>$user->email,
                'nameAndphone'=>$user->nameAndphone,
            ]);
    }

    public function singIn(Request $request)
    {
        try {
            [$user,$token,$role]=app(UserLogin::class)->execute($request->all());
            return [
                'data'=>[
                    'user'=>$user,
                    'token'=>$token,
                    'role'=>$role
                ]
                ];
        } catch (ValidationException $exception) {
            return response([
                'error'=>$exception->validator->errors()->all()
            ],422);
        }catch(\Exception $exception){
            if($exception->getCode()==401){
                return response([
                    'error'=>$exception->getMessage()
                ],$exception->getCode());
            }
        }
    }
}
