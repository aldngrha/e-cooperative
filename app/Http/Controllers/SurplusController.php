<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use App\Models\Option;
use App\Models\Surplus;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SurplusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $installment = Installment::all();

        $date = Option::find(1)->date_withdraw;

        $option = Carbon::parse($date)->format("m-d");

        $rate = $installment->sum("interest_rate");

        return view("pages.surplus", [
            "rate" => $rate,
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

}
