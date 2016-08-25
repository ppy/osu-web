<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace App\Listeners\Forum;

use App\Events\Forum\TopicWasReplied;
use App\Events\Forum\TopicWasViewed;
use App\Models\Forum\TopicWatch;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class NotifyEmail implements ShouldQueue
{
    public function markViewed($event)
    {
        $user = $event->user->fresh();
        $topic = $event->topic->fresh();

        TopicWatch::where([
            'topic_id' => $topic->topic_id,
            'user_id' => $user->user_id,
        ])->update(['notify_status' => false]);
    }

    public function notifyReply($event)
    {
        $topic = $event->topic->fresh();
        $forum = $topic->forum;

        $userIds = model_pluck(TopicWatch::where([
            'topic_id' => $topic->topic_id,
            'notify_status' => false,
        ]), 'user_id');

        foreach (User::whereIn('user_id', $userIds)->get() as $user) {
            if (!present($user->user_email)) {
                continue;
            }

            if ($user->user_id === $topic->last_poster_id) {
                continue;
            }

            if (!priv_check_user($user, 'ForumTopicWatch1', $forum)->can()) {
                continue;
            }

            Mail::queue(
                ['text' => i18n_view('emails.forum.new_reply')],
                compact('topic', 'user'),
                function ($message) use ($topic, $user) {
                    $message->to($user->user_email);
                    $message->subject(trans('forum.email.new_reply', [
                        'title' => $topic->topic_title,
                    ]));
                }
            );

            TopicWatch::where([
                'topic_id' => $topic->topic_id,
                'user_id' => $user->user_id,
            ])->update(['notify_status' => true]);
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            TopicWasViewed::class,
            static::class.'@markViewed'
        );

        $events->listen(
            TopicWasReplied::class,
            static::class.'@notifyReply'
        );
    }
}
