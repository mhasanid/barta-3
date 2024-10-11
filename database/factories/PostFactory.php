<?php

namespace Database\Factories;

use App\Models\User;
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
    public function definition(): array
    {
        return [
            'texts' => $this->faker->paragraph(), // Generates random text
            'image' => $this->faker->imageUrl(640, 480, 'posts', true), // Optional random image URL
            'user_id' => User::factory(), // Links to a randomly generated user
            'created_at' => now(),
            
        ];
    }
}
