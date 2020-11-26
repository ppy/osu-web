<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Transformers;

use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\User;
use Tests\TestCase;

class BeatmapDiscussionPostTransformerTest extends TestCase
{
    /** @var BeatmapDiscussion */
    protected $beatmapDiscussion;

    /** @var BeatmapDiscussionPost */
    protected $deletedPost;

    /**
     * @dataProvider groupsDataProvider
     */
    public function testWithOAuth($groupIdentifier)
    {
        $viewer = $this->createUserWithGroup($groupIdentifier);
        $this->actAsScopedUser($viewer);

        $json = json_item($this->deletedPost, 'BeatmapDiscussionPost');
        $this->assertEmpty($json);
    }

    /**
     * @dataProvider groupsDataProvider
     */
    public function testWithoutOAuth($groupIdentifier, $visible)
    {
        $viewer = $this->createUserWithGroup($groupIdentifier);
        $this->actAsUser($viewer);

        $json = json_item($this->deletedPost, 'BeatmapDiscussionPost');

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
        $beatmapset = factory(Beatmapset::class)->states('with_discussion')->create([
            'user_id' => $mapper->getKey(),
        ]);

        $this->beatmapDiscussion = $beatmapset->beatmapDiscussions()->first();
        $this->beatmapDiscussion->beatmapDiscussionPosts()->saveMany(factory(BeatmapDiscussionPost::class, 2)->make());
        $this->deletedPost = $this->beatmapDiscussion->beatmapDiscussionPosts()->last();

        $this->deletedPost->softDeleteOrExplode($mapper);
    }
}
