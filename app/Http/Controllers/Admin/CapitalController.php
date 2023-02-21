<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Capital;
use Illuminate\Http\Request;

class CapitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $capitals = Capital::all();

        $amount = $capitals->pluck("amount_capital")->sum();

        return view("pages.admin.capital.index", [
            "capitals" => $capitals,
            "amount" => $amount
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.admin.capital.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Capital  $capital
     * @return \Illuminate\Http\Response
     */
    public function show(Capital $capital)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Capital  $capital
     * @return \Illuminate\Http\Response
     */
    public function edit(Capital $capital)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Capital  $capital
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Capital $capital)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Capital  $capital
     * @return \Illuminate\Http\Response
     */
    public function destroy(Capital $capital)
    {
        //
    }
}
