<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $now = now();
        $hasTime = fake()->boolean();

        return [
            'title' => fake()->title(),
            'slug' => fake()->slug(),
            'start_time' => $hasTime ? $now->copy()->addMinutes(5) : null,
            'end_time' => $hasTime ? $now->copy()->addMinutes(10) : null,
            'description' => fake()->text(),
        ];
    }
}
