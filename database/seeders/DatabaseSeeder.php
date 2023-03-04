<?php

namespace Database\Seeders;

use App\Models\DepositMust;
use App\Models\DepositVoluntary;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UsersTableSeeder::class]);
        $this->call([OptionsTableSeeder::class]);
        $this->call([LoansTableSeeder::class]);
        $this->call([InstallmentsTableSeeder::class]);
//        $this->call([DepositMustsTableSeeder::class]);
//        $this->call([DepositVolutariesTableSeeder::class]);

        User::factory(10)->create();
        DepositMust::factory(10)->create();
        DepositVoluntary::factory(10)->create();
//        Loan::factory(10)->create();
    }
}
