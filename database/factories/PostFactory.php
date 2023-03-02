<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->text(),
            'status' => $this->faker->randomElement([0, 1]),
            'create_user_id' => 1,
            'updated_user_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => now(),
        ];

    }
}