<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'slug' => $this->faker->word,
            'title' => $this->faker->sentence,
            'excerpt' => $this->faker->paragraphs(2, true),
            'body' => $this->faker->paragraphs(6, true),
        ];
    }
}
