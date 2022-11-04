<?php

namespace Tests\Feature\Model;

use App\Models\GithubRepo;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class GithubRepoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected GithubRepo $githubRepo;
    protected User $user;
    protected Post $post;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->post = Post::factory()->create([]);
        $this->githubRepo = GithubRepo::factory()->create([
            'post_id' => $this->post->id
        ]);
    }

    public function testDatabaseHasExpectedColumns()
    {
        $columns = [
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
            'forks_count',
            'fork'
        ];

        $this->assertTrue(Schema::hasColumns('github_repos', $columns));
    }

    public function testItCanBeConstructed()
    {
        $this->assertInstanceOf(GithubRepo::class, $this->githubRepo);
    }

    public function testRepoBelongToPost()
    {
        $this->assertInstanceOf(GithubRepo::class, $this->post->repo);

        $repoArray = $this->githubRepo->post->toArray();
        $this->assertEquals($this->post->id, $repoArray['post_id']);
    }
}
