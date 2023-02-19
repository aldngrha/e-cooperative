<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRequest;
use App\Models\Loan;
use App\Models\Option;
use App\Models\User;
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

        $user = User::with(["loans"])
            ->where("id", Auth::user()->id)
            ->firstOrFail();

        // generate random string of 4 digits
        $random_number = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        // get the first 3 characters of the user's name
        $user_name = substr(str_replace(' ', '', strtoupper(Auth::user()->name)), 0, 3);

        // combine the user's name with the random number
        $loan_code = $user_name . $random_number;

        $option = Option::find(1)->time_period;
        $due_date = Carbon::now()->addMonths($option);

        if($user->loans->whereIn("status", ["TERTUNDA", "BELUM LUNAS"])->count() > 0) {
            return back()->with("error", "Pinjaman anda sebelumnya, belum disetujui atau belum lunas");
        }

        Loan::create([
            "users_id" => Auth::user()->id,
            "option_id" => 1,
            "loan_code" => $loan_code,
            "amount_loan" => $request->input("amount_loan"),
            "due_date" => $due_date,
            "description" => $request->input("description"),
            "status" => $request->input("status", "TERTUNDA")
        ]);

        return back()->with("message", "Pengajuan pinjaman berhasil, silakan lihat pada menu pinjaman");
    }
}
