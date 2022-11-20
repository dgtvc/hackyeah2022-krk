<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->streetAddress,
            'lat' => (string) $this->faker->latitude(49.984288, 50.097279),
            'lng' => (string) $this->faker->longitude(19.874338, 20.041183),
        ];
    }
}
