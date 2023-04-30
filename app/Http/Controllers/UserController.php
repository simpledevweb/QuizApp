<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerifiCode;
use App\Services\User\UserLogin;
use App\Services\User\VerificationPremium\UserSendCode;
use App\Services\User\UserRegister;
use App\Services\User\VerificationPremium\UserVerifi;
use App\Traits\JsonRespondController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    use JsonRespondController;
    public function register(Request $request)
    {
        try {
            [$user, $token] = app(UserRegister::class)->execute([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => $request->password
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
        } catch (ValidationException $exception) {
            return $exception->validator->errors()->all();
        }
    }

    public function show()
    {
        $user = Auth::user();
        return response([
            'id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'email' => $user->email,
            'nameAndphone' => $user->nameAndphone,
        ]);
    }

    public function singIn(Request $request)
    {
        try {
            [$user, $token, $role] = app(UserLogin::class)->execute($request->all());
            return [
                'data' => [
                    'user' => $user,
                    'token' => $token,
                    'role' => $role
                ]
            ];
        } catch (ValidationException $exception) {
            return response([
                'error' => $exception->validator->errors()->all()
            ], 422);
        } catch (\Exception $exception) {
            if ($exception->getCode() == 401) {
                return response([
                    'error' => $exception->getMessage()
                ], $exception->getCode());
            }
        }
    }

    public function sendcode(): Response
    {
        return app(UserSendCode::class)->execute();
    }

    public function verificode(Request $request)
    {
        try{    
            return app(UserVerifi::class)->execute($request->all());
        }catch(ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }
    }
}
