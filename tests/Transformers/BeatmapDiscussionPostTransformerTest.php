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

use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\User;
use Tests\TestCase;

class BeatmapDiscussionPostTransformerTest extends TestCase
{
    /** @var BeatmapDiscussion */
    protected $beatmapDiscussion;

    public function testAdminDataIsExcludedWhenUsingOAuth()
    {
        $viewer = factory(User::class)->states('admin')->create();
        $post = factory(BeatmapDiscussionPost::class)->create([
            'beatmap_discussion_id' => $this->beatmapDiscussion->getKey(),
        ]);

        $post->softDeleteOrExplode($viewer);

        $this->actAsScopedUser($viewer);

        $json = json_item($post, 'BeatmapDiscussionPost');
        $this->assertEmpty($json);
    }


    public function testAdminDataIsNotExcludedWhenNotUsingOAuth()
    {
        $viewer = factory(User::class)->states('admin')->create();
        $post = factory(BeatmapDiscussionPost::class)->create([
            'beatmap_discussion_id' => $this->beatmapDiscussion->getKey(),
        ]);

        $post->softDeleteOrExplode($viewer);

        auth()->setUser($viewer);

        $json = json_item($post, 'BeatmapDiscussionPost');
        $this->assertNotEmpty($json);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->mapper = factory(User::class)->create();
        $this->beatmapset = factory(Beatmapset::class)->create([
            'user_id' => $this->mapper->getKey(),
        ]);
        $this->beatmap = $this->beatmapset->beatmaps()->save(factory(Beatmap::class)->make());
        $this->beatmapDiscussion = factory(BeatmapDiscussion::class, 'general')->create([
            'beatmapset_id' => $this->beatmapset->getKey(),
            'beatmap_id' => $this->beatmap->getKey(),
            'user_id' => factory(User::class)->create(),
        ]);
        // first post can't be deleted so fill one in for later.
        $this->beatmapDiscussion->beatmapDiscussionPosts()->save(factory(BeatmapDiscussionPost::class)->make());
    }
}
