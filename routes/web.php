<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\DepositMustController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\SurplusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ChangePasswordUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\SavingController;
use App\Http\Controllers\Admin\SavingMustController;
use App\Http\Controllers\Admin\SavingVoluntaryController;
use App\Http\Controllers\Admin\LoanController as Loans;
use App\Http\Controllers\Admin\InstallmentController as Installment;
use App\Http\Controllers\Admin\WithdrawController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\CashFlowController;

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
    Route::get("/loan", [LoanController::class, "index"])->name("loan");
    Route::post("/loan", [LoanController::class, "process"])->name("loan-process");
    Route::get("/installment", [InstallmentController::class, "index"])->name("installment");
    Route::post("/installment", [InstallmentController::class, "create"])->name("installment-checkout");
    Route::get("/surplus", [SurplusController::class, "index"])->name("surplus");
    Route::post("/surplus", [SurplusController::class, "process"])->name("withdraw");
    Route::get("/profile/edit", [UserController::class, "edit"])->name("edit");
    Route::put("/profile/edit", [UserController::class, "update"])->name("update");
    Route::get("/profile/saving", [UserController::class, "saving"])->name("saving");
    Route::get("/profile/loan", [UserController::class, "loan"])->name("profile-loan");
    Route::get("/profile/change-password", [ChangePasswordUserController::class, "edit"])->name("password-edit");
    Route::post("/profile/change-password", [ChangePasswordUserController::class, "changePassword"])->name("change");
});

Route::prefix("admin")
    ->namespace("Admin")
    ->middleware(["auth", "admin"])
    ->group(function () {
        Route::get('/', [DashboardController::class, "index"])->name("dashboard");
        Route::get("/change-password", [ChangePasswordController::class, "edit"])->name("edit-password");
        Route::post("/change-password", [ChangePasswordController::class, "changePasswordPost"])->name("change-password");
        Route::resource("option", "OptionController");
        Route::resource("saving", "SavingController");
        Route::get('/saving/print/{firstDate}/{lastDate}', [SavingController::class, "print"])->name('print');
        Route::resource("saving-voluntary", "SavingVoluntaryController");
        Route::get('/saving-voluntary/print/{firstDate}/{lastDate}', [SavingVoluntaryController::class, "print"])->name('print-voluntary');
        Route::resource("saving-must", "SavingMustController");
        Route::get('/saving-must/print/{firstDate}/{lastDate}', [SavingMustController::class, "print"])->name('print-must');
        Route::resource("loan", "LoanController");
        Route::get('/loan/print/{firstDate}/{lastDate}', [Loans::class, "print"])->name('print-loan');
        Route::resource("installment", "InstallmentController");
        Route::get('/installment/print/{firstDate}/{lastDate}', [Installment::class, "print"])->name('print-installment');
        Route::resource("capital", "CapitalController");
        Route::resource("spend", "SpendController");
        Route::resource("withdraw", "WithdrawController");
        Route::get('/withdraw/print/{firstDate}/{lastDate}', [WithdrawController::class, "print"])->name('print-withdraw');
        Route::resource("member", "MemberController");
        Route::resource("/cash-flow", "CashFlowController");
        Route::post("/cash-flow", [CashFlowController::class, "getData"])->name("data");
});

Auth::routes();

