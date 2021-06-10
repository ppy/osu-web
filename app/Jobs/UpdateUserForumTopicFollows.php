<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs;

use App\Libraries\Notification\BatchIdentities;
use App\Models\UserNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

/**
 * Checks access permission of specified topic for all currently watching users.
 */
class UpdateUserForumTopicFollows implements ShouldQueue
{
    use InteractsWithQueue, Queueable;

    protected $topic;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($topic)
    {
        $this->topic = $topic;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        app('OsuAuthorize')->cacheReset();

        foreach ($this->topic->watches()->with(['user', 'topic.forum'])->get() as $watch) {
            $user = $watch->user;
            $topic = $watch->topic;

            if ($user === null || $topic === null || priv_check_user($user, 'ForumTopicWatch', $topic)->can()) {
                continue;
            }

            $watch->delete();
            UserNotification::batchDestroy(
                $user,
                BatchIdentities::fromParams(['identities' => [
                    [
                        'object_id' => $topic->getKey(),
                        'object_type' => $topic->getMorphClass()],
                    ],
                ])
            );
        }
    }
}
