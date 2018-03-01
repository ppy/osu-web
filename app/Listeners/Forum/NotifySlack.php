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

use App\Events\Forum\TopicWasCreated;
use App\Events\Forum\TopicWasReplied;
use Illuminate\Contracts\Queue\ShouldQueue;
use Slack;

class NotifySlack implements ShouldQueue
{
    public $post;
    public $topic;
    public $user;
    public $prefix;
    public $message;

    public function notifyNew($event)
    {
        if (!in_array($event->topic->forum_id, config('osu.forum.slack_watch.forum_ids'), true)) {
            return;
        }

        return $this->notify($event, [
            'message' => 'A new topic has been created at watched forum',
            'prefix' => 'New topic',
        ]);
    }

    public function notifyReply($event)
    {
        if (!in_array($event->topic->topic_id, config('osu.forum.slack_watch.topic_ids'), true) &&
            !in_array($event->topic->forum_id, config('osu.forum.slack_watch.forum_ids'), true)) {
            return;
        }

        return $this->notify($event, [
            'message' => 'A watched topic has been replied to',
            'prefix' => 'Reply',
        ]);
    }

    public function notify($event, $options)
    {
        $this->post = $event->post;
        $this->topic = $event->topic;
        $this->user = $event->user;
        $this->prefix = $options['prefix'];
        $this->message = html_entity_decode_better($options['message']);

        return Slack::to('dev')
            ->attach([
                'color' => $this->notifyColour(),
                'fallback' => $this->message,
                'text' => $this->post->post_text,
            ])
            ->send($this->mainMessage());
    }

    public function subscribe($events)
    {
        $events->listen(
            TopicWasCreated::class,
            static::class.'@notifyNew'
        );

        $events->listen(
            TopicWasReplied::class,
            static::class.'@notifyReply'
        );
    }

    private function replyCommand()
    {
        $topicHash = base62_encode($this->topic->topic_id);

        return "/msg #support !reply {$topicHash} <text>";
    }

    private function notifyColour()
    {
        if ($this->isFromSupport()) {
            return 'good';
        } elseif ($this->topic->topic_poster === $this->user->user_id) {
            return 'warning';
        } else {
            return 'danger';
        }
    }

    private function mainMessage()
    {
        $user = $this->userText();
        $url = post_url($this->post->topic_id, $this->post->post_id);
        $title = $this->topic->topic_title;
        $command = $this->replyCommand();
        $prefix = $this->prefix;

        return "{$prefix}: <{$url}|{$title}> by {$user} `{$command}`";
    }

    private function isFromSupport()
    {
        return $this->user->isAdmin() || $this->user->isMod() || $this->user->isDev();
    }

    private function userText()
    {
        $suffix = '';
        if ($this->isFromSupport()) {
            $suffix = ' (Support Team)';
        } elseif ($this->post->post_id !== $this->topic->topic_first_post_id &&
            $this->topic->topic_poster === $this->user->user_id) {
            $suffix = ' (OP)';
        }

        return $this->user->username.$suffix;
    }
}
