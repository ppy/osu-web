<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
