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
use App\Models\Forum\Topic;

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
