<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function printTransactionReport()
    {
        $all_transaction = Transaction::where("status", "completed")->get();

        return view('print')->with([
            "all_transaction" => $all_transaction
        ]);;
    }
}
