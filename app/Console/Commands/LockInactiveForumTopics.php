<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\Forum\Topic;

#[Signature('forum:lock-inactive-forum-topics')]
#[Description('Locks forum topics that have been inactive for extended periods of time.')]
class LockInactiveForumTopics extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        static::lockInactiveForumTopics();

        $this->info('Done locking inactive forum topics.');
    }

    private static function lockInactiveForumTopics(): void
    {
        $lockAfterMonths = config('osu.forum.lock_necropost_months');
        $lockAfterDate = now()->subMonths($lockAfterMonths)->timestamp;

        Topic::where('topic_last_post_time', '<', $lockAfterDate)
            ->where('topic_status', Topic::STATUS_UNLOCKED)
            ->update(['topic_status' => Topic::STATUS_LOCKED]);
    }
}
