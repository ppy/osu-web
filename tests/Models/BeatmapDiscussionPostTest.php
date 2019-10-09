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

namespace Tests\Models;

use App\Exceptions\ModelNotSavedException;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\User;
use Exception;
use Tests\TestCase;

class BeatmapDiscussionPostTest extends TestCase
{
    public function testMessageCharacterLimitGeneralAll()
    {
        $beatmapset = factory(Beatmapset::class)->create(['discussion_enabled' => true]);
        $beatmap = $beatmapset->beatmaps()->save(factory(Beatmap::class)->make());
        $user = factory(User::class)->create();
        $discussion = BeatmapDiscussion::create([
            'beatmapset_id' => $beatmapset->getKey(),
            'user_id' => $user->getKey(),
            'message_type' => 'suggestion',
        ]);

        $post = $discussion->beatmapDiscussionPosts()->make([
            'user_id' => $user->getKey(),
            'message' => str_repeat('a', 2000),
        ]);

        $this->assertTrue($post->isValid());
    }

    public function testMessageCharacterLimitGeneral()
    {
        $beatmapset = factory(Beatmapset::class)->create(['discussion_enabled' => true]);
        $beatmap = $beatmapset->beatmaps()->save(factory(Beatmap::class)->make());
        $user = factory(User::class)->create();
        $discussion = BeatmapDiscussion::create([
            'beatmapset_id' => $beatmapset->getKey(),
            'beatmap_id' => $beatmap->getKey(),
            'user_id' => $user->getKey(),
            'message_type' => 'suggestion',
        ]);

        $post = $discussion->beatmapDiscussionPosts()->make([
            'user_id' => $user->getKey(),
            'message' => str_repeat('a', 2000),
        ]);

        $this->assertTrue($post->isValid());
    }

    public function testMessageCharacterLimitTimeline()
    {
        $beatmapset = factory(Beatmapset::class)->create(['discussion_enabled' => true]);
        $beatmap = $beatmapset->beatmaps()->save(factory(Beatmap::class)->make());
        $user = factory(User::class)->create();
        $discussion = BeatmapDiscussion::create([
            'beatmapset_id' => $beatmapset->getKey(),
            'beatmap_id' => $beatmap->getKey(),
            'user_id' => $user->getKey(),
            'message_type' => 'suggestion',
            'timestamp' => 0,
        ]);

        $post = $discussion->beatmapDiscussionPosts()->make([
            'user_id' => $user->getKey(),
            'message' => str_repeat('a', 2000),
        ]);

        $this->assertFalse($post->isValid());

        $post->message = str_repeat('b', BeatmapDiscussionPost::MESSAGE_LIMIT_TIMELINE);

        $this->assertTrue($post->isValid());
    }

    public function testSoftDeleteOrExplode()
    {
        $beatmapset = factory(Beatmapset::class)->create(['discussion_enabled' => true]);
        $beatmap = $beatmapset->beatmaps()->save(factory(Beatmap::class)->make());
        $user = factory(User::class)->create();
        $discussion = BeatmapDiscussion::create([
            'beatmapset_id' => $beatmapset->getKey(),
            'beatmap_id' => $beatmap->getKey(),
            'user_id' => $user->getKey(),
            'message_type' => 'suggestion',
        ]);
        $startingPost = $discussion->beatmapDiscussionPosts()->create([
            'user_id' => $user->getKey(),
            'message' => 'Hello',
        ]);
        $post = $discussion->beatmapDiscussionPosts()->create([
            'user_id' => $user->getKey(),
            'message' => 'Hello',
        ]);

        $this->assertFalse($post->trashed());

        // No soft delete starting post.
        try {
            $startingPost->softDeleteOrExplode($user);
        } catch (Exception $e) {
            $this->assertInstanceOf(ModelNotSavedException::class, $e);
        }
        $startingPost = $startingPost->fresh();
        $this->assertFalse($startingPost->trashed());

        // Soft delete.
        $post->softDeleteOrExplode($user);
        $post = $post->fresh();
        $this->assertTrue($post->trashed());

        // Restore.
        $post->restore($user);
        $post = $post->fresh();
        $this->assertFalse($post->trashed());

        // Soft delete with deleted discussion.
        $discussion->softDeleteOrExplode($user);
        $post->softDeleteOrExplode($user);
        $post = $post->fresh();
        $this->assertTrue($post->trashed());

        // Restore with deleted discussion.
        $post->restore($user);
        $post = $post->fresh();
        $this->assertFalse($post->trashed());
    }
}
