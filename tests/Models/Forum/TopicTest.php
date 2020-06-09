<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\Forum;

use App\Models\Forum\Topic;
use Tests\TestCase;

class TopicTest extends TestCase
{
    public function testTitleTrimOnAssignment()
    {
        $title = 'fine topic title';
        $topic = new Topic(['topic_title' => " {$title} "]);
        $this->assertSame($title, $topic->topic_title);

        $topic->topic_title = '  ';
        $this->assertSame('', $topic->topic_title);

        $topic->topic_title = '		'; // tabs
        $this->assertSame('', $topic->topic_title);

        $topic->topic_title = '　　'; // double-width spaces
        $this->assertSame('', $topic->topic_title);
    }

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
