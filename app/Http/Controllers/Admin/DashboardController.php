<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Capital;
use App\Models\DepositVoluntary;
use App\Models\DepositMust;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\Option;
use App\Models\Spend;
use App\Models\Surplus;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {

        $totalInstallment = Installment::sum("amount_installment");
        $rate = Installment::sum("interest_rate");
        $totalDeposit = User::sum("amount_deposit");
        $totalDepositMust = DepositMust::sum("amount_deposit");
        $totalDepositVoluntary = DepositVoluntary::sum("amount_deposit");
        $totalCapital = Capital::sum("amount_capital");

        $totalLoan = Loan::sum("amount_loan");
        $totalExpense = Spend::sum("amount_spend");
        $totalWithdraw = Surplus::sum("amount_withdraw");

        $loans = Loan::with(["members"])->get();

        $assets = $totalDeposit + $totalInstallment + $totalDepositVoluntary + $totalDepositMust + $totalCapital + $rate;
        $liabilities = $totalLoan + $totalExpense + $totalWithdraw;

        $wealth = $assets - $liabilities;

        $pie = [
            "tertunda" => Loan::where("status", "TERTUNDA")->count(),
            "lunas" => Loan::where("status", "LUNAS")->count(),
            "belum_lunas" => Loan::where("status", "BELUM LUNAS")->count(),
        ];

        return view("pages.admin.dashboard", [
            "assets" => $assets,
            "liabilities" => $liabilities,
            "wealth" => $wealth,
            "rate" => $rate,
            "pie" => $pie,
            "loans" => $loans
        ]);
    }
}
