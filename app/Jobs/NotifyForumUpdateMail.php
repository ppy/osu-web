<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs;

use App\Mail\ForumNewReply;
use App\Models\UserNotificationOption;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class NotifyForumUpdateMail implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $topic;
    public $user;

    public function __construct($data)
    {
        $this->topic = $data['topic'];
        $this->user = $data['user'];
    }

    public function handle()
    {
        if ($this->topic === null) {
            return;
        }

        $watches = $this->topic->watches()
            ->where('mail', '=', true)
            ->where('notify_status', '=', false)
            ->has('user')
            ->with('user', 'topic')
            ->get();

        $options = UserNotificationOption
            ::whereIn('user_id', $watches->pluck('user_id'))
            ->where(['name' => UserNotificationOption::FORUM_TOPIC_REPLY])
            ->get()
            ->keyBy('user_id');

        foreach ($watches as $watch) {
            $user = $watch->user;

            if (!present($user->user_email)) {
                continue;
            }

            if (($options[$user->getKey()]->details['mail'] ?? true) !== true) {
                continue;
            }

            if ($this->user !== null && $this->user->getKey() === $user->getKey()) {
                continue;
            }

            if ($user->getKey() === $this->topic->topic_last_poster_id) {
                continue;
            }

            if (!priv_check_user($user, 'ForumTopicWatch', $this->topic)->can()) {
                continue;
            }

            Mail::to($user)->queue(new ForumNewReply([
                'topic' => $this->topic,
                'user' => $user,
            ]));

            $watch->update(['notify_status' => true]);
        }
    }
}
