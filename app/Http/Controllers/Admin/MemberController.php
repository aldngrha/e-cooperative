<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy("member_number", "DESC")->get()->slice(0, -1)->values();

        return view("pages.admin.member.index", [
            "users" => $users
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->deposits()->delete();
        $user->depositMusts()->delete();
        $user->loans()->delete();
        $user->delete();

        return back()->with("message", "Anggota telah dihapus");
    }
}
