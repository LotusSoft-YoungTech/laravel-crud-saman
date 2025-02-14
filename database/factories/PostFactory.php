<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory  // Changed to PostFactory (capitalized "P")
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),  // Generate a fake user
            'title' => $this->faker->title(),  // Fake title
            'content' => $this->faker->paragraph(),  // Fake content
            'is_public' => 1  // Set is_public to 1 (true)
        ];
    }
}
