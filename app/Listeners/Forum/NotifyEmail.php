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
use App\Mail\ForumNewReply;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class NotifyEmail implements ShouldQueue
{
    public function notifyReply($event)
    {
        $topic = $event->topic->fresh();
        $watches = $topic->watches()
            ->where('mail', '=', true)
            ->where('notify_status', '=', false)
            ->has('user')
            ->with('user', 'topic')
            ->get();

        foreach ($watches as $watch) {
            $user = $watch->user;

            if (!present($user->user_email)) {
                continue;
            }

            if ($event->user !== null && $event->user->getKey() === $user->getKey()) {
                continue;
            }

            if ($user->getKey() === $topic->topic_last_poster_id) {
                continue;
            }

            if (!priv_check_user($user, 'ForumTopicWatch', $topic)->can()) {
                continue;
            }

            Mail::to($user->user_email)
                ->queue(new ForumNewReply(compact('topic', 'user')));

            $watch->update(['notify_status' => true]);
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            TopicWasReplied::class,
            static::class.'@notifyReply'
        );
    }
}
