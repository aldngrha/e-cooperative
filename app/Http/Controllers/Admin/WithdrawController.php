<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CapitalRequest;
use App\Http\Requests\SurplusRequest;
use App\Models\Capital;
use App\Models\Installment;
use App\Models\Option;
use App\Models\Surplus;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all previous withdrawals
        $withdraws = Surplus::with('members')
            ->orderBy('created_at', 'desc')
            ->get();

        // Get the total balance of interest
        $totalInterest = Installment::sum('interest_rate');

        // Get the total amount of previous withdrawals that have been accepted
        $latestWithdraw = $withdraws->where('status', 'ACCEPT')->first();

        $lastWithdrawAmount = $latestWithdraw ? $latestWithdraw->amount_withdraw : 0;

        $remainingInterest = $totalInterest - $lastWithdrawAmount;

        if ($remainingInterest < 0) {
            $remainingInterest += $lastWithdrawAmount;
        }

        // Get the date of the next withdrawal
        $option = Option::find(1);
        $date = $option->date_withdraw;
        $withdrawDate = Carbon::parse($date)->format('m-d');

        return view("pages.admin.withdraw.index", [
            "withdraws" => $withdraws,
            "total" => $remainingInterest,
            "option" => $withdrawDate
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        // Get the total balance of interest
        $totalInterest = Installment::sum('interest_rate');

        // Get the total amount of previous withdrawals that have been accepted
        $latestWithdraw = Surplus::where('status', 'ACCEPT')
            ->orderBy("created_at", "desc")
            ->first();

        $totalWithdrawn = $latestWithdraw ? $latestWithdraw->amount_withdraw : 0;

        // Calculate the remaining balance of interest after previous withdrawals
        $remainingInterest = $totalInterest - $totalWithdrawn;

        Capital::create([
            "surplus_id" => null,
            "amount_capital" => $remainingInterest,
            "description" => "Saldo awal tahun"
        ]);

        // Set the interest rates of all installments to null
        Installment::where("interest_rate", ">", 0)->update(['interest_rate' => 0]);

        return redirect()->route("withdraw.index")->with("message", "Berhasil menambahkan ke saldo awal tahun");
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
        $withdraw = Surplus::with(["members"])->findOrFail($id);

        return view("pages.admin.withdraw.edit", [
            "withdraw" => $withdraw
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SurplusRequest $request, $id)
    {
        $data = $request->all();
        $withdraw = Surplus::findOrFail($id);
        $previousStatus = $withdraw->status;
        $withdraw->update($data);

        // check if the status has changed to ACCEPT from previous status
        if ($withdraw->status == 'ACCEPT' && $previousStatus != 'ACCEPT') {
            // divide the withdrawal amount by 2
            $capitalAmount = $withdraw->amount_withdraw / 2;

            // add a new record to the Capital table
            Capital::create([
                "surplus_id" => $withdraw->id,
                "amount_capital" => $capitalAmount,
                "description" => "50% dari penarikan SHU"
            ]);
        }

        return redirect()->route("withdraw.index")->with("message", "Berhasil merubah status penarikan");
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

    public function print($firstDate, $lastDate) {
        $items = Surplus::with(["members"])
            ->whereBetween("created_at", [$firstDate, $lastDate])
            ->get();

        foreach ($items as $item) {
            // membuat instance Carbon dari atribut created_at
            $date = Carbon::parse($item->created_at);

            // mengambil nama bulan dalam bahasa Indonesia
            $month = $date->locale('id')->monthName;

            // mengambil nama tahun
            $year = $date->year;
        }

        $amount_withdraw = $items->sum("amount_withdraw");

        return view("pages.admin.withdraw.print", [
            "items" => $items,
            "month" => $month,
            "year" => $year,
            "amount_withdraw" => $amount_withdraw,
        ]);
    }
}