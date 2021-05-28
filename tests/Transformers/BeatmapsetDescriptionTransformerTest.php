<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        $viewer = $this->createUserWithGroup($groupIdentifier);
        $this->actAsScopedUser($viewer);

        $json = json_item($this->beatmapset, 'BeatmapsetDescription');

        $this->assertArrayNotHasKey('bbcode', $json);
    }

    /**
     * @dataProvider groupsDataProvider
     */
    public function testWithoutOAuth($groupIdentifier, $visible)
    {
        $viewer = $this->createUserWithGroup($groupIdentifier);
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
            [[], false],
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
