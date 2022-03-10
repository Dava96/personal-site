<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Validation\Rule;

class PostApiController extends Controller
{
    public function index() {
        return Post::all();
    }

    public function show(Post $post) {
        return $post;
    }

    public function create() {
        return Post::create([
            'title' => request('title'),
            'category_id' => request('category_id'),
            'user_id' => request('user_id'),
            'slug' => request('slug'),
            'excerpt' => request('excerpt'),
            'body' => request('body')
        ]);
    }
}
