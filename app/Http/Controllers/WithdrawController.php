<?php

namespace App\Http\Controllers;

use App\Models\Capital;
use App\Models\DepositMust;
use App\Models\DepositVoluntary;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\Spend;
use App\Models\Surplus;
use App\Models\User;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function index() {
        return view("pages.withdraw");
    }

    public function getData(Request $request) {

        $year = $request->input("year");

        // Arus Kas
        $surplus = [
            "income" => 0,
            "outcome" => 0,
        ];

        // Hitung total income
        $installment = Installment::whereYear("created_at", $year)->sum("amount_installment");
        $rateNow = Installment::whereYear("created_at", $year)->sum("interest_rate");
        $deposit = User::whereYear("created_at", $year)->sum("amount_deposit");
        $depositMust = DepositMust::whereYear("created_at", $year)->sum("amount_deposit");
        $depositVoluntary = DepositVoluntary::whereYear("created_at", $year)->sum("amount_deposit");
        $capital = Capital::whereYear("created_at", $year)->sum("amount_capital");
        $surplus["income"] = $installment + $rateNow + $deposit + $depositMust + $depositVoluntary + $capital;
        // Hitung total outcome
        $loan = Loan::whereYear("created_at", $year)->sum("amount_loan");
        $expense = Spend::whereYear("created_at", $year)->sum("amount_spend");
        $withdraw = Surplus::whereYear("created_at", $year)->sum("amount_withdraw");
        $surplus["outcome"] = $loan + $expense + $withdraw;
//
        $hold = Capital::where("description", "Saldo awal tahun")->whereYear("created_at", $year)->sum("amount_capital");

        // Saldo bulan
        $total = $surplus["income"] - $surplus["outcome"];

        $income = $surplus["income"];

        $outcome = $surplus["outcome"];

        return response()->json([
            "income" => $income,
            "outcome" => $outcome,
            "total" => $total,
            "withdraw" => $withdraw,
            "hold" => $hold
        ]);
    }
}
