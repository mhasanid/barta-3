<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostStat>
 */
class PostStatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_id' => Post::factory(), // Links to a randomly generated post
            'views' => $this->faker->numberBetween(0, 1000), // Random number of views
            'likes' => $this->faker->numberBetween(0, 500),  // Random number of likes
            'created_at' => now()
        ];
    }
}
