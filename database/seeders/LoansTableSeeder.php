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
            "due_date" => Carbon::now()->addMonth(1),
            "description" => "SKlakslks",
            "status" => "BELUM LUNAS",
            "deleted_at" => null,
            "created_at" => Carbon::now()->subMonths(9),
            "updated_at" => null,
        ]);

        DB::table("loans")->insert([
            "users_id" => 3,
            "option_id" => 1,
            "loan_code" => "PUT1234",
            "amount_loan" => 2000000,
            "due_date" => Carbon::now()->addMonth(1),
            "description" => "SKlakslks",
            "status" => "BELUM LUNAS",
            "deleted_at" => null,
            "created_at" => Carbon::now()->subMonths(9),
            "updated_at" => null,
        ]);
    }
}
