<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(["auth","user"])->group(function () {
    Route::get("/", [HomeController::class, "index"])->name("home");
});

Route::prefix("admin")
    ->namespace("Admin")
    ->middleware(["auth", "admin"])
    ->group(function () {
        Route::get('/', [DashboardController::class, "index"])->name("dashboard");
        Route::resource("member", "MemberController");
});

Auth::routes();

