<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Transformers;

use App\Models\Forum\Topic;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class PollOptionTransformerTest extends TestCase
{
    /**
     * @dataProvider voteCountPermissionsDataProvider
     */
    public function testVoteCountPermissions(
        bool $isOAuth,
        bool $pollEnded,
        bool $isTopicOwner,
        ?string $groupIdentifier,
        bool $voteCountVisible,
    ): void {
        $actor = User::factory()->withGroup($groupIdentifier)->create();
        $topicAttributes = [
            'poll_hide_results' => true,
            'poll_length' => 86400, // 1 day
            'topic_time' => Carbon::now(),
        ];

        if ($pollEnded) {
            $topicAttributes['topic_time']->subRealDay();
        }

        if ($isTopicOwner) {
            $topicAttributes['topic_poster'] = $actor->getKey();
        }

        $topic = Topic::factory()->poll()->withPost()->create($topicAttributes);

        if ($isOAuth) {
            $this->actAsScopedUser($actor);
        } else {
            $this->actAsUser($actor);
        }

        $pollOptionJson = json_item($topic->pollOptions()->first(), 'Forum\PollOption');

        if ($voteCountVisible) {
            $this->assertArrayHasKey('vote_count', $pollOptionJson);
        } else {
            $this->assertArrayNotHasKey('vote_count', $pollOptionJson);
        }
    }

    /**
     * Data in order:
     * - Whether request is OAuth
     * - Whether poll has ended
     * - Whether authenticated user is the topic owner
     * - Authenticated user's group identifier
     * - Whether vote count should be visible
     */
    public function voteCountPermissionsDataProvider(): array
    {
        return [
            [true,  true,  true,  'admin', true],
            [true,  true,  true,  'gmt',   true],
            [true,  true,  true,  null,    true],
            [true,  true,  false, 'admin', true],
            [true,  true,  false, 'gmt',   true],
            [true,  true,  false, null,    true],
            [true,  false, true,  'admin', false],
            [true,  false, true,  'gmt',   false],
            [true,  false, true,  null,    false],
            [true,  false, false, 'admin', false],
            [true,  false, false, 'gmt',   false],
            [true,  false, false, null,    false],
            [false, true,  true,  'admin', true],
            [false, true,  true,  'gmt',   true],
            [false, true,  true,  null,    true],
            [false, true,  false, 'admin', true],
            [false, true,  false, 'gmt',   true],
            [false, true,  false, null,    true],
            [false, false, true,  'admin', true],
            [false, false, true,  'gmt',   true],
            [false, false, true,  null,    true],
            [false, false, false, 'admin', true],
            [false, false, false, 'gmt',   true],
            [false, false, false, null,    false],
        ];
    }
}
