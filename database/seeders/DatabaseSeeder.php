<?php

namespace Database\Seeders;

use App\Components\GithubSource;
use App\Models\Category;
use App\Models\Comment;
use App\Models\GithubRepo;
use App\Models\Post;
use App\Models\User;
use Database\Factories\GithubRepoFactory;
use Database\Factories\RepoFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(GithubSource $githubSource)
    {

        $details = [
            'name' => 'David Lomath-Connis',
            'username' => 'DavidLomathConnis',
            'github_username' => 'Dava96',
            'password' => 'password',
            'email' => 'david1@gmail.com',
        ];

        $details = array_merge($details, $githubSource->getUserInformation($details['github_username']));
        $user = User::factory()->create([
            'name'            => $details['name'],
            'username'        => $details['username'],
            'github_username' => $details['github_username'],
            'password'        => $details['password'],
            'email'           => $details['email'],
            'company'         => $details['company'],
            'location'        => $details['location'],
            'bio'             => $details['bio'],
            'followers'       => $details['followers'],
            'following'       => $details['following'],
            'avatar_url'      => $details['avatar_url'],
        ]);

        Post::factory(9)->create([
            'user_id' => $user->id
        ]);

        Category::factory(3)->create();

        Comment::factory(5)->create();

        GithubRepo::factory(3)->create();

    }
}
