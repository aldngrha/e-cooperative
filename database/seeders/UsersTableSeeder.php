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
            "roles" => "USER",
        ]);
    }
}
