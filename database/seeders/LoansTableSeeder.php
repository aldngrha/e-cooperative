<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("loans")->insert([
            "users_id" => 2,
            "option_id" => 1,
            "loan_code" => "USR1234",
            "amount_loan" => 1000000,
            "due_date" => Carbon::now()->addMonth(10),
            "description" => "SKlakslks",
            "status" => "BELUM LUNAS",
            "deleted_at" => null,
            "created_at" => Carbon::now(),
            "updated_at" => null,
        ]);
    }
}