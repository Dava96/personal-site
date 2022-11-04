<?php

namespace Tests\Feature\Model;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;


class CommentTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected Comment $comment;
    protected Post $post;
    protected Post $post2;
    protected User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->post = Post::factory()->create();
        $this->post2 = Post::factory()->create();
        $this->comment = Comment::factory()->create([
            'post_id' => $this->post->id,
            'user_id' => $this->user->id,
        ]);

    }

    public function testDatabaseHasExpectedColumns()
    {
        $columns = [
            'id',
            'post_id',
            'user_id',
            'body',
            'created_at',
            'updated_at'
        ];

        $this->assertTrue(Schema::hasColumns('comments', $columns));
    }

    public function testCommentsCanBeConstructed()
    {
        $this->assertInstanceOf(Comment::class, $this->comment);
    }

    public function testTheCommentBelongsToCorrectPost()
    {
        $commentOnPost = $this->post->comments->toArray();
        $commentOnPost = $commentOnPost[0];
        $this->assertEquals($commentOnPost['id'], $this->comment->id);
        $this->assertEquals($commentOnPost['post_id'], $this->comment->post_id);
        $this->assertEquals($commentOnPost['user_id'], $this->comment->user_id);
        $this->assertEquals($commentOnPost['body'], $this->comment->body);
    }

    public function testCommentWasMadeByCorrectUser()
    {
        $this->assertEquals($this->user->id, $this->comment->user_id);
    }
}
