<?php

namespace Tests\Feature\Model;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected Post $post;
    protected Post $post2;
    protected User $user;
    protected Category $category;


    public function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->create([
            'id' => 1,
            'name' => 'C#',
            'slug' => 'c-sharp',
        ]);

        $this->post = Post::factory()->create([
            'category_id' => $this->category->id
        ]);

        $this->post2 = Post::factory()->create([
            'category_id' => $this->category->id
        ]);
    }

    public function testDatabaseExpectedColumns()
    {
        $columns = [
            'id',
            'name',
            'slug',
            'created_at',
            'updated_at'
        ];

        self::assertTrue(Schema::hasColumns('categories', $columns));
    }

    public function testACategoryHasManyPosts()
    {
        $this->assertInstanceOf(Category::class, $this->category);
        $this->assertInstanceOf(Post::class, $this->post);
        $this->assertInstanceOf(Post::class, $this->post2);

        $this->assertEquals($this->post->category_id, $this->category->id);
        $this->assertEquals($this->post2->category_id, $this->category->id);

        $this->assertEquals(2, $this->category->posts->count());
    }

    public function testModelIsCreatedCorrectly()
    {
        $this->assertEquals(1, $this->category->id);
        $this->assertEquals('C#', $this->category->name);
        $this->assertEquals('c-sharp', $this->category->slug);
    }
}
