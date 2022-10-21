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
            "email" => "ekoperasi@gmail.com",
            "password" => bcrypt("adminkoperasi"),
            "roles" => "ADMIN",
        ]);

        DB::table("users")->insert([
            "name" => "user",
            "email" => "user@gmail.com",
            "password" => bcrypt("userkoperasi"),
            "place_of_birth" => "bandar lampung",
            "date_of_birth" => now(),
            "phone_number" => "098917231",
            "gender" => "M",
            "position" => "Guru",
            "address" => "jl dr jarusn 1 jahsjha",
            "roles" => "USER",
        ]);
    }
}
