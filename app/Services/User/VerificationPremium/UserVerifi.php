<?php

namespace App\Services\User\VerificationPremium;

use App\Models\User;
use App\Models\VerifiCode;
use App\Services\BasicService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserVerifi extends BasicService
{
    public function rules(): array
    {
        return [
            'code' => 'required',
        ];
    }

    public function execute($data)
    {
        $user_id = Auth::id();
        $code_req = $data['code'];
        $msg = "";
        $code = VerifiCode::where('user_id', $user_id)->where('count', '<', '5')->first();
        if ($code != null) {
            $code_id = $code['id'];
            $count = $code['count'];
            $time = explode(" ", $code['created_at']);
            $time = explode(":", $time[1]);
            $time_hc = intval($time[0]);
            $time_ic = intval($time[1]) + 5;
            $time_h = intval(Carbon::now()->format('H'));
            $time_i = intval(Carbon::now()->format('i'));
            $count++;
            if (!($time_hc == $time_h && $time_ic >= $time_i)) {
                $msg = "more time than 5min";
            } elseif ($code_req == $code['code']) {
                $msg = "success";
            } elseif ($count == 5) {
                $msg = "more than 5";
            } else {
                $msg = "Incorrect";
            }
            VerifiCode::find($code_id)->update([
                'count' => $count,
                'status' => $msg
            ]);
            if ($msg == "success" || $msg == "more time than 5min" ||  $msg == "more than 5") {
                VerifiCode::find($code_id)->delete();
            }
            if($msg == "success"){
                User::find($user_id)->update([
                    'is_premium'=>true
                ]);
            }
        } else {
            $msg = "Not Found";
        }
        return response([
            'message' => $msg,
        ]);
    }
}
