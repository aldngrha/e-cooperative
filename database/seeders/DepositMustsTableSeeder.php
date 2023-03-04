<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepositMustsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("deposit_musts")->insert([
            "users_id" => 2,
            "amount_deposit" => 2000000,
            "description" => "skalkslkas",
            "deleted_at" => null,
            "created_at" => Carbon::now()->subMonths(1),
            "updated_at" => null
        ]);

        DB::table("deposit_musts")->insert([
            "users_id" => 3,
            "amount_deposit" => 1000000,
            "description" => "skalkslkas",
            "deleted_at" => null,
            "created_at" => Carbon::now()->subMonth(2),
            "updated_at" => null
        ]);
    }
}
