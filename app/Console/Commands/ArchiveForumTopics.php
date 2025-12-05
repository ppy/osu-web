<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Forum\Forum;
use App\Models\Forum\Topic;
use Illuminate\Console\Command;

class ArchiveForumTopics extends Command
{
    protected $description = 'Archive support related forum topics.';
    protected $signature = 'archive-forum-topics';

    private static function archiveCompletedFeatureTopics(): void
    {
        $topics = Topic
            ::where('forum_id', $GLOBALS['cfg']['osu']['forum']['feature_forum_id'])
            ->archivable()
            ->hasAnyTags(['resolved', 'added', 'duplicate', 'denied'])
            ->get();
        $targetForum = Forum::findOrFail($GLOBALS['cfg']['osu']['forum']['feature_completed_forum_id']);

        foreach ($topics as $topic) {
            $topic->moveTo($targetForum);
        }
    }

    private static function archiveCompletedHelpTopics(): void
    {
        $topics = Topic
            ::whereIn('forum_id', [
                $GLOBALS['cfg']['osu']['forum']['help_forum_id'],
                $GLOBALS['cfg']['osu']['forum']['help_confirmed_forum_id'],
            ])->archivable()
            ->hasAnyTags(['resolved', 'added', 'duplicate', 'denied'])
            ->get();
        $targetForum = Forum::findOrFail($GLOBALS['cfg']['osu']['forum']['help_archived_forum_id']);

        foreach ($topics as $topic) {
            $topic->moveTo($targetForum);
        }
    }

    private static function archiveOldHelpTopics(): void
    {
        $maxTime = time() - 60 * 86400;

        $topics = Topic
            ::where('forum_id', $GLOBALS['cfg']['osu']['forum']['help_forum_id'])
            ->archivable()
            ->where('topic_last_post_time', '<', $maxTime)
            ->doesntHaveTags(['confirmed'])
            ->get();
        $targetForum = Forum::findOrFail($GLOBALS['cfg']['osu']['forum']['help_archived_forum_id']);

        foreach ($topics as $topic) {
            $topic->setIssueTag('archived', false);
            $topic->moveTo($targetForum);
        }
    }

    public function handle()
    {
        $this->info('Archiving old help forum topics');
        static::archiveOldHelpTopics();

        $this->info('Archiving completed help forum topics');
        static::archiveCompletedHelpTopics();

        $this->info('Archiving completed featured request forum topics');
        static::archiveCompletedFeatureTopics();

        $this->info('Done.');
    }
}
