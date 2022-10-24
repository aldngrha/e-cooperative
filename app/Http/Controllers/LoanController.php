<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRequest;
use App\Models\Loan;
use App\Models\Option;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index(Request $request) {
        $options = Option::all();
        return view("pages.loan", [
            "options" => $options,
        ]);
    }

    public function process(LoanRequest $request) {

        Loan::create([
            "users_id" => Auth::user()->id,
            "option_id" => 1,
            "amount_loan" => $request->input("amount_loan"),
            "description" => $request->input("description"),
            "status" => $request->input("status", "PENDING")
        ]);

        return back()->with("message", "Pengajuan pinjaman berhasil, silakan lihat pada menu pinjaman");
    }
}
