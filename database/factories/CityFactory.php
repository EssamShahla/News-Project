<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->city() ,
            'street' => $this->faker->streetName() ,
            'country_id' => $this->faker->randomDigitNotNull()
         ];
    }
}
