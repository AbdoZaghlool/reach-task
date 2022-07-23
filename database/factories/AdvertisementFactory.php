<?php

namespace Database\Factories;

use App\Models\{Category, User};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advertisement>
 */
class AdvertisementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'user_id' => User::factory()->create(),
            'category_id' => Category::factory()->create(),
            'type' => $this->faker->randomElement(['free', 'paid']),
            'title' => $this->faker->word(1),
            'description' => $this->faker->sentence(15),
            'start_date' => $this->faker->dateTimeBetween(now(), now()->addMonth())
        ];
    }
}
