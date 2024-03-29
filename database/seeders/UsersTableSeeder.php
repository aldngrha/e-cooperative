<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
            "name" => "admin",
            "member_number" => "000",
            "email" => "ekoperasi@gmail.com",
            "password" => bcrypt("adminkoperasi"),
            "created_at" => now(),
            "roles" => "ADMIN",
        ]);

//        DB::table("users")->insert([
//            "name" => "user",
//            "member_number" => "001",
//            "email" => "user@gmail.com",
//            "password" => bcrypt("userkoperasi"),
//            "place_of_birth" => "bandar lampung",
//            "date_of_birth" => now(),
//            "phone_number" => "098917231",
//            "gender" => "Laki-Laki",
//            "position" => "Guru",
//            "address" => "jl dr jarusn 1 jahsjha",
//            "created_at" => now(),
//            "roles" => "USER",
//            "amount_deposit" => 2000000
//        ]);
//
//        DB::table("users")->insert([
//            "name" => "putri",
//            "member_number" => "002",
//            "email" => "putri@gmail.com",
//            "password" => bcrypt("userkoperasi"),
//            "place_of_birth" => "bandar lampung",
//            "date_of_birth" => now(),
//            "phone_number" => "098917231",
//            "gender" => "Laki-Laki",
//            "position" => "Guru",
//            "address" => "jl dr jarusn 1 jahsjha",
//            "created_at" => now(),
//            "roles" => "USER",
//            "amount_deposit" => 2000000
//        ]);
    }
}
