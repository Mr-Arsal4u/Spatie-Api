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
            'user_id' => User::role(['admin', 'superadmin'])->inRandomOrder()->value('id'),
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
        ];
    }
}
