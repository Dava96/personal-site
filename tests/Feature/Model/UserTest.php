<?php

namespace Tests\Feature\Model;

use App\Mail\CommentFormSubmission;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected User $user;
    protected Post $post;
    protected Comment $comment;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->post = Post::factory()->create(['user_id' => $this->user->id]);

        $this->comment = Comment::factory()->create([
            'post_id' => $this->post->id,
            'user_id' => $this->user->id
        ]);
    }

    public function testUserDatabaseHasExpectedColumns()
    {
        $userColumns = [
            'id',
            'name',
            'username',
            'github_username',
            'email',
            'email_verified_at',
            'password',
            'github_name',
            'company',
            'location',
            'bio',
            'followers',
            'following',
            'avatar_url',
            'remember_token',
            'created_at',
            'updated_at'
        ];

        $this->assertTrue(Schema::hasColumns('users', $userColumns));
    }

    public function testIfUserHasManyPosts()
    {
        $this->assertTrue($this->user->posts->contains($this->post));
    }

    public function testSendNotificationEmail()
    {
        $comm = new CommentFormSubmission($this->user, $this->comment);
        $this->user->sendNotificationEmail($this->comment);
        $comm->assertSeeInHtml($this->comment->body);
    }
}
