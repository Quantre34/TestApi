<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Device;
use App\Models\User;
use App\Models\Chat;

class AuthController extends Controller
{
    public function Auth(Request $Request){
        $Request->validate([
            'device_uuid'=>'required|string|max:255',
            'device_name'=>'required|string|max:255'
        ]);

        $Device = Device::where('device_uuid', $Request->device_uuid)->first();
        if (!$Device) {
            $Device = Device::create([
                'device_uuid' => $Request->device_uuid,
                'device_name' => $Request->device_name
            ]);
        }

        if (!$Device->user) {
            $User = User::create([
                'is_premium' => false,
                'chat_credit' => 0
            ]);

            $Device->user_id = $User->id;
            $Device->save();
        } else {
            $User = $Device->user;
            if (!$User->chat_credit > 0) {
                $User->is_premium = false;
                $User->save();
            }
        }
        $Chats = Chat::where('user_id', $User->id)->get();
        $token = $User->createToken(Str::random(10))->plainTextToken;

        return response()->json([
            'outcome'=>true,
            'token'=>$token,
            'is_premium' => $User->is_premium,
            'chat_credit' => $User->chat_credit,
            'history' => $Chats
        ],200);


    }
}
