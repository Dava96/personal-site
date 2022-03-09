<?php

namespace Tests\Feature;

use App\Mail\CommentFormSubmission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CommentFormSubmissionTest extends TestCase
{


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMailableContent()
    {
      $user = User::factory()->create();
      $comment = 'Test comment';
      $mailable = new CommentFormSubmission($user, $comment);

      $mailable->assertSeeInHtml($user->name);
      $mailable->assertSeeInHtml($user->id);
      $mailable->assertSeeInHtml($user->email);
      $mailable->assertSeeInHtml($comment);
    }
}
