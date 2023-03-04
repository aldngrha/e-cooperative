<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    // di dalam class
    protected static $memberNumber = 1;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // di dalam function generateMember
        $memberNumber = str_pad(self::$memberNumber, 3, "0", STR_PAD_LEFT); // membuat format 3 digit
        self::$memberNumber++; // increment nomor member setiap kali fungsi dipanggil

        return [
            'name' => $this->faker->name(),
            "member_number" => $memberNumber,
            'email' => $this->faker->unique()->safeEmail(),
            "password" => bcrypt("userkoperasi"),
            "place_of_birth" => $this->faker->city(),
            "date_of_birth" => $this->faker->dateTimeBetween('-60 years', '-18 years'),
            "phone_number" => Str::random(12),
            "gender" => $this->faker->randomElement(['Laki-Laki', 'Perempuan']),
            "position" => $this->faker->randomElement(["Guru", "Tata Usaha", "Staff"]),
            'address' => $this->faker->address(),
            'created_at' => $this->faker->dateTimeBetween("-10 months", "-1 months"),
            'roles' => 'USER',
            'amount_deposit' => 2000000,
            'status' => "TERDAFTAR"
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
//    public function unverified()
//    {
//        return $this->state(function (array $attributes) {
//            return [
//                'email_verified_at' => null,
//            ];
//        });
//    }
}
