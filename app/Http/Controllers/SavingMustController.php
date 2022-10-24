<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SavingMustController extends Controller
{
    public function index(Request $request) {
        return view("pages.saving-must");
    }
}
