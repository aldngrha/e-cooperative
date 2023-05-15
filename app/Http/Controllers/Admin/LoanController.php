<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoanRequest;
use App\Models\Loan;
use App\Models\Option;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Loan::with([
            "members",
            "options"
        ])->orderBy("id", "DESC")->get();

        return view("pages.admin.loan.index", [
            "items" => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with(["loans"])->findOrFail($id);

        $items = $user->loans()->get();

        return view("pages.admin.loan.loan-detail", [
            "user" => $user,
            "items" => $items
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loan = Loan::with(["members"])->findOrFail($id);

        return view("pages.admin.loan.edit", [
           "loan" => $loan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LoanRequest $request, $id)
    {
        $data = $request->all();
        $loan = Loan::findOrFail($id);
        $loan->update($data);

        return redirect()->route("loan.index")->with("message", "Berhasil merubah status pinjaman");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function print($firstDate, $lastDate) {
        $defaultMonth = Carbon::parse(request('firstDate'))->locale('id')->monthName;
        $defaultYear = Carbon::parse(request('firstDate'))->year;

        $startDate = Carbon::parse($firstDate)->startOfDay();
        $endDate = Carbon::parse($lastDate)->endOfDay();

        $month = $defaultMonth;
        $year = $defaultYear;

        $items = Loan::with(["members"])
            ->whereBetween("created_at", [$startDate, $endDate])
            ->get();

        $option = Option::find(1)->interest_rate;

        foreach ($items as $item) {
            // membuat instance Carbon dari atribut created_at
            $date = Carbon::parse($item->created_at);

            // mengambil nama bulan dalam bahasa Indonesia
            $month = $date->locale('id')->monthName;

            // mengambil nama tahun
            $year = $date->year;
        }

        $amount_loan = $items->sum("amount_loan");
        $amount_interest = (($amount_loan * $option) / 100) + $amount_loan;

        return view("pages.admin.loan.print", [
            "items" => $items,
            "option" => $option,
            "month" => $month,
            "year" => $year,
            "amount_loan" => $amount_loan,
            "amount_interest" => $amount_interest
        ]);
    }
}
