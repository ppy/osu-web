<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
use App\Mail\ForumNewReply;
use App\Models\Forum\TopicWatch;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class NotifyEmail implements ShouldQueue
{
    public function markViewed($event)
    {
        if ($event->user === null) {
            return;
        }

        $user = $event->user->fresh();
        $topic = $event->topic->fresh();
        $post = $event->post->fresh();

        if ($topic->topic_last_post_time > $post->post_time) {
            return;
        }

        TopicWatch::where([
            'topic_id' => $topic->topic_id,
            'user_id' => $user->user_id,
        ])->update(['notify_status' => false]);
    }

    public function notifyReply($event)
    {
        $topic = $event->topic->fresh();

        $userIds = model_pluck(TopicWatch::where([
            'topic_id' => $topic->topic_id,
            'notify_status' => false,
        ]), 'user_id');

        foreach (User::whereIn('user_id', $userIds)->get() as $user) {
            if (!present($user->user_email)) {
                continue;
            }

            if ($event->user !== null && $event->user->getKey() === $user->user_id) {
                continue;
            }

            if ($user->user_id === $topic->topic_last_poster_id) {
                continue;
            }

            if (!priv_check_user($user, 'ForumTopicWatchAdd', $topic)->can()) {
                continue;
            }

            Mail::to($user->user_email)
                ->queue(new ForumNewReply(compact('topic', 'user')));

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
