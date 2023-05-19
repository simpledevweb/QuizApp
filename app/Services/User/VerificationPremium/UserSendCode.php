<?php

namespace App\Services\User\VerificationPremium;

use App\Mail\VerificationPremium;
use App\Models\User;
use App\Models\VerifiCode;
use App\Services\BasicService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserSendCode extends BasicService
{
    public function execute():Response
    {
        $id = Auth::id();
        $user=User::where('id',$id)->first();
        if(!$user->hasVerifiedEmail()){
            return response([
                'message' => 'You must be verifi email',
            ]);
        }else{
        if($user->is_premium){
            // eger premium bolsa
            return response([
                'message' => 'You are premium',
            ]);
        }else{
        $code = VerifiCode::where('user_id', $id)->where('count', '<', '5')->first();
        if ($code != null) {
            // eger kod 1 marteden kop jiberilgen jagday bolsa 
            return response([
                'message' => 'Check your Email.The code has been sent',
            ]);
        } else {
            $code = rand(100, 999);
            $email = Auth::user()->email;
            VerifiCode::create([
                'user_id' => $id,
                'code' => $code,
                'status' => 'send code'
            ]);
            Mail::to($email)->send(new VerificationPremium([
                'code' => $code
            ]));
        }
            return response([
                'success' => 'The code has been sent to your email'
            ]);
        }
    }
    }
}
