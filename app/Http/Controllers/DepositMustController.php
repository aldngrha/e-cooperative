<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositMustRequest;
use App\Models\DepositMust;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositMustController extends Controller
{
    public function index(Request $request) {;
        return view("pages.deposit-must");
    }

    public function process(DepositMustRequest $request) {

        DepositMust::create([
            "users_id" => Auth::user()->id,
            "amount_deposit" => $request->input("amount_deposit"),
            "description" => $request->input("description")
        ]);

        return back()->with("message", "Berhasil menyimpan uang pada simpanan wajib");
    }
}
