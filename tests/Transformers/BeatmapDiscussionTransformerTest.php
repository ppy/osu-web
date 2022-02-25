<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Transformers;

use App\Models\Beatmapset;
use App\Models\User;
use Tests\TestCase;

class BeatmapDiscussionTransformerTest extends TestCase
{
    protected $deletedBeatmapDiscussion;

    /**
     * @dataProvider groupsDataProvider
     */
    public function testWithOAuth(?string $groupIdentifier)
    {
        $viewer = User::factory()->withGroup($groupIdentifier)->create();

        $this->actAsScopedUser($viewer);

        $json = json_item($this->deletedBeatmapDiscussion, 'BeatmapDiscussion');

        $this->assertEmpty($json);
    }

    /**
     * @dataProvider groupsDataProvider
     */
    public function testWithoutOAuth(?string $groupIdentifier, bool $visible)
    {
        $viewer = User::factory()->withGroup($groupIdentifier)->create();
        $this->actAsUser($viewer);

        $json = json_item($this->deletedBeatmapDiscussion, 'BeatmapDiscussion');

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
            ['bng', false],
            ['gmt', true],
            ['nat', true],
            [null, false],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $beatmapset = Beatmapset::factory()->owner()->withDiscussion()->create();

        $this->deletedBeatmapDiscussion = $beatmapset->beatmapDiscussions()->first();
        $this->deletedBeatmapDiscussion->update(['deleted_at' => now()]);
    }
}
