<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\DepositVoluntary;
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
        $user = User::with(
            "loans.installments"
        )->where("id", Auth::user()->id)->firstOrFail();

        $due_date = $user->loans()->pluck("due_date")->map(function ($date) {
            return Carbon::parse($date)->isoFormat("dddd, D MMMM YYYY");
        });

        $option = Option::firstOrFail();

        $total = $user->loans()->sum("amount_loan");
        $paid_off = $user->loans()->where("status", "LUNAS")->sum("amount_loan");

        $rate = ($total * $option->interest_rate) / 100;
        $rate_paid = ($paid_off * $option->interest_rate) / 100;

        $total_paid_off = $rate_paid + $paid_off;

        $total_rate = $rate + $total - $total_paid_off;

        $installment = $total_rate;

        $installments = $user->loans()->with(["installments"])->get()->pluck('installments')->collapse();

        $total_installment = $installments->sum("amount_installment");

        $total_interest = $installments->sum("interest_rate");

        $installment_number = $installments->count() + 1;

        $remaining  = $total_rate - ($total_installment + $total_interest);

        if ($installment > 0) {
            $result = $installment / $option->time_period;
        } else {
            $result = $installment;
        }

        if($user->loans->where("status", "LUNAS")->count() > 0) {
           $remaining += $total_rate;
        }

        return view("pages.profile-loan", [
            "user" => $user,
            "total" => $total - $paid_off,
            "due_date" => $due_date,
            "rate" => $rate - $rate_paid,
            "total_rate" => $total_rate,
            "result" => $result,
            "installment_number" => $installment_number,
            "remaining" => $remaining,
            "option" => $option,
        ]);
    }
}

