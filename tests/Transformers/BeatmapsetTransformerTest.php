<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Transformers;

use App\Models\Beatmapset;
use Tests\TestCase;

class BeatmapsetTransformerTest extends TestCase
{
    /**
     * @dataProvider groupsDataProvider
     */
    public function testDeletedBeatmapsetGroupPermissionsWithOAuth($groupIdentifier)
    {
        $viewer = $this->createUserWithGroup($groupIdentifier);
        $beatmapset = Beatmapset::factory()->deleted()->create();
        $this->actAsScopedUser($viewer);

        $json = json_item($beatmapset, 'Beatmapset');

        $this->assertEmpty($json);
    }

    /**
     * @dataProvider groupsDataProvider
     */
    public function testDeletedBeatmapsetGroupPermissionsWithoutOAuth($groupIdentifier, $visible)
    {
        $viewer = $this->createUserWithGroup($groupIdentifier);
        $beatmapset = Beatmapset::factory()->deleted()->create();
        $this->actAsUser($viewer);

        $json = json_item($beatmapset, 'Beatmapset');

        if ($visible) {
            $this->assertNotEmpty($json);
        } else {
            $this->assertEmpty($json);
        }
    }

    public function groupsDataProvider()
    {
        return [
            ['admin', true],
            ['bng', true],
            ['gmt', true],
            ['nat', true],
            [[], false],
        ];
    }
}
