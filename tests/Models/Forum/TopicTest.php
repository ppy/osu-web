<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\Forum;

use App\Models\Forum\Topic;
use Tests\TestCase;

class TopicTest extends TestCase
{
    public function testIssueTags()
    {
        $topic = new Topic();
        $topic->forum_id = config('osu.forum.issue_forum_ids')[0];

        $topic->topic_title = '[invalid] herp a derp';
        $this->assertSame(['invalid'], $topic->issueTags());
    }

    public function testIssueTagsWithKeywordAsTitle()
    {
        $topic = new Topic();
        $topic->forum_id = config('osu.forum.issue_forum_ids')[0];

        $topic->topic_title = 'invalid herp a derp';
        $this->assertSame([], $topic->issueTags());
    }
}
