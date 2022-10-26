<?php

namespace Tests\Feature\Command;

use App\Components\GithubSource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\MockInterface;
use Tests\TestCase;

class AddGithubUserTest extends TestCase
{
    use RefreshDatabase;

    protected function getMockPostInformationResponse(): array
    {
        return [
            'repo_name'        => 'Name', // Set to title
            'description'      => 'Description', // Set to excerpt
            'read_me'          => 'Readme text', // set to body
            'html_url'         => 'https://www.github.com/test', // use link in a find on github button
            'language'         => 'php', // use to categorise
            'created_at'       => 0, // timestamp
            'updated_at'       => 0, // timestamp
            'stargazers_count' => 1337, // stats panel
            'watchers_count'   => 2,
            'forks_count'      => 0,
            'fork'             => false, // could use this to display the post or not, since it's true or false
        ];
    }

    public function testAddGithubUser() {
        $this->artisan('AddGithubUser')->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'github_username' => 'Dava96'
        ]);

    }

    public function testAddGithubUserAndPost() {
        $gitHubSource = $this->mock(GithubSource::class, function(MockInterface $mock) {
            $mock
                ->shouldReceive('getPostInformationFromRepo')
                ->once()
                ->andReturn(
                    $this->getMockPostInformationResponse()
                );
        });

        $this->app->instance(GithubSource::class, $gitHubSource);

        $this->artisan('AddGithubUser --post')
            ->assertSuccessful();

        $this->assertDatabaseHas('github_repos', [
            'repo_name' => 'Name'
        ]);
    }

    public function testItWontAllowAnotherUserToBeAdded() {
        $this->artisan('AddGithubUser')->assertSuccessful();
        $this->artisan('AddGithubUser')->assertFailed();
    }
}
