<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddGithubUserTest extends TestCase
{
    use RefreshDatabase;

    public function testAddGithubUser() {
        $this->artisan('AddGithubUser')->assertExitCode(1);

        $this->assertDatabaseHas('users', [
            'github_username' => 'Dava96'
        ]);

        $this->artisan('AddGithubUser')->assertSuccessful();
    }

    public function testAddGithubUserAndPost() {
        $this->artisan('AddGithubUser --post')->assertExitCode(1);

        $this->assertDatabaseHas('github_repos', [
            'repo_name' => 'StarterEdit'
        ]);

        $this->artisan('AddGithubUser --post')->assertSuccessful();
    }

    public function testItWontAllowAnotherUserToBeAdded() {
        $this->artisan('AddGithubUser');

        $this->artisan('AddGithubUser')->assertExitCode(0);
    }
}
