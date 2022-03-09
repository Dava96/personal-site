<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class GithubRepoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => Post::factory(),
            'repo_name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'read_me' => $this->faker->paragraph,
            'html_url' => $this->faker->url,
            'language' => $this->faker->randomLetter,
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
            'stargazers_count' => $this->faker->randomDigit(),
            'watchers_count' => $this->faker->randomDigit(),
            'forks_count' => $this->faker->randomDigit(),
            'fork' => $this->faker->boolean
        ];
    }
}
