<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Package;

class SubscriptionController extends Controller
{


    public function __construct(){

        //$this->middleware('auth:sanctum');
    }

       public function Subscribe(Request $Request)
    {
        $User = Auth::user();
        $Package = Package::find($Request->productId);
        if ($User && $Package) {
            $User->is_premium = true;
            $User->chat_credit += $Package->chat_credit;
            $User->save();

            Transaction::create([
                'user_id' => $User->id,
                'package_id' => $Package->id,
                'amount' => $Package->price,
                'ConversationId'=>$Request->receiptToken //a lot of payment provider use TransactionId and ConversationId, thats why i named it ConversationId
            ]);
            return response()->json(['outcome'=>true,'Message' => 'Subscription successful'], 200);
        }
        return response()->json(['outcome'=>false,'ErrorMessage' => 'Invalid user or package'], 400);        
    }
}
