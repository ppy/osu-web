<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForumNewReply extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $topic;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($attributes)
    {
        $this->topic = $attributes['topic'];
        $this->user = $attributes['user'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->text('emails.forum.new_reply')
            ->subject(osu_trans('mail.forum_new_reply.subject', [
                'title' => $this->topic->topic_title,
            ]));
    }
}
