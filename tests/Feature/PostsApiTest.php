<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostsApiTest extends TestCase
{

    use RefreshDatabase;
    /**
     * Test to show a single post.
     *
     * @return void
     */
    public function testShowSinglePost()
    {
        $post = Post::factory()->create();

        $this->get(route('post.api.show', $post))
            ->assertStatus(200);
    }

    /**
     * Test to show every post.
     *
     * @return void
     */
    public function testShowAllPosts() {
        $posts = Post::factory(2)->create()->map(function ($post) {
            return $post;
        });

        $this->get(route('post.api.index'))
            ->assertStatus(200)
            ->assertJson($posts->toArray())
            ->assertJsonStructure([
                '*' => [
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
                    'published_at',
                ]
            ]);
    }

    /**
     * Test to create a post.
     *
     * @return void
     */
    public function testCreatePost() {
        $post = Post::factory()->create();

        $post['slug'] = 'create'; // Won't work with a duplicate slug

        $this->post(route('post.api.create', $post->toArray()))
            ->assertStatus(201);
    }
}
