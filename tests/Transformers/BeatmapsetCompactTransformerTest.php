<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Transformers;

use App\Models\Beatmapset;
use App\Transformers\BeatmapsetCompactTransformer;
use Tests\TestCase;

class BeatmapsetCompactTransformerTest extends TestCase
{
    protected $beatmapset;
    protected $viewer;

    /**
     * @dataProvider regularOAuthScopesDataProvider
     */
    public function testHasFavouritedWithOAuthNormalScopes($scope)
    {
        $this->actAsScopedUser($this->viewer, [$scope]);

        $json = json_item($this->beatmapset, 'BeatmapsetCompact', ['has_favourited']);
        $this->assertArrayNotHasKey('has_favourited', $json);
    }

    public function testHasFavouritedWithOAuthAllScope()
    {
        $this->actAsScopedUser($this->viewer);

        $json = json_item($this->beatmapset, 'BeatmapsetCompact', ['has_favourited']);
        $this->assertArrayHasKey('has_favourited', $json);
    }

    public function testHasFavouritedWithoutOAuth()
    {
        $this->actAsUser($this->viewer);

        $json = json_item($this->beatmapset, 'BeatmapsetCompact', ['has_favourited']);
        $this->assertArrayHasKey('has_favourited', $json);
    }

    /**
     * @dataProvider propertyPermissionsDataProvider
     */
    public function testPropertyIsNotVisibleWithOAuth(string $property)
    {
        $this->actAsScopedUser($this->viewer);

        $json = json_item($this->beatmapset, 'BeatmapsetCompact', [$property]);
        $this->assertArrayNotHasKey($property, $json);
    }

    /**
     * @dataProvider propertyPermissionsDataProvider
     */
    public function testPropertyIsVisibleWithoutOAuth(string $property)
    {
        $this->actAsUser($this->viewer);

        $json = json_item($this->beatmapset, 'BeatmapsetCompact', [$property]);
        $this->assertArrayHasKey($property, $json);
    }

    public function propertyPermissionsDataProvider()
    {
        $data = [];
        $transformer = new BeatmapsetCompactTransformer();
        foreach ($transformer->getPermissions() as $property => $permission) {
            if ($permission === 'IsNotOAuth') {
                $data[] = [$property];
            }
        }

        return $data;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->viewer = $this->createUserWithGroup([]);
        $this->beatmapset = factory(Beatmapset::class)->create();
    }
}
