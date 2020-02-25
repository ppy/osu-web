<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

            [null, BeatmapsetEvent::NOMINATE, true, true],
            [null, BeatmapsetEvent::KUDOSU_ALLOW, false, false],
            [null, BeatmapsetEvent::DISCUSSION_DELETE, false, false],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $mapper = factory(User::class)->create();
        $this->beatmapset = factory(Beatmapset::class)->states('with_discussion')->create([
            'user_id' => $mapper->getKey(),
        ]);
    }
}
