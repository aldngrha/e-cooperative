<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstallmentRequest;
use App\Http\Requests\UserRequest;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\Option;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstallmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::with(["loans"])
            ->where("id", Auth::user()->id)
            ->firstOrFail();

//        $installments = $user->loans()->with(["installments"])->get()->pluck('installments')->collapse();

        $loans = $user->loans()->where("status", "BELUM LUNAS")->get();

        // Get the selected loan from the dropdown
        $selectedLoanId = $request->input('loans_id');

        $loanData = [];

        foreach ($loans as $loan) {
            // Get the number of installments for the loan
            $installmentCount = $loan->installments()->count();

            // If there are no installments, the next installment number is 1; otherwise, increment by 1
            $nextInstallmentNumber = $installmentCount > 0 ? $installmentCount + 1 : 1;

            // Add the loan data to the array
            $loanData[$loan->id] = [
                'loan' => $loan,
                'next_installment_number' => $nextInstallmentNumber,
            ];
        }

        return view("pages.installment", [
            "loanData" => $loanData,
            "selectedLoanId" => $selectedLoanId,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(InstallmentRequest $request)
    {
        $user = User::with([
            "loans"])
            ->where("id", Auth::user()->id)
            ->firstOrFail();

        $installments = $user->loans()->with(["installments"])->get()->pluck('installments')->collapse();

        // Get the selected loan from the dropdown
        $selectedLoanId = $request->input('loans_id');

// If the selected loan has installments, get the number of the next installment
        if ($selectedLoanId) {
            $loan = $user->loans()->findOrFail($selectedLoanId);
            $installmentNumber = $loan->installments()->count() + 1;
        } else {
            $installmentNumber = null;
        }

        $amount = $user->loans->sum("amount_loan");

        if ($amount == 0 && $user->loans->where("status", "LUNAS")->count() > 0) {
            return back()->with("error", "Kamu belum memiliki pinjaman");
        }

        if($user->loans->where("status", "TERTUNDA")->count() > 0) {
            return back()->with("error", "Pinjaman anda belum disetujui");
        }

        Installment::create([
            "loans_id" => $selectedLoanId,
            "installment_number" => $installmentNumber,
            "description" => $request->input("description"),
        ]);

        return back()->with("message", "Berhasil membayar angsuran");
    }
}
