<?php

namespace App\Http\Controllers;

use App\Mail\CommentFormSubmission;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostCommentsController extends Controller
{
    public function store(Post $post) {

        request()->validate([
            'body' => 'required'
        ]);

        $post->comments()->create([
            'user_id' => request()->user()->id,
            'body' => request('body'),
        ]);

        $user = request()->user();
        $comment = request('body');

        $user->sendNotificationEmail($comment);

        return back()->with('success', 'Sucessfully Posted a comment!');
    }
}
