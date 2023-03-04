<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DepositVoluntaryFactory extends Factory
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
            "description" => $this->faker->text(50),
            "deleted_at" => null,
            "created_at" => $this->faker->dateTimeBetween("-9 months", "-1 months"),
            "updated_at" => null
        ];
    }
}
