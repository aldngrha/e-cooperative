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

        DB::table("deposit_musts")->insert([
            "users_id" => 5,
            "amount_deposit" => 2000000,
            "description" => "skalkslkas",
            "deleted_at" => null,
            "created_at" => Carbon::now()->subMonths(1),
            "updated_at" => null
        ]);

        DB::table("deposit_musts")->insert([
            "users_id" => 4,
            "amount_deposit" => 3000000,
            "description" => "skalkslkas",
            "deleted_at" => null,
            "created_at" => Carbon::now()->subMonth(1),
            "updated_at" => null
        ]);

        DB::table("deposit_musts")->insert([
            "users_id" => 1,
            "amount_deposit" => 2500000,
            "description" => "skalkslkas",
            "deleted_at" => null,
            "created_at" => Carbon::now()->subMonths(3),
            "updated_at" => null
        ]);

        DB::table("deposit_musts")->insert([
            "users_id" => 8,
            "amount_deposit" => 1000000,
            "description" => "skalkslkas",
            "deleted_at" => null,
            "created_at" => Carbon::now()->subMonth(2),
            "updated_at" => null
        ]);

        DB::table("deposit_musts")->insert([
            "users_id" => 6,
            "amount_deposit" => 2000000,
            "description" => "skalkslkas",
            "deleted_at" => null,
            "created_at" => Carbon::now()->subMonths(3),
            "updated_at" => null
        ]);

        DB::table("deposit_musts")->insert([
            "users_id" => 7,
            "amount_deposit" => 1000000,
            "description" => "skalkslkas",
            "deleted_at" => null,
            "created_at" => Carbon::now()->subMonth(4),
            "updated_at" => null
        ]);
    }
}
