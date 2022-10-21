<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SavingController extends Controller
{
    public function index(Request $request) {
        return view("pages.saving-must");
    }
}
