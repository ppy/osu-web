<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Transformers;

use App\Models\Forum\Topic;
use Tests\TestCase;

class TopicTransformerTest extends TestCase
{
    public function testPollDoesNotExist(): void
    {
        $topic = factory(Topic::class)->create();
        $topicJson = json_item($topic, 'Forum\Topic');

        $this->assertNull($topicJson['poll']);
    }

    public function testPollExists(): void
    {
        $topic = factory(Topic::class)->states(['poll', 'with_first_post'])->create();
        $topicJson = json_item($topic, 'Forum\Topic');

        $this->assertIsArray($topicJson['poll']);
    }
}
