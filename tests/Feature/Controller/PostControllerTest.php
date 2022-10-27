<?php

namespace Tests\Feature\Controller;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testItShowsAPost()
    {
        $post = $this->postProvider();
        $postArray = $post->toArray();
        $post->save();

        $this->assertDatabaseHas('posts', $postArray);

        $this->get(route('posts.show', $postArray['slug']))
            ->assertViewIs('posts.show')
            ->assertStatus(200);
    }

    public function testItIndexPosts()
    {
        $post = $this->postProvider();
        $post->save();

        $this->get(route('posts.home'))
            ->assertViewIs('posts.index')
            ->assertViewHas('posts')
            ->assertStatus(200);
    }

    public function testThereAreNoPosts()
    {
        $this->get(route('posts.home'))
            ->assertViewIs('posts.index')
            ->assertSeeText('No posts yet. Please check back later.')
            ->assertStatus(200);
    }

    public function postProvider(): Post
    {
        return Post::factory()->makeOne();
    }
}
