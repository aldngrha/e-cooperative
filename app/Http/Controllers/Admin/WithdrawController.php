<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CapitalRequest;
use App\Http\Requests\SurplusRequest;
use App\Models\Capital;
use App\Models\Installment;
use App\Models\Surplus;
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
        $withdraws = Surplus::with(["members"])->get();
        $latestInstallment = Installment::latest('created_at')->first();
        $installment = Installment::pluck("interest_rate")->sum() + $latestInstallment->amount_installment;

        $totalWithdraw = 0;
        foreach($withdraws as $withdraw) {
            $totalWithdraw += $withdraw->amount_withdraw;
        }

        $total = $installment - $totalWithdraw;

        return view("pages.admin.withdraw.index", [
            "withdraws" => $withdraws,
            "total" => $total
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
        $withdraws = Surplus::all();
        $latestInstallment = Installment::latest('created_at')->first();
        $installment = Installment::pluck("interest_rate")->sum() + $latestInstallment->amount_installment;

        $totalWithdraw = 0;
        foreach($withdraws as $withdraw) {
            $totalWithdraw += $withdraw->amount_withdraw;
        }

        $total = $installment - $totalWithdraw;

        Capital::create([
            "surplus_id" => null,
            "amount_capital" => $total,
            "description" => "Saldo awal tahun"
        ]);

        Installment::query()->update(["interest_rate" => null]);

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
}
