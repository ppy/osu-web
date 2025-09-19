<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\Forum;

use App\Models\Forum\Topic;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class TopicTest extends TestCase
{
    public static function dataProviderForTestTitleLength(): array
    {
        $issueForumId = $GLOBALS['cfg']['osu']['forum']['issue_forum_ids'][0];

        return [
            [null, 100, false, true],
            [null, 101, false, false],
            [null, 100, true, false],
            [$issueForumId, 100, false, true],
            [$issueForumId, 101, false, false],
            [$issueForumId, 100, true, true],
            [$issueForumId, 101, true, false],
        ];
    }

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
        $topic->forum_id = $GLOBALS['cfg']['osu']['forum']['issue_forum_ids'][0];

        $topic->topic_title = '[invalid] herp a derp';
        $this->assertSame(['invalid'], $topic->issueTags());
    }

    public function testIssueTagsWithKeywordAsTitle()
    {
        $topic = new Topic();
        $topic->forum_id = $GLOBALS['cfg']['osu']['forum']['issue_forum_ids'][0];

        $topic->topic_title = 'invalid herp a derp';
        $this->assertSame([], $topic->issueTags());
    }

    #[DataProvider('dataProviderForTestTitleLength')]
    public function testTitleLength(?int $forumId, int $length, bool $withTag, bool $isValid): void
    {
        $topic = new Topic();
        $topic->forum_id = $forumId;

        $topic->topic_title = str_repeat('a', $length);
        if ($withTag) {
            $topic->topic_title .= ' [invalid]';
        }

        $this->assertSame($isValid, $topic->isValid());
        if (!$isValid) {
            $this->assertTrue(isset($topic->validationErrors()->all()['topic_title']));
        }
    }
}
