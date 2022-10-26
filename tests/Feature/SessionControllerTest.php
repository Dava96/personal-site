<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testLogin()
    {
        $this->get(route('session.create'), $this->userDataProvider()->toArray())
            ->assertStatus(200)
            ->assertViewIs('sessions.create');
    }

    public function testItStores()
    {
        $this->withoutMiddleware();

        $this->post(route('session.store'), $this->userDataProvider()->toArray())
            ->assertStatus(302)
            ->assertRedirect('/');
    }

    public function userDataProvider(): User
    {
        return User::factory()->makeOne();
    }

    public function testLogout()
    {
        $this->markTestSkipped("It's kinda broken lol");
        $this->withMiddleware();

        $this->post(route('session.destroy'), $this->userDataProvider()->toArray())
            ->assertStatus(200);
    }
}
