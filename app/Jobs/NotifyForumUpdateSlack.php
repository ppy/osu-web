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

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Slack;

class NotifyForumUpdateSlack implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $topic;
    public $post;
    public $user;
    public $prefix;
    public $message;

    public function __construct($data, $type)
    {
        $this->topic = $data['topic'];
        $this->post = $data['post'];
        $this->user = $data['user'];

        switch ($type) {
            case 'new':
                $this->message = 'A new topic has been created at watched forum';
                $this->prefix = 'New topic';
                break;
            case 'reply':
                $this->message = 'A watched topic has been replied to';
                $this->prefix = 'Reply';
                break;
        }
    }

    public function dispatchIfNeeded()
    {
        if (!$this->shouldNotify()) {
            return;
        }

        return dispatch($this);
    }

    public function handle()
    {
        if ($this->topic === null || $this->post === null || $this->user === null) {
            return;
        }

        // FIXME: travis explodes without this
        if (app()->runningUnitTests()) {
            return;
        }

        return Slack::to('dev')
            ->attach([
                'color' => $this->notifyColour(),
                'fallback' => $this->message,
                'text' => $this->post->post_text,
            ])
            ->send($this->mainMessage());
    }

    private function shouldNotify()
    {
        return in_array($this->topic->getKey(), config('osu.forum.slack_watch.topic_ids'), true) ||
            in_array($this->topic->forum_id, config('osu.forum.slack_watch.forum_ids'), true);
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
        return $this->user->isAdmin() || $this->user->isDev();
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
