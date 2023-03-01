<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepositMustRequest;
use App\Models\DepositMust;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SavingMustController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = DepositMust::with(["members"])->orderBy("id", "DESC")->get();
        return view("pages.admin.saving-must.index", [
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
        $user = User::with(["depositMusts"])->findOrFail($id);
        $showSum = $user->depositMusts()->sum("amount_deposit");
        return view("pages.admin.saving-must.saving-detail", [
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
        $save = DepositMust::with(["members"])->findOrFail($id);

        return view("pages.admin.saving-must.edit", [
            "save" => $save,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepositMustRequest $request, $id)
    {
        $data = $request->all();
        $save = DepositMust::findOrFail($id);
        $save->update($data);

        return redirect()->route("saving-must.index")->with("message", "Berhasil menambah simpanan wajib");
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
        $items = DepositMust::with(["members"])->whereBetween("created_at", [$firstDate, $lastDate])->get();

        foreach ($items as $item) {
            // membuat instance Carbon dari atribut created_at
            $date = Carbon::parse($item->created_at);

            // mengambil nama bulan dalam bahasa Indonesia
            $month = $date->locale('id')->monthName;

            // mengambil nama tahun
            $year = $date->year;
        }

        return view("pages.admin.saving-must.print", [
            "items" => $items,
            "month" => $month,
            "year" => $year
        ]);
    }
}
