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

    private static function archiveCompletedIssueTopics(): void
    {
        $map = $GLOBALS['cfg']['osu']['forum']['issue_forum_archive_map'];
        $targets = Forum::whereIn('forum_id', array_values($map))->get()->keyBy('forum_id');

        $topics = Topic
            ::whereIn('forum_id', array_keys($map))
            ->archivable()
            ->hasAnyTags(['resolved', 'added', 'duplicate', 'denied', 'invalid'])
            ->get();

        foreach ($topics as $topic) {
            $topic->moveTo($targets[$map[$topic->forum_id]]);
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

        $this->info('Archiving completed issue topics');
        static::archiveCompletedIssueTopics();

        $this->info('Done.');
    }
}
