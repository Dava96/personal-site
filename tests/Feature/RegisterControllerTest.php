<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testItRegistersANewUser()
    {
        $this->get(route('register.create'), [
            'name' => $this->faker->name,
            'username' => $this->faker->userName,
            'github_username' => $this->faker->userName,
            'email' => $this->faker->email,
            'password' => $this->faker->password
        ])
        ->assertSuccessful();
    }
}
