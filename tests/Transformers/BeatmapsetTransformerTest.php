<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Transformers;

use App\Models\Beatmapset;
use Laravel\Passport\Passport;
use Tests\TestCase;

class BeatmapsetTransformerTest extends TestCase
{
    public function testHasFavouritedWithOAuthNormalScopes()
    {
        $viewer = $this->createUserWithGroup([]);
        $beatmapset = factory(Beatmapset::class)->create();

        $this->actAsScopedUser($viewer, Passport::scopes()->pluck('id')->all());

        $json = json_item($beatmapset, 'Beatmapset');
        $this->assertArrayNotHasKey('has_favourited', $json);
    }

    public function testHasFavouritedWithOAuthAllScope()
    {
        $viewer = $this->createUserWithGroup([]);
        $beatmapset = factory(Beatmapset::class)->create();

        $this->actAsScopedUser($viewer);

        $json = json_item($beatmapset, 'Beatmapset');
        $this->assertArrayHasKey('has_favourited', $json);
    }

    public function testHasFavouritedWithoutOAuth()
    {
        $viewer = $this->createUserWithGroup([]);
        $beatmapset = factory(Beatmapset::class)->create();

        $this->actAsUser($viewer);

        $json = json_item($beatmapset, 'Beatmapset');
        $this->assertArrayHasKey('has_favourited', $json);
    }

    /**
     * @dataProvider groupsDataProvider
     */
    public function testGroupPermissionsWithOAuth($groupIdentifier)
    {
        $viewer = $this->createUserWithGroup($groupIdentifier);
        $beatmapset = factory(Beatmapset::class)->states('deleted')->create();
        $this->actAsScopedUser($viewer);

        $json = json_item($beatmapset, 'Beatmapset');

        $this->assertEmpty($json);
    }

    /**
     * @dataProvider groupsDataProvider
     */
    public function testGroupPermissionsWithoutOAuth($groupIdentifier, $visible)
    {
        $viewer = $this->createUserWithGroup($groupIdentifier);
        $beatmapset = factory(Beatmapset::class)->states('deleted')->create();
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
            [null, false],
        ];
    }
}
