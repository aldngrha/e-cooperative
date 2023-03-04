<?php

namespace Database\Factories;

use App\Models\Loan;
use App\Models\Option;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    private static $incrementingInteger = 2;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::orderBy("id")->first(); // Get a random user
        $nameInitials = strtoupper(substr($user->name, 0, 3)); // Get the first 3 characters of the user's name and convert them to uppercase
        $randomNumber = $this->faker->numberBetween(1000, 9999);

        $statusOptions = ['BELUM LUNAS', 'TERTUNDA',];
        $status = $statusOptions[rand(0, 1)];

        $option = Option::inRandomOrder()->first();

        return [
            'users_id' => self::$incrementingInteger++,
            'option_id' => 1,
            'loan_code' => $nameInitials . $randomNumber,
            'amount_loan' => $this->faker->numberBetween(1, 20) * 50000,
            'due_date' => Carbon::now()->addMonths(10),
            'description' => $this->faker->sentence(),
            'status' => $status,
            'deleted_at' => null,
            'created_at' => $this->faker->dateTimeBetween('-3 months', '-1 months'),
            'updated_at' => null,
        ];
    }
}
