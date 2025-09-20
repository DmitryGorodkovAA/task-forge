<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Board>
 */
class BoardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(rand(2, 5), true),
            'description' => $this->faker->paragraph(),
            'color' => $this->faker->hexColor(),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
