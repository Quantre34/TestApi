<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class AdminController extends Controller
{


    public function __construct()
    {
        $this->middleware(['Admin']);
    }

    public function DashBoard(){
        $Transactions = Transaction::all();
        return view('panel.Home',['Transactions'=>$Transactions]);
    }


}
