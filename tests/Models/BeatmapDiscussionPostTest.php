<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models;

use App\Exceptions\ModelNotSavedException;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\User;
use Ds\Set;
use Exception;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class BeatmapDiscussionPostTest extends TestCase
{
    public static function dataProviderForParseTimestamp()
    {
        return [
            ['00:00.00', null],
            ['00.00.000', null],
            ['00:00.000', 0],
            ['00:01.000', 1_000],
            ['01:00.000', 60_000],
            ['01:01.001', 61_001],
            ['12:34.567', 754_567],
            ['12:34:567', 754_567],
            ['12:34.567aa', null], // TODO: make behaviour consistent with js side decorators.
            ['12:34.567猫', 754_567], // non-alphanemeric is considered a word boundary.
            ['12:34.567aa, 00:00.001 (2|3,4)', 1],
            ['12:34.567 (1,2,3|4)', 754_567],
            ['01:00.000, 12:34.567', 60_000],
            ['01:00.000. abc 12:34.567', 60_000],
            ['abc01:00.000. abc 12:34.567', 754_567],
        ];
    }

    public function testMessageCharacterLimitGeneralAll()
    {
        $beatmapset = Beatmapset::factory()->create();
        $beatmap = $beatmapset->beatmaps()->save(Beatmap::factory()->make());
        $user = User::factory()->create();
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
        $beatmapset = Beatmapset::factory()->create();
        $beatmap = $beatmapset->beatmaps()->save(Beatmap::factory()->make());
        $user = User::factory()->create();
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
        $beatmapset = Beatmapset::factory()->create();
        $beatmap = $beatmapset->beatmaps()->save(Beatmap::factory()->make());
        $user = User::factory()->create();
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

    #[DataProvider('dataProviderForParseTimestamp')]
    public function testParseTimestamp(string $timestamp, ?int $expectedMilliseconds)
    {
        $this->assertSame($expectedMilliseconds, BeatmapDiscussionPost::parseTimestamp($timestamp));
    }

    public function testScopeOpenProblems()
    {
        $beatmapset = Beatmapset::factory()->create();
        $beatmap = $beatmapset->beatmaps()->save(Beatmap::factory()->make());
        $user = User::factory()->create();
        $discussion = BeatmapDiscussion::create([
            'beatmapset_id' => $beatmapset->getKey(),
            'beatmap_id' => $beatmap->getKey(),
            'user_id' => $user->getKey(),
            'message_type' => 'problem',
        ]);
        $discussion->beatmapDiscussionPosts()->create([
            'user_id' => $user->getKey(),
            'message' => 'This is a problem',
        ]);

        $this->assertSame(1, $beatmapset->beatmapDiscussions()->openProblems()->count());

        $beatmap->update(['deleted_at' => now()]);

        $this->assertSame(0, $beatmapset->beatmapDiscussions()->openProblems()->count());
    }

    public function testScopeByTypes()
    {
        $beatmapset = Beatmapset::factory()->create();
        $beatmap = $beatmapset->beatmaps()->save(Beatmap::factory()->make());
        $user = User::factory()->create();
        $discussion = BeatmapDiscussion::create([
            'beatmapset_id' => $beatmapset->getKey(),
            'beatmap_id' => $beatmap->getKey(),
            'user_id' => $user->getKey(),
            'message_type' => 'problem',
        ]);
        $posts = [
            'first' => $discussion->beatmapDiscussionPosts()->create([
                'user_id' => $user->getKey(),
                'message' => 'This is a problem',
            ]),
            'reply' => $discussion->beatmapDiscussionPosts()->create([
                'user_id' => $user->getKey(),
                'message' => 'This is a reply',
            ]),
            'system' => BeatmapDiscussionPost::generateLogResolveChange($user, true),
        ];
        $posts['system']->fill(['beatmap_discussion_id' => $discussion->getKey()])->save();

        $combinations = [];

        foreach (array_keys($posts) as $key) {
            $newCombinations = array_merge($combinations, [[$key]]);
            foreach ($combinations as $combination) {
                $newCombinations[] = array_merge($combination, [$key]);
            }
            $combinations = $newCombinations;
        }

        foreach ($combinations as $combination) {
            $combinationString = implode(', ', $combination);
            $queryResult = BeatmapDiscussionPost::byTypes(new Set($combination))->get();
            $this->assertSame(count($combination), $queryResult->count(), 'count for '.$combinationString);
            foreach ($combination as $type) {
                $this->assertNotNull($queryResult->find($posts[$type]->getKey()), 'has '.$type.' for '.$combinationString);
            }
        }
    }

    public function testSoftDeleteOrExplode()
    {
        $beatmapset = Beatmapset::factory()->create();
        $beatmap = $beatmapset->beatmaps()->save(Beatmap::factory()->make());
        $user = User::factory()->create();
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
