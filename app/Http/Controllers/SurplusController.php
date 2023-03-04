<?php

namespace App\Http\Controllers;

use App\Http\Requests\SurplusRequest;
use App\Models\Capital;
use App\Models\Installment;
use App\Models\Option;
use App\Models\Surplus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurplusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $installment = Installment::sum("interest_rate");

        $withdraw = Surplus::where("status", "ACCEPT")
            ->sum("amount_withdraw");

        $capital = Capital::where("description", "Saldo awal tahun")->sum("amount_capital");

//        $totalWithdraw = $withdraw ? $withdraw->amount_withdraw : 0;

        $spend = $capital + $withdraw;

        $total = $installment - $withdraw - $capital;

        if($total < 0) {
            $total += $spend;
        }

        $date = Option::find(1)->date_withdraw;
        $option = Carbon::parse($date)->format("m-d");


        return view("pages.surplus", [
            "rate" => $total,
            "date" => $date,
            "option" => $option
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function process(SurplusRequest $request)
    {
//      Get user ID with loans
        $user = User::with([
            "loans"
        ])->where("id", Auth::user()->id)->firstOrFail();

//      Get all installments
        $installment = Installment::all();

//      Sum rate
        $interest = $installment->sum("interest_rate");

        $withdraw = Surplus::where("status", "ACCEPT")
            ->sum("amount_withdraw");

        $capital = Capital::where("description", "Saldo awal tahun")->sum("amount_capital");

        $rate = $interest - $withdraw - $capital;

        // generate random string of 4 digits
        $random_number = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        // get the first 3 characters of the user's name
        $user_name = substr(str_replace(' ', '', strtoupper(Auth::user()->name)), 0, 3);

        // combine the user's name with the random number
        $surplus_code = $user_name . $random_number;

        // get user loan where status is LUNAS
        $loan = $user->loans->where('status', 'LUNAS')->first();

        // if loan is 0
        if (!$loan) {
            return back()->with('error', 'Anda belum memenuhi syarat untuk melakukan penarikan, silakan melakukan peminjaman terlebih dahulu dan melunasinya');
        }

        // if rate is 0
        if ($rate == 0) {
            return back()->with('error', 'Jumlah saldo bunga tidak ada');
        }

        // get request amount withdraw
        $requested_amount = $request->input("amount_withdraw");

        // if request more than rate
        if ($requested_amount > $rate) {
            return back()->with('error', 'Jumlah penarikan melebihi saldo yang tersedia');
        }

        Surplus::create([
            "users_id" => Auth::user()->id,
            "surplus_code" => $surplus_code,
            "amount_withdraw" => $request->input("amount_withdraw"),
            "status" => $request->input("status", "PENDING")
        ]);

        return redirect()->back()->with("message", "Pengajuan penarikan berhasil, silakan lihat pada menu penarikan");
    }

}
