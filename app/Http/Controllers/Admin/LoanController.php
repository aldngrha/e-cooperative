<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoanRequest;
use App\Models\Loan;
use App\Models\Option;
use App\Models\User;
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
        $user = User::with(["loans"])->findOrFail($id);
        $loan = Loan::with(["options"])->findOrFail($id);

        $total = $user->loans()->sum("amount_loan");
        $paid_off = $user->loans()->where("status", "LUNAS")->sum("amount_loan");
        $rate = ($total * $loan->options->interest_rate) / 100;
        $rate_paid = ($paid_off * $loan->options->interest_rate) / 100;

        $total_paid_off = $rate_paid + $paid_off;

        $total_rate = $rate + $total - $total_paid_off;

        return view("pages.admin.loan.loan-detail", [
            "user" => $user,
            "loan" => $loan,
            "total" => $total - $paid_off,
            "rate" => $rate - $rate_paid,
            "total_rate" => $total_rate
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
        $loan = Loan::findOrFail($id);

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

        return redirect()->route("loan.index");
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
