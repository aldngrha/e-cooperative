<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\DepositMustController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OptionController;

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
    Route::get("/deposit", [DepositController::class, "index"])->name("deposit");
    Route::post("/deposit", [DepositController::class, "process"])->name("checkout");
    Route::get("/deposit-must", [DepositMustController::class, "index"])->name("deposit-must");
    Route::post("/deposit-must", [DepositMustController::class, "process"])->name("checkout-must");
    Route::get("/profile/edit", [UserController::class, "edit"])->name("edit");
    Route::put("/profile/edit", [UserController::class, "update"])->name("update");
});

Route::prefix("admin")
    ->namespace("Admin")
    ->middleware(["auth", "admin"])
    ->group(function () {
        Route::get('/', [DashboardController::class, "index"])->name("dashboard");
        Route::resource("option", "OptionController");
        Route::resource("saving", "DepositController");
        Route::resource("member", "MemberController");
});

Auth::routes();

