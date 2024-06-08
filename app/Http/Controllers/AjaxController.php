<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{

    function __construct(){

        $this->action = request('action');

        if (!empty(Auth()->user())){
            $this->User = Auth()->user();
            
        }

    }
    public function Init(Request $Request){

        if ($this->action=='Login') {
            $credentials = $Request->only('email', 'password');
 
            if (Auth::attempt($credentials)) {
                $this->User =  Auth()->user();
                $this->User->assignRole('Admin');
                $result = ['outcome'=>true,'Session-Initiated'=>now(),'Info'=>$this->User];
                if ($this->User->hasRole('Admin')) {
                    $result['route'] = '/panel';
                }
            }else {
                $result = ['outcome'=>false,'ErrorMessage'=>'User Not Found'];
            }
            return response()->json($result, 200);
        }
    }
}
