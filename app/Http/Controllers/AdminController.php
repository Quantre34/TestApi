<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['Admin']);
    }

    public function viewTransactions()
    {
        $transactions = Transaction::all();
        return response()->json($transactions);
    }
}
