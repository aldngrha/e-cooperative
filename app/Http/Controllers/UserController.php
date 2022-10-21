<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit() {
        return view("pages.member");
    }

    public function update(UserRequest $request) {
        $data = $request->all();
        auth()->user()->update($data);
        return back()->with("message", "Profil sudah diubah");
    }
}
