<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersApiTest extends TestCase
{

    use RefreshDatabase;
    /**
     * Test to show every user.
     *
     * @return void
     */
    public function testShowAllUsers()
    {
        $users = User::factory(2)->create()->map(function ($user) {
            return $user;
        });

        $this->get(route('user.api.index'))
            ->assertStatus(200)
            ->assertJson($users->toArray())
            ->assertJsonCount(2)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'name',
                    'username',
                    'github_username',
                    'email',
                    'email_verified_at',
                    'github_name',
                    'company',
                    'location',
                    'bio',
                    'followers',
                    'following',
                    'avatar_url',
                    'created_at',
                    'updated_at',
                ]
            ]);
    }

    public function testShowSingleUser() {
        $user = User::factory()->create();

        $this->get(route('user.api.show', $user))
            ->assertStatus(200);
    }
}
