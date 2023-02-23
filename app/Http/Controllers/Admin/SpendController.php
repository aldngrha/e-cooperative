<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpendRequest;
use App\Models\Spend;
use Illuminate\Http\Request;

class SpendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spends = Spend::all();

        $amount = $spends->pluck("amount_spend")->sum();

        return view("pages.admin.spend.index", [
            "spends" => $spends,
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
        return view("pages.admin.spend.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpendRequest $request)
    {
        $data = $request->all();

        Spend::create($data);
        return redirect()->route("spend.index")->with("message", "Berhasil menambah pengeluaran koperasi");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function show(Spend $spend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $spend = Spend::findOrFail($id);

        return view("pages.admin.spend.edit", [
            "spend" => $spend
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $spend = Spend::findOrFail($id);
        $spend->update($data);

        return redirect()->route("spend.index")->with("message", "Berhasil mengubah pengeluaran");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spend = Spend::findOrFail($id);
        $spend->delete();

        return redirect()->route("spend.index")->with("message", "Berhasil menghapus pengeluaran");
    }
}
