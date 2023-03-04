<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Capital;
use App\Models\DepositMust;
use App\Models\DepositVoluntary;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\Option;
use App\Models\Spend;
use App\Models\Surplus;
use App\Models\User;
use Illuminate\Http\Request;

class CashFlowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("pages.admin.cash-flow.index");
    }

    public function getData(Request $request) {
        $option = Option::find(1)->interest_rate;

        $month = $request->input("month");
        $year = $request->input("year");

        // Saldo Awal
        $prevMonth = $month - 1;
        $prevYear = $year;
        if ($prevMonth == 0) {
            $prevMonth = 12;
            $prevYear = $year - 1;
        }

        $prevCashFlow = [
            "income" => 0,
            "outcome" => 0,
        ];

        // Hitung total income bulan sebelumnya
        $prevInstallment = Installment::whereMonth("created_at", $prevMonth)->whereYear("created_at", $prevYear)->sum("amount_installment");
        $prevRate = Installment::whereMonth("created_at", $prevMonth)->whereYear("created_at", $prevYear)->sum("interest_rate");
        $prevDeposit = User::whereMonth("created_at", $prevMonth)->whereYear("created_at", $prevYear)->sum("amount_deposit");
        $prevDepositMust = DepositMust::whereMonth("created_at", $prevMonth)->whereYear("created_at", $prevYear)->sum("amount_deposit");
        $prevDepositVoluntary = DepositVoluntary::whereMonth("created_at", $prevMonth)->whereYear("created_at", $prevYear)->sum("amount_deposit");
        $prevCapital = Capital::whereMonth("created_at", $prevMonth)->whereYear("created_at", $prevYear)->sum("amount_capital");
        $prevCashFlow["income"] = $prevInstallment + $prevRate + $prevDeposit + $prevDepositMust + $prevDepositVoluntary + $prevCapital;
        // Hitung total outcome bulan sebelumnya
        $prevLoan = Loan::whereMonth("created_at", $prevMonth)->whereYear("created_at", $prevYear)->sum("amount_loan");
        $prevExpense = Spend::whereMonth("created_at", $prevMonth)->whereYear("created_at", $prevYear)->sum("amount_spend");
        $prevWithdraw = Surplus::whereMonth("created_at", $prevMonth)->whereYear("created_at", $prevYear)->sum("amount_withdraw");
        $prevCashFlow["outcome"] = $prevLoan + $prevExpense + $prevWithdraw;

        // Arus Kas
        $cashFlow = [
            "income" => 0,
            "outcome" => 0,
        ];

        // Hitung total income
        $installment = Installment::whereMonth("created_at", $month)->whereYear("created_at", $year)->sum("amount_installment");
        $rateNow = Installment::whereMonth("created_at", $month)->whereYear("created_at", $year)->sum("interest_rate");
        $deposit = User::whereMonth("created_at", $month)->whereYear("created_at", $year)->sum("amount_deposit");
        $depositMust = DepositMust::whereMonth("created_at", $month)->whereYear("created_at", $year)->sum("amount_deposit");
        $depositVoluntary = DepositVoluntary::whereMonth("created_at", $month)->whereYear("created_at", $year)->sum("amount_deposit");
        $capital = Capital::whereMonth("created_at", $month)->whereYear("created_at", $year)->sum("amount_capital");
        $cashFlow["income"] = $installment + $rateNow + $deposit + $depositMust + $depositVoluntary + $capital;
        // Hitung total outcome
        $loan = Loan::whereMonth("created_at", $month)->whereYear("created_at", $year)->sum("amount_loan");
        $expense = Spend::whereMonth("created_at", $month)->whereYear("created_at", $year)->sum("amount_spend");
        $withdraw = Surplus::whereMonth("created_at", $month)->whereYear("created_at", $year)->sum("amount_withdraw");
        $cashFlow["outcome"] = $loan + $expense + $withdraw;

        $interest = Installment::whereYear("created_at", $year)->sum("interest_rate");

        $totalInstallment = Installment::sum("amount_installment");
        $rate = Installment::sum("interest_rate");
        $totalDeposit = User::sum("amount_deposit");
        $totalDepositMust = DepositMust::sum("amount_deposit");
        $totalDepositVoluntary = DepositVoluntary::sum("amount_deposit");
        $totalCapital = Capital::sum("amount_capital");

        $totalLoan = Loan::sum("amount_loan");
        $totalExpense = Spend::sum("amount_spend");
        $totalWithdraw = Surplus::sum("amount_withdraw");

        $assets = $totalDeposit + $totalInstallment + $totalDepositVoluntary + $totalDepositMust + $totalCapital + $rate;
        $liabilities = $totalLoan + $totalExpense + $totalWithdraw;

        $wealth = $assets - $liabilities;

        // Saldo bulan
        $monthBalance = $cashFlow["income"] - $cashFlow["outcome"];

        // Saldo Akhir
        $endBalance = ($prevCashFlow["income"] - $prevCashFlow["outcome"]);

        return response()->json([
            "month" => $month,
            "year" => $year,
            "installment" => ($installment * $option) / 100 + $installment,
            "deposit" => $deposit,
            "depositMust" => $depositMust,
            "depositVoluntary" => $depositVoluntary,
            "capital" => $capital,
            "interest" => $interest,
            "rate" => $rate,
            "loan" => $loan,
            "totalLoan" => $totalLoan,
            "expense" => $expense,
            "withdraw" => $withdraw,
            "monthBalance" => $monthBalance,
            "balance" => $endBalance,
            "wealth" => $wealth
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
