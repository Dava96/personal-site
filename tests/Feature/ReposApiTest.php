<?php

namespace Tests\Feature;

use App\Models\GithubRepo;
use Database\Factories\GithubRepoFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReposApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * test to show a single github repo.
     *
     * @return void
     */


        /**
         * Test to show a single post.
         *
         * @return void
         */
        public
        function testShowSingleRepo()
        {
            $repo = GithubRepo::factory()->create();

            $this->get(route('repo.api.show', $repo))
                ->assertStatus(200);
        }

        /**
         * Test to show every post.
         *
         * @return void
         */
        public function testShowAllRepos() {
        $repos = GithubRepo::factory(2)->create()->map(function ($repo) {
            return $repo;
        });

        $this->get(route('repo.api.index'))
            ->assertStatus(200)
            ->assertJson($repos->toArray())
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'post_id',
                    'repo_name',
                    'description',
                    'read_me',
                    'html_url',
                    'language',
                    'created_at',
                    'updated_at',
                    'stargazers_count',
                    'watchers_count',
                    'forks_count',
                    'fork'
                ]
            ]);
    }
}
