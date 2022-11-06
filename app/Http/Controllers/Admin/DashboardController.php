<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\DepositMust;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {

        $deposit = Deposit::all();
        $depositMust = DepositMust::all();
        $loan = Loan::with(["options"])->firstOrFail();
        $loans = Loan::with(["members"])->orderBy("id", "DESC")->take(10)->get();

        $amount_deposit = $deposit->sum("amount_deposit");
        $amount_deposit_must = $depositMust->sum("amount_deposit");

        $loan_status = $loan->where("status", "LUNAS")->sum("amount_loan");
        $amount_loan = $loan->sum("amount_loan");
        $rate = $loan->options->interest_rate;
        $total_loan = $amount_loan - $loan_status;
        $with_rate = ($loan_status * $rate) / 100 + $loan_status;
        $total_saldo = $amount_deposit + $amount_deposit_must - $amount_loan + $with_rate;

        $pie = [
            "tertunda" => Loan::where("status", "TERTUNDA")->count(),
            "lunas" => Loan::where("status", "LUNAS")->count(),
            "belum_lunas" => Loan::where("status", "BELUM LUNAS")->count(),
        ];

        return view("pages.admin.dashboard", [
            "total" => $total_saldo,
            "deposit" => $amount_deposit,
            "deposit_must" => $amount_deposit_must,
            "total_loan" => $total_loan,
            "loans" => $loans,
            "pie" => $pie,
        ]);
    }
}
