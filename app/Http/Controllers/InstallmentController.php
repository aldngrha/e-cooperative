<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstallmentRequest;
use App\Http\Requests\UserRequest;
use App\Models\Installment;
use App\Models\Option;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class InstallmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with(["installments"])
            ->where("id", Auth::user()->id)
            ->firstOrFail();

        $count = $user->installments->count() + 1;

        return view("pages.installment", [
            "count" => $count,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(InstallmentRequest $request)
    {

        $user = User::with(["installments"])
            ->where("id", Auth::user()->id)
            ->firstOrFail();

//        $option = Option::find(1)->time_period;
//
//        if ($user->installments->count() >= $option) {
//            return redirect()->back()->withErrors(['error' => 'Anda sudah mencapai batas maksimal angsuran']);
//        }

        $loan = User::with(["loans"])
            ->where("id", Auth::user()->id)
            ->firstOrFail();

        $amount = $user->loans->sum("amount_loan");

        if ($amount == 0) {
            return back()->with("error", "Kamu belum memiliki pinjaman");
        }

        $installment_number = $user->installments->count() + 1;

        Installment::create([
            "users_id" => $user->id,
            "installment_number" => $installment_number,
            "description" => $request->input("description")
        ]);

        return back()->with("message", "Berhasil membayar angsuran");
    }
}
