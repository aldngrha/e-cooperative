<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstallmentRequest;
use App\Models\Installment;
use App\Models\Option;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $installments = Installment::with(['loans.members'])
            ->orderBy("created_at", "DESC")
            ->get();
        $option = Option::find(1)->interest_rate;

        return view("pages.admin.installment.index", [
            "items" => $installments,
            "option" => $option
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
        $users = User::with(["loans.installments"])->findOrFail($id);

        return view("pages.admin.installment.installment-detail", [
            "users" => $users
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
        $option = Option::find(1)->interest_rate;

        $installment = Installment::with(["loans.members"])->findOrFail($id);

        $nominal = ($installment->loans->amount_loan * $option) / 100;

        $interest = ($nominal * $option) / 100;

        return view("pages.admin.installment.edit", [
            "installment" => $installment,
            "nominal" => $nominal,
            "interest" => $interest
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InstallmentRequest $request, $id)
    {
        $data = $request->all();
        $installment = Installment::findOrFail($id);
        $installment->update($data);

        $remainingLoanBalance = $installment->remaining - $request->input('amount_installment');
        $installment->remaining = $remainingLoanBalance;
        $installment->save();

        return redirect()->route("installment.index")->with("message", "Berhasil memasukkan nominal pembayaran angsuran");
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
        $items = Installment::with(["loans.members"])
            ->whereBetween("created_at", [$firstDate, $lastDate])
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

        $amount = $items->sum("amount_installment");
        $interest = $items->sum("remaining");
        $amount_installment = ($amount * $option) / 100 + $amount;

        $rate = ($interest * $option) / 100 + $interest;

        return view("pages.admin.installment.print", [
            "items" => $items,
            "month" => $month,
            "year" => $year,
            "amount_installment" => $amount_installment,
            "rate" => $rate,
            "option" => $option
        ]);
    }
}
