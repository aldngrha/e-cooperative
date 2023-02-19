<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use App\Models\Surplus;
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

        $rate = $installment->sum("interest_rate");

        return view("pages.surplus", [
            "rate" => $rate
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
