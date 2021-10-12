<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Transformers;

use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\User;
use Tests\TestCase;

class BeatmapsetEventTransformerTest extends TestCase
{
    /** @var Beatmapset */
    protected $beatmapset;

    /**
     * @dataProvider dataProvider
     */
    public function testWithOAuth($groupIdentifier, $eventType, $visibleWithOAuth)
    {
        $event = $this->beatmapset->events()->create([
            'type' => $eventType,
        ]);

        $viewer = $this->createUserWithGroup($groupIdentifier);
        $this->actAsScopedUser($viewer);

        $json = json_item($event, 'BeatmapsetEvent');

        if ($visibleWithOAuth) {
            $this->assertArrayHasKey('user_id', $json);
        } else {
            $this->assertArrayNotHasKey('user_id', $json);
        }
    }

    /**
     * @dataProvider dataProvider
     */
    public function testWithoutOAuth($groupIdentifier, $eventType, $visibleWithOAuth, $visibleWithoutOAuth)
    {
        $event = $this->beatmapset->events()->create([
            'type' => $eventType,
        ]);

        $viewer = $this->createUserWithGroup($groupIdentifier);
        $this->actAsUser($viewer);

        $json = json_item($event, 'BeatmapsetEvent');

        if ($visibleWithoutOAuth) {
            $this->assertArrayHasKey('user_id', $json);
        } else {
            $this->assertArrayNotHasKey('user_id', $json);
        }
    }

    public function dataProvider()
    {
        // one event type of each priviledge type.
        return [
            ['admin', BeatmapsetEvent::NOMINATE, true, true], // public
            ['admin', BeatmapsetEvent::KUDOSU_ALLOW, false, true], // kudosuModeration
            ['admin', BeatmapsetEvent::DISCUSSION_DELETE, false, true], // moderation

            ['bng', BeatmapsetEvent::NOMINATE, true, true],
            ['bng', BeatmapsetEvent::KUDOSU_ALLOW, false, true],
            ['bng', BeatmapsetEvent::DISCUSSION_DELETE, false, false],

            ['gmt', BeatmapsetEvent::NOMINATE, true, true],
            ['gmt', BeatmapsetEvent::KUDOSU_ALLOW, false, true],
            ['gmt', BeatmapsetEvent::DISCUSSION_DELETE, false, true],

            ['nat', BeatmapsetEvent::NOMINATE, true, true],
            ['nat', BeatmapsetEvent::KUDOSU_ALLOW, false, true],
            ['nat', BeatmapsetEvent::DISCUSSION_DELETE, false, true],

            [[], BeatmapsetEvent::NOMINATE, true, true],
            [[], BeatmapsetEvent::KUDOSU_ALLOW, false, false],
            [[], BeatmapsetEvent::DISCUSSION_DELETE, false, false],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $mapper = factory(User::class)->create();
        $this->beatmapset = Beatmapset::factory()->withDiscussion()->create([
            'user_id' => $mapper,
        ]);
    }
}
