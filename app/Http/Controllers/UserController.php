<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Deposit;
use App\Models\Loan;
use App\Models\Option;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit() {
        return view("pages.member");
    }

    public function update(UserRequest $request) {
        $data = $request->all();
        auth()->user()->update($data);
        return back()->with("message", "Profil sudah diubah");
    }

    public function saving() {
        $user = User::with([
            "deposits",
            "depositMusts",
        ])->where("id", Auth::user()->id)->firstOrFail();

        $showSum = $user->deposits()->sum("amount_deposit");
        $showSumMust = $user->depositMusts()->sum("amount_deposit");

        return view("pages.saving", [
            "user" => $user,
            "showSum" => $showSum,
            "showSumMust" => $showSumMust,
        ]);
    }

    public function loan() {
        $user = User::with([
            "loans"
        ])->where("id", Auth::user()->id)->firstOrFail();

        $loan = Loan::all();
        $option = Option::firstOrFail();

        $total = $user->loans()->sum("amount_loan");
        $paid_off = $user->loans()->where("status", "LUNAS")->sum("amount_loan");

        $rate = ($total * $option->interest_rate) / 100;
        $rate_paid = ($paid_off * $option->interest_rate) / 100;

        $total_paid_off = $rate_paid + $paid_off;

        $total_rate = $rate + $total - $total_paid_off;

        return view("pages.profile-loan", [
            "user" => $user,
            "total" => $total - $paid_off,
            "loan" => $loan,
            "rate" => $rate - $rate_paid,
            "total_rate" => $total_rate,
            "option" => $option
        ]);
    }
}

