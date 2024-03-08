<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Presentation>
 */
class PresentationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'location_id' =>  $this->faker->numberBetween($min = 1, $max = 115),
            'language_id' =>  $this->faker->numberBetween($min = 1, $max = 115),
            'language_code' => $this->faker->name,
            'name' => $this->faker->name,
            'overview' => $this->faker->name,
            'content' => $this->faker->text,
        ];
    }
}
