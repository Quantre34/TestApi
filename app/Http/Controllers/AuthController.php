<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Device;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AuthController extends Controller
{

    /**
    * @OA\Post(
    *     path="/api/auth",
    *     summary="Authenticate the user using sanctum and creates a token",
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             @OA\Property(property="device_uuid", type="string"),
    *             @OA\Property(property="device_name", type="string")
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Successful authentication",
    *         @OA\JsonContent(
    *             @OA\Property(property="outcome", type="boolean"),
    *             @OA\Property(property="token", type="text"),
    *             @OA\Property(property="history", type="text"),
    *             @OA\Property(property="is_premium", type="text"),
    *             @OA\Property(property="chat_credit", type="number")
    *         )
    *     )
    * )
    */
    public function Authenticate(Request $Request){
        $Credentials = $Request->validate([
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
                'is_premium' => '0',
                'chat_credit' => 0
            ]);

            $Device->user_id = $User->id;
            $Device->save();
        } else {
            $User = $Device->user;
            if ($User->chat_credit <= 0) {
                $User->is_premium = '0';
                $User->save();
            }
        }

        $Chats = Chat::where('user_id', $User->id)->get();
        $token = $User->createToken(Str::random(10))->plainTextToken;

        return response()->json([
            'outcome'=>true,
            'token'=>$token,
            'history' =>$Chats,
            'is_premium'=>$User->is_premium,
            'chat_credit'=>$User->chat_credit,
        ],200);


    }
}
