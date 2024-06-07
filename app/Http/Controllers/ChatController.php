<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class ChatController extends Controller
{
    public function Chat(Request $request){

        $request->validate([
            'chatId' => 'required|string|max:255',
            'message' => 'required|text',
        ]);

        $Device = Device::where('device_uuid', $Request->device_uuid)->first();
        if (!$Device->user) {
            return response()->json(['outcome'=>false, 'ErrorMessage' => 'Unauthorized request'], 401);
        }
        $User = $Device->user;
        if ($User->chat_credit <= 0) {
            return response()->json(['outcome'=>false, 'ErrorMessage' => 'Insufficient credits'], 200);
        }

        $User->chat_credit -= 1; /// Device can be change, even so the chat credit wont go away
        $User->save();

        $Response = 'Im the AI and here is ur answer ...';

        return response()->json(['outcome'=>true,'response' => $Response], 200);
    }
}
