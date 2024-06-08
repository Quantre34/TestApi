<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Package;
use App\Models\Device;
use App\Http\Controllers\AuthController;

class SubscriptionController extends Controller
{

    /**
    * @OA\Post(
    *     path="/api/subscribe",
    *     summary="Store the transaction info and give user these package has",
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             @OA\Property(property="chatId", type="string"),
    *             @OA\Property(property="message", type="string")
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Subscription successful",
    *         @OA\JsonContent(
    *             @OA\Property(property="outcome", type="boolean"),
    *             @OA\Property(property="Message", type="text")
    *         )
    *     )
    * )
    */
    public function __construct(Request $Request){

        $this->middleware('auth:sanctum');
        $this->User = Auth('sanctum')->user();
    }

    public function Subscribe(Request $Request){

        $Request->validate([
            'productId'=>'required|string',
            'receiptToken'=>'required|string'
        ]);

        $Package = Package::find($Request->productId);
        if ($this->User && $Package) {
            $this->User->is_premium = '1';
            $this->User->chat_credit += $Package->chat_credit;
            $this->User->save();

            Transaction::create([
                'user_id' => $this->User->id,
                'package_id' => $Package->id,
                'amount' => $Package->cost,
                'ConversationId'=>$Request->receiptToken //a lot of payment provider use TransactionId and ConversationId, thats why i named it ConversationId
            ]);
            return response()->json(['outcome'=>true,'Message' => 'Subscription successful'], 200);
        }
        return response()->json(['outcome'=>false,'ErrorMessage' => 'Invalid user or package'], 400);        
    }
}
