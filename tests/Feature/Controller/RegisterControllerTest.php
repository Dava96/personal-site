<?php

namespace Tests\Feature\Controller;

use App\Components\GithubSource;
use App\Http\Controllers\RegisterController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    protected GithubSource $githubSource;
    protected RegisterController $registerController;

    public function setUp(): void
    {
        parent::setUp();
        $this->githubSource = $this->createMock(GithubSource::class);
        $this->registerController = new RegisterController($this->githubSource);
    }

    public function testItRegistersANewUser()
    {
        $this->markTestSkipped('Needs github auth in the pipeline otherwise it will fail');
        //TODO add github auth in secrets, otherwise it works
        $this->withoutMiddleware();

        $response = $this->post('/register', $this->userDataProvider())
            ->assertStatus(302)
            ->assertRedirect('/')
            ->assertSessionHas('success', 'Your account has been created.');

        $this->assertDatabaseHas('users', ['github_username' => 'Dava96']);
    }

    public function testItReturnsViewOnUserCreate()
    {
        $this->get('/register', $this->userDataProvider())
            ->assertStatus(200)
            ->assertViewIs('register.create');
    }

    public function testItFailsOnUserCreate()
    {
        $this->get(route('register.create'))
            ->assertStatus(200);
    }

    public function userDataProvider(): array
    {
        return [
            'name' => $this->faker->name,
            'username' => $this->faker->userName,
            'github_username' => 'Dava96', // Has to be a valid github Username
            'email' => $this->faker->email,
            'password' => $this->faker->password(7)
        ];
    }
}
