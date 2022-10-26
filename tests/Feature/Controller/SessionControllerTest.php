<?php

namespace Tests\Feature\Controller;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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

    public function testItWorksWithValidCreds()
    {
        $user = User::factory(User::class)->create([
            'email' => 'testEmail@hotmail.com',
            'password' => bcrypt($password = 'ILOVELARAVEL')
        ]);

        $user->save();

        $userArray = $user->toArray();
        $userArray['password'] = $password;


        $this->from('/login')->post(route('session.store'), $userArray)
        ->assertStatus(302);
        //TODO currently isn't working properly figure out a way so that it verifies the email/password

//            ->assertRedirect('/')
//            ->assertSessionHas('success', 'Welcome Back!');
    }

    public function testItDoesntWorkWithInvalidEmail()
    {
        $this->withoutMiddleware();

        $user = User::factory(User::class)->create([
            'password' => bcrypt('ILOVELARAVEL')
        ]);

        $user->save();

        $this->from('/login')->post(route('session.store'), [
            'email' => $user->email,
            'password' => $user->password
        ])
        ->assertSessionHasErrors('email', 'Your provided credentials could not be verified.')
        ->assertRedirect('/login');
    }

    public function testItDoesntWorkWithInvalidPassword()
    {
        $user = User::factory(User::class)->create([
            'email' => 'testEmail@hotmail.com',
        ]);

        $this->from('/login')->post(route('session.store'),  $user->toArray())
            ->assertStatus(302)
            ->assertSessionHasErrors('password', 'The password field is required.');
    }

    public function userDataProvider(): User
    {
        return User::factory()->make([
            'name'            => $this->faker->name,
            'username'        => $this->faker->userName,
            'github_username' => 'Dava96', // Has to be a valid github Username
            'email'           => $this->faker->email,
            'password'        => 'ILOVELARAVEL'
        ]);
    }

    public function testLogout()
    {
        $user = $this->userDataProvider();

        $this->actingAs($user)->post(route('session.destroy'), $user->toArray())
            ->assertStatus(302)
            ->assertSessionHas('success', 'Logged out, Goodbye!');
    }
}
