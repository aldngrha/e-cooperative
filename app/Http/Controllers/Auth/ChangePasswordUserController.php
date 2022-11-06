<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordUserController extends Controller
{
    public function edit() {
        return view("auth.change-password");
    }

    public function changePassword(Request $request) {
        if (
            !Hash::check(
                $request->get("current-password"),
                Auth::user()->password
            )
        ) {
            // The passwords matches
            return redirect()
                ->back()
                ->with("error", "Kata sandi saat ini salah.");
        }

        if (
            strcmp(
                $request->get("current-password"),
                $request->get("new-password")
            ) == 0
        ) {
            // Current password and new password same
            return redirect()
                ->back()
                ->with(
                    "error",
                    "Kata sandi baru tidak boleh sama dengan kata sandi sekarang."
                );
        }

        $validatedData = $request->validate([
            "current-password" => "required",
            "new-password" => "required|string|min:8|confirmed",
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get("new-password"));
        $user->save();

        return redirect()
            ->back()
            ->with("success", "Kata Sandi Berhasil Diubah!");

    }
}
