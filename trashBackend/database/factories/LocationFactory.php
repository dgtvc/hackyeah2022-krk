<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
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
            'latitude' => (string) $this->faker->latitude(49.984288, 50.097279),
            'longitude' => (string) $this->faker->longitude(19.874338, 20.041183),
        ];
    }
}
