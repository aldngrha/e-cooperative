<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\DepositVoluntary;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\Option;
use App\Models\User;
use Carbon\Carbon;
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
            "depositVoluntaries",
            "depositMusts",
        ])->where("id", Auth::user()->id)->firstOrFail();

        $showSumVoluntary = $user->depositVoluntaries()->sum("amount_deposit");
        $showSumMust = $user->depositMusts()->sum("amount_deposit");

        return view("pages.saving", [
            "user" => $user,
            "showSumVoluntary" => $showSumVoluntary,
            "showSumMust" => $showSumMust,
        ]);
    }

    public function loan() {
        $users = User::with([
            "loans"
        ])->where("id", Auth::user()->id)->firstOrFail();

//        $items = Loan::with([
//            "members",
//        ])->orderBy("id", "DESC")->get();

        $user = Auth::user();
        $items = $user->loans()->get();

        $option = Option::firstOrFail();

        return view("pages.profile-loan", [
            "users" => $users,
            "option" => $option,
            "items" => $items
        ]);
    }

    public function installment() {
        $users = User::with(["loans.installments"])
            ->where("id", Auth::user()->id)
            ->firstOrFail();

        return view("pages.profile-installment", [
            "users" => $users
        ]);
    }

    public function withdraw() {
        $users = $users = User::with(["surpluses"])
            ->where("id", Auth::user()->id)
            ->firstOrFail();

        return view("pages.profile-withdraw", [
            "users" => $users
        ]);
    }
}

