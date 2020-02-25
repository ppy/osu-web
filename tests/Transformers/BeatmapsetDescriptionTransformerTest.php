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
use App\Models\User;
use Tests\TestCase;

class BeatmapsetDescriptionTransformerTest extends TestCase
{
    /** @var Beatmapset */
    protected $beatmapset;

    /** @var User */
    protected $mapper;

    /**
     * @dataProvider groupsDataProvider
     */
    public function testWithOAuth($groupIdentifier)
    {
        $viewer = factory(User::class)->states($groupIdentifier)->create();
        $this->actAsScopedUser($viewer);

        $json = json_item($this->beatmapset, 'BeatmapsetDescription');

        $this->assertArrayNotHasKey('bbcode', $json);
    }

    /**
     * @dataProvider groupsDataProvider
     */
    public function testWithoutOAuth($groupIdentifier, $visible)
    {
        $viewer = factory(User::class)->states($groupIdentifier)->create();
        $this->actAsUser($viewer);

        $json = json_item($this->beatmapset, 'BeatmapsetDescription');

        if ($visible) {
            $this->assertArrayHasKey('bbcode', $json);
        } else {
            $this->assertArrayNotHasKey('bbcode', $json);
        }
    }

    public function testUserIsGuest()
    {
        $json = json_item($this->beatmapset, 'BeatmapsetDescription');

        $this->assertArrayHasKey('description', $json);
        $this->assertArrayNotHasKey('bbcode', $json);
    }

    public function testUserIsMapper()
    {
        $this->actAsUser($this->mapper);

        $json = json_item($this->beatmapset, 'BeatmapsetDescription');

        $this->assertArrayHasKey('description', $json);
        $this->assertArrayHasKey('bbcode', $json);
    }

    public function testUserIsNotMapper()
    {
        $this->actAsUser(factory(User::class)->create());

        $json = json_item($this->beatmapset, 'BeatmapsetDescription');

        $this->assertArrayHasKey('description', $json);
        $this->assertArrayNotHasKey('bbcode', $json);
    }

    public function groupsDataProvider()
    {
        return [
            ['admin', true],
            ['bng', false],
            ['gmt', true],
            ['nat', true],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->mapper = factory(User::class)->create();
        $this->beatmapset = factory(Beatmapset::class)->create([
            'user_id' => $this->mapper->getKey(),
        ]);
    }
}
