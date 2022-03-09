<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostApiController extends Controller
{
    public function index() {
        return Post::all();
    }

    public function show(Post $post) {
        return $post;
    }
}
