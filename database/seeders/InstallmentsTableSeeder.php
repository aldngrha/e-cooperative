<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstallmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("installments")->insert([
            "loans_id" => 1,
            "installment_number" => 1,
            "amount_installment" => 100000,
            "interest_rate" => 10000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now(),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 1,
            "installment_number" => 2,
            "amount_installment" => 100000,
            "interest_rate" => 10000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now(),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 1,
            "installment_number" => 3,
            "amount_installment" => 100000,
            "interest_rate" => 10000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now(),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 1,
            "installment_number" => 4,
            "amount_installment" => 100000,
            "interest_rate" => 10000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now(),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 1,
            "installment_number" => 5,
            "amount_installment" => 100000,
            "interest_rate" => 10000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now(),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 1,
            "installment_number" => 6,
            "amount_installment" => 100000,
            "interest_rate" => 10000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now(),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 1,
            "installment_number" => 7,
            "amount_installment" => 100000,
            "interest_rate" => 10000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now(),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 1,
            "installment_number" => 8,
            "amount_installment" => 100000,
            "interest_rate" => 10000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now(),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 1,
            "installment_number" => 9,
            "amount_installment" => 100000,
            "interest_rate" => 10000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now(),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
    }
}
