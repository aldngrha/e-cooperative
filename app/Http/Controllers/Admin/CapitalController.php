<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CapitalRequest;
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
        $capitals = Capital::with(["withdraws"])
            ->orderBy("created_at", "DESC")
            ->get();

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
    public function store(CapitalRequest $request)
    {
        $data = $request->all();

        Capital::create($data);
        return redirect()->route("capital.index")->with("message", "Berhasil menambah modal koperasi");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Capital  $capital
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Capital  $capital
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $capital = Capital::findOrFail($id);

        return view("pages.admin.capital.edit", [
            "capital" => $capital
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Capital  $capital
     * @return \Illuminate\Http\Response
     */
    public function update(CapitalRequest $request, $id)
    {
        $data = $request->all();

        $capital = Capital::findOrFail($id);
        $capital->update($data);

        return redirect()->route("capital.index")->with("message", "Berhasil mengubah modal");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Capital  $capital
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $capital = Capital::findOrFail($id);
        $capital->delete();

        return redirect()->route("capital.index")->with("message", "Berhasil menghapus modal");
    }
}
