<?php

namespace Database\Factories;

use App\Models\Board;
use App\Models\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        if (random_int(0, 1) === 0) {
            $randomDate = fake()->dateTimeInInterval('now','-1 years');
        }else{
            $randomDate = fake()->dateTimeInInterval('now', '+1 years');
        }


        return [
            'name' => $this->faker->words(rand(2, 5), true),
            'description' => $this->faker->words(rand(5, 12), true),
            'due_date' => $randomDate,
            'board_id' => Board::inRandomOrder()->first()->id,
            'task_status_id' => null,
        ];
    }
}
