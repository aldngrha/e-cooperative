<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositRequest;
use App\Models\DepositVoluntary;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    public function index(Request $request) {
        return view("pages.deposit");
    }

    public function process(DepositRequest $request) {

        DepositVoluntary::create([
            "users_id" => Auth::user()->id,
            "description" => $request->input("description")
        ]);

        return back()->with("message", "Berhasil menyimpan uang pada simpanan pokok");
    }
}
