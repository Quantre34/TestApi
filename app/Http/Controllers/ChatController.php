<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{



    /**
    * @OA\Post(
    *     path="/api/chat",
    *     summary="Creates Chat responses for the authenticated and Subscribed user only",
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             @OA\Property(property="chatId", type="string"),
    *             @OA\Property(property="message", type="string")
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Here's your response",
    *         @OA\JsonContent(
    *             @OA\Property(property="outcome", type="boolean"),
    *             @OA\Property(property="Message", type="text")
    *         )
    *     )
    * )
    */
    public function __construct(){
        $this->middleware('auth:sanctum');
        $this->User = Auth('sanctum')->user();
    }

    public function Chat(Request $Request){

        $Request->validate([
            'chatId'=>'required|string',
            'message'=>'required|string'
        ]);

        if ($this->User->chat_credit <= 0) {
            return response()->json(['outcome'=>false, 'ErrorMessage' => 'Insufficient credits'], 200);
        }

        $this->User->chat_credit -= 1; /// Device can be change, even so the chat credit wont go away
        $this->User->save();

        $Response = 'Im the AI and here is ur answer ...';

        return response()->json(['outcome'=>true,'Message' => $Response], 200);
    }
}
