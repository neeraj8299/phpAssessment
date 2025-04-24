<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition(): array
    {
        $startTime = $this->faker->dateTimeBetween('+1 days', '+1 month');
        $endTime = (clone $startTime)->modify('+2 hours');

        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->optional()->paragraph,
            'country' => $this->faker->country,
            'capacity' => $this->faker->numberBetween(10, 100),
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
    }
}
