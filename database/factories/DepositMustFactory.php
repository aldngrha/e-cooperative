<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepositMustFactory extends Factory
{
    private static $incrementingInteger = 2;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "users_id" => self::$incrementingInteger++,
            "amount_deposit" => $this->faker->numberBetween(1, 20) * 100000,
            "description" => "Sudah",
            "deleted_at" => null,
            "created_at" => $this->faker->dateTimeBetween("-7 months", "-1 months"),
            "updated_at" => null
        ];
    }
}
