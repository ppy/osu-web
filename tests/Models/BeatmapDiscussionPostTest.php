<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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
