<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Capital;
use App\Models\DepositMust;
use App\Models\DepositVoluntary;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\Spend;
use App\Models\Surplus;
use App\Models\User;
use Illuminate\Http\Request;

class SurplusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("pages.admin.surplus.index");
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
