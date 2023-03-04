<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepositMustRequest;
use App\Http\Requests\DepositRequest;
use App\Models\DepositVoluntary;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SavingVoluntaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = DepositVoluntary::with(["members"])->orderBy("id", "DESC")->get();
        return view("pages.admin.saving-voluntary.index", [
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
//        return view("pages.admin.saving.create");
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
        $user = User::with(["depositVoluntaries"])->findOrFail($id);
        $showSum = $user->depositVoluntaries()->sum("amount_deposit");
        return view("pages.admin.saving-voluntary.saving-detail", [
            "user" => $user,
            "showSum" => $showSum
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
        $save = DepositVoluntary::with(["members"])->findOrFail($id);

        return view("pages.admin.saving-voluntary.edit", [
            "save" => $save
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepositRequest $request, $id)
    {
        $data = $request->all();
        $save = DepositVoluntary::findOrFail($id);
        $save->update($data);

        return redirect()->route("saving-voluntary.index")->with("message", "Berhasil menambah simpanan sukarela");
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

    public function print($firstDate, $lastDate) {
        $items = DepositVoluntary::with(["members"])->whereBetween("created_at", [$firstDate, $lastDate])->get();

        foreach ($items as $item) {
            // membuat instance Carbon dari atribut created_at
            $date = Carbon::parse($item->created_at);

            // mengambil nama bulan dalam bahasa Indonesia
            $month = $date->locale('id')->monthName;

            // mengambil nama tahun
            $year = $date->year;
        }

        $amount_deposit = $items->sum("amount_deposit");

        return view("pages.admin.saving-voluntary.print", [
            "items" => $items,
            "month" => $month,
            "year" => $year,
            "amount_deposit" => $amount_deposit
        ]);
    }
}
