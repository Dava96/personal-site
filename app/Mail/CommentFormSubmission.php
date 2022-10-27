<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentFormSubmission extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $comment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $comment)
    {
        $this->user = $user;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject("New Comment Submission by: {$this->user->name}")
            ->from('test@example.com')
            ->replyTo($this->user->email, $this->user->name)
            ->view('components.emails.comment-form-submission');

    }
}
