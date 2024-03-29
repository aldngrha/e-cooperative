<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = User::orderBy("member_number", "DESC")->get()->slice(0, -1)->values();

        return view("pages.admin.saving.index", [
            "items" => $items,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view("pages.admin.saving.saving-detail", [
            "user" => $user
        ]);
    }
    
    public function print($firstDate, $lastDate) {
        $defaultMonth = Carbon::parse(request('firstDate'))->locale('id')->monthName;
        $defaultYear = Carbon::parse(request('firstDate'))->year;

        $startDate = Carbon::parse($firstDate)->startOfDay();
        $endDate = Carbon::parse($lastDate)->endOfDay();

        $month = $defaultMonth;
        $year = $defaultYear;

        $items = User::whereBetween("created_at", [$startDate, $endDate])->get();

        foreach ($items as $item) {
            // membuat instance Carbon dari atribut created_at
            $date = Carbon::parse($item->created_at);

            // mengambil nama bulan dalam bahasa Indonesia
            $month = $date->locale('id')->monthName;

            // mengambil nama tahun
            $year = $date->year;
        }

        $amount_deposit = $items->sum("amount_deposit");

        return view("pages.admin.saving.print", [
            "items" => $items,
            "month" => $month,
            "year" => $year,
            "amount_deposit" => $amount_deposit
        ]);
    }
}
