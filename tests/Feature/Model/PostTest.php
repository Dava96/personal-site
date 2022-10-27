<?php

namespace Tests\Feature\Model;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Post $post;
    protected Comment $comment;
    protected Category $category;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();

        $this->category = Category::factory()->create();

        $this->post = Post::factory()->create([
            'title' => 'starter',
            'user_id' => $this->user->id,
            'category_id' => $this->category->id,
            'slug' => $this->category->slug
        ]);

        $this->comment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id
        ]);
    }

    public function testDatabaseHasExpectedColumns()
    {
        $usedColumns = [
            'id',
            'category_id',
            'user_id',
            'slug',
            'created_at',
            'updated_at',
            'thumbnail',
            'title',
            'excerpt',
            'body',
            'published_at'
        ];

        self::assertTrue(Schema::hasColumns('posts', $usedColumns));
    }

    public function testAPostBelongsToAUser()
    {
        $this->assertModelExists($this->post);
        $this->assertModelExists($this->user);
        $this->assertInstanceOf(Post::class, $this->post);
        $this->assertEquals($this->user->id, $this->post->user_id);
    }

    public function testAPostHasManyComments()
    {
        $this->assertModelExists($this->post);
        $this->assertModelExists($this->user);
        $this->assertModelExists($this->comment);
        $this->assertInstanceOf(Post::class, $this->post);

        $this->assertEquals(1, $this->post->comments->count());
        $this->assertEquals($this->user->id, $this->comment->user_id);
    }

    public function testPostBelongsToUser()
    {
        $this->assertEquals(1, $this->user->posts->count());
        $post = $this->user->posts;
        $this->assertInstanceOf(Post::class, $post[0]);
    }

    public function testPostBelongToCategory()
    {
        $this->assertEquals($this->post->category_id, $this->category->id);
    }

    public function testFilterBySearch()
    {
        $this->assertDatabaseHas('posts', ['id' => $this->post->id]);
        $searchResponse = Post::latest()->filter(['search'])->paginate(6)->withQueryString();

        $this->assertEquals($this->post->title, $searchResponse[0]['title']);
    }

    public function testFilterByCategory()
    {
        $this->assertDatabaseHas('posts', ['id' => $this->post->id]);
        $this->assertDatabaseHas('categories', ['name' => $this->category->name]);

        $categoryResponse = Post::latest()->filter(['category'])->paginate(6)->withQueryString();

        $this->assertEquals($this->category->id, $categoryResponse[0]['category_id']);
    }

    public function testFilterByAuthor()
    {
        $this->assertDatabaseHas('posts', ['id' => $this->post->id]);
        $this->assertDatabaseHas('users', ['id' => $this->user->id]);

        $authorResponse = Post::latest()->filter(['author'])->paginate(6)->withQueryString();

        $this->assertEquals($this->user->id, $authorResponse[0]['user_id']);
    }
}
