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
            "remaining" => 900000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now()->subMonths(9),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 1,
            "installment_number" => 2,
            "amount_installment" => 100000,
            "interest_rate" => 10000,
            "remaining" => 800000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now()->subMonths(8),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 1,
            "installment_number" => 3,
            "amount_installment" => 100000,
            "interest_rate" => 10000,
            "remaining" => 700000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now()->subMonths(7),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 1,
            "installment_number" => 4,
            "amount_installment" => 100000,
            "interest_rate" => 10000,
            "remaining" => 600000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now()->subMonths(6),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 1,
            "installment_number" => 5,
            "amount_installment" => 100000,
            "interest_rate" => 10000,
            "remaining" => 500000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now()->subMonths(5),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 1,
            "installment_number" => 6,
            "amount_installment" => 100000,
            "interest_rate" => 10000,
            "remaining" => 400000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now()->subMonths(4),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 1,
            "installment_number" => 7,
            "amount_installment" => 100000,
            "interest_rate" => 10000,
            "remaining" => 300000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now()->subMonths(3),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 1,
            "installment_number" => 8,
            "amount_installment" => 100000,
            "interest_rate" => 10000,
            "remaining" => 200000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now()->subMonths(2),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 1,
            "installment_number" => 9,
            "amount_installment" => 100000,
            "interest_rate" => 10000,
            "remaining" => 100000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now()->subMonths(1),
            "updated_at" => null,
            "deleted_at" => null,
        ]);

        DB::table("installments")->insert([
            "loans_id" => 2,
            "installment_number" => 1,
            "amount_installment" => 200000,
            "interest_rate" => 20000,
            "remaining" => 1800000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now()->subMonths(9),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 2,
            "installment_number" => 2,
            "amount_installment" => 200000,
            "interest_rate" => 20000,
            "remaining" => 1600000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now()->subMonths(8),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 2,
            "installment_number" => 3,
            "amount_installment" => 200000,
            "interest_rate" => 20000,
            "remaining" => 1400000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now()->subMonths(7),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 2,
            "installment_number" => 4,
            "amount_installment" => 200000,
            "interest_rate" => 20000,
            "remaining" => 1200000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now()->subMonths(6),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 2,
            "installment_number" => 5,
            "amount_installment" => 200000,
            "interest_rate" => 20000,
            "remaining" => 1000000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now()->subMonths(5),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 2,
            "installment_number" => 6,
            "amount_installment" => 200000,
            "interest_rate" => 20000,
            "remaining" => 800000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now()->subMonths(4),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 2,
            "installment_number" => 7,
            "amount_installment" => 200000,
            "interest_rate" => 20000,
            "remaining" => 600000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now()->subMonths(3),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 2,
            "installment_number" => 8,
            "amount_installment" => 200000,
            "interest_rate" => 20000,
            "remaining" => 400000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now()->subMonths(2),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
        DB::table("installments")->insert([
            "loans_id" => 2,
            "installment_number" => 9,
            "amount_installment" => 200000,
            "interest_rate" => 20000,
            "remaining" => 200000,
            "description" => "KSLAKSa",
            "created_at" => Carbon::now()->subMonths(1),
            "updated_at" => null,
            "deleted_at" => null,
        ]);
    }
}
