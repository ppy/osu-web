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
    public function testWithOAuth($groupIdentifier)
    {
        $viewer = $this->createUserWithGroup($groupIdentifier);

        $this->actAsScopedUser($viewer);

        $json = json_item($this->deletedBeatmapDiscussion, 'BeatmapDiscussion');

        $this->assertEmpty($json);
    }

    /**
     * @dataProvider groupsDataProvider
     */
    public function testWithoutOAuth($groupIdentifier, $visible)
    {
        $viewer = $this->createUserWithGroup($groupIdentifier);
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
            [[], false],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $mapper = factory(User::class)->create();
        $beatmapset = Beatmapset::factory()->withDiscussion()->create([
            'user_id' => $mapper,
        ]);

        $this->deletedBeatmapDiscussion = $beatmapset->beatmapDiscussions()->first();
        $this->deletedBeatmapDiscussion->update(['deleted_at' => now()]);
    }
}
