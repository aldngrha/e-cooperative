<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\DepositMust;
use App\Models\Loan;
use App\Models\Option;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $deposit = Deposit::all();
        $depositMust = DepositMust::all();
        $loan = Loan::all();
        $option = Option::firstOrFail();
        $loans = Loan::with(["members"])->orderBy("id", "DESC")->take(10)->get();

        $amount_deposit = $deposit->sum("amount_deposit");
        $amount_deposit_must = $depositMust->sum("amount_deposit");

        $loan_status_paid = $loan->where("status", "LUNAS")->sum("amount_loan");
        $loan_status_pending = $loan->where("status", "TERTUNDA")->sum("amount_loan");
        $amount_loan = $loan->sum("amount_loan");

        $rate = $option->interest_rate;
        $total_loan = $amount_loan - $loan_status_paid - $loan_status_pending;
        $with_rate = ($loan_status_paid * $rate) / 100 + $loan_status_paid;
        $total_saldo = $amount_deposit + $amount_deposit_must - $amount_loan + $with_rate + $loan_status_pending;

        $pie = [
            "tertunda" => Loan::where("status", "TERTUNDA")->count(),
            "lunas" => Loan::where("status", "LUNAS")->count(),
            "belum_lunas" => Loan::where("status", "BELUM LUNAS")->count(),
        ];

        return view('pages.home', [
            "loans" => $loans,
            "total" => $total_saldo,
            "deposit" => $amount_deposit,
            "deposit_must" => $amount_deposit_must,
            "total_loan" => $total_loan,
            "pie" => $pie
        ]);
    }
}
