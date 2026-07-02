<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Transformers;

use App\Models\Forum\Topic;
use App\Transformers\Forum\TopicTransformer;
use Tests\TestCase;

class TopicTransformerTest extends TestCase
{
    public function testPollDoesNotExist(): void
    {
        $topic = Topic::factory()->create();
        $topicJson = json_item($topic, new TopicTransformer());

        $this->assertNull($topicJson['poll']);
    }

    public function testPollExists(): void
    {
        $topic = Topic::factory()->poll()->withPost()->create();
        $topicJson = json_item($topic, new TopicTransformer());

        $this->assertIsArray($topicJson['poll']);
    }
}
