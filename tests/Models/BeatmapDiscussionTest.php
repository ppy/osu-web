<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models;

use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\Beatmapset;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;

class BeatmapDiscussionTest extends TestCase
{
    /**
     * Valid beatmapset status always maps to a scope method sanity test.
     *
     * @dataProvider validBeatmapsetStatuses
     */
    public function testBeatmapsetScopesExist($scope)
    {
        $this->assertInstanceOf(Builder::class, Beatmapset::$scope());
    }

    public function testMapperPost()
    {
        $mapper = factory(User::class)->create();
        $beatmapset = Beatmapset::factory()->create([
            'discussion_enabled' => true,
            'user_id' => $mapper,
        ]);
        $beatmap = $beatmapset->beatmaps()->save(Beatmap::factory()->make());

        $discussion = $this->newDiscussion($beatmapset);
        $discussion->fill([
            'beatmap_id' => $beatmap->beatmap_id,
            'message_type' => 'mapper_note',
            'user_id' => $mapper->getKey(),
        ]);

        $this->assertTrue($discussion->isValid());

        $discussion->message_type = 'problem';
        $this->assertTrue($discussion->isValid());

        $discussion->message_type = 'suggestion';
        $this->assertTrue($discussion->isValid());

        $discussion->message_type = 'praise';
        $this->assertTrue($discussion->isValid());

        $discussion->beatmapset->update(['approved' => Beatmapset::STATES['pending']]);
        $discussion->beatmap_id = null;
        $discussion->message_type = 'hype';
        $this->assertFalse($discussion->isValid());
    }

    public function testModderPost()
    {
        $mapper = factory(User::class)->create();
        $beatmapset = Beatmapset::factory()->create([
            'discussion_enabled' => true,
            'user_id' => $mapper,
        ]);
        $beatmap = $beatmapset->beatmaps()->save(Beatmap::factory()->make());
        $modder = factory(User::class)->create();

        $discussion = $this->newDiscussion($beatmapset);
        $discussion->fill([
            'beatmap_id' => $beatmap->beatmap_id,
            'message_type' => 'mapper_note',
            'user_id' => $modder->getKey(),
        ]);

        $this->assertTrue($discussion->isValid());

        $discussion->message_type = 'problem';
        $this->assertTrue($discussion->isValid());

        $discussion->message_type = 'suggestion';
        $this->assertTrue($discussion->isValid());

        $discussion->message_type = 'praise';
        $this->assertTrue($discussion->isValid());

        $discussion->beatmapset->update(['approved' => Beatmapset::STATES['ranked']]);
        $discussion->message_type = 'hype';
        $this->assertFalse($discussion->isValid());

        $discussion->beatmap_id = null;
        $this->assertFalse($discussion->isValid());

        $discussion->beatmapset->update(['approved' => Beatmapset::STATES['pending']]);
        $this->assertTrue($discussion->isValid());
    }

    public function testIsValid()
    {
        $beatmapset = Beatmapset::factory()->create(['discussion_enabled' => true]);
        $beatmap = $beatmapset->beatmaps()->save(Beatmap::factory()->make());

        $otherBeatmapset = Beatmapset::factory()->create();
        $otherBeatmap = $otherBeatmapset->beatmaps()->save(Beatmap::factory()->make());

        $validTimestamp = ($beatmap->total_length + 10) * 1000;
        $invalidTimestamp = $validTimestamp + 1;

        // blank everything not fine
        $discussion = $this->newDiscussion($beatmapset);
        $this->assertFalse($discussion->isValid());

        // is valid with message_type
        $discussion = $this->newDiscussion($beatmapset);
        $discussion->fill(['message_type' => 'problem']);
        $this->assertTrue($discussion->isValid());

        // just beatmap_id is not fine (per-beatmap general)
        $discussion = $this->newDiscussion($beatmapset);
        $discussion->fill(['beatmap_id' => $beatmap->beatmap_id]);
        $this->assertFalse($discussion->isValid());

        // with beatmap_id and message_type is fine (per-beatmap general)
        $discussion = $this->newDiscussion($beatmapset);
        $discussion->fill([
            'beatmap_id' => $beatmap->beatmap_id,
            'message_type' => 'problem',
        ]);
        $this->assertTrue($discussion->isValid());

        // complete data is fine as well
        $discussion = $this->newDiscussion($beatmapset);
        $discussion->fill(['timestamp' => $validTimestamp, 'message_type' => 'praise', 'beatmap_id' => $beatmap->beatmap_id]);
        $this->assertTrue($discussion->isValid());

        // Including timestamp 0
        $discussion = $this->newDiscussion($beatmapset);
        $discussion->fill(['timestamp' => 0, 'message_type' => 'praise', 'beatmap_id' => $beatmap->beatmap_id]);
        $this->assertTrue($discussion->isValid());

        // just timestamp is not valid
        $discussion = $this->newDiscussion($beatmapset);
        $discussion->fill(['timestamp' => $validTimestamp]);
        $this->assertFalse($discussion->isValid());

        // nor is wrong timestamp
        $discussion = $this->newDiscussion($beatmapset);
        $discussion->fill(['timestamp' => $invalidTimestamp, 'message_type' => 'praise', 'beatmap_id' => $beatmap->beatmap_id]);
        $this->assertFalse($discussion->isValid());
    }

    public function testSoftDeleteOrExplode()
    {
        $beatmapset = Beatmapset::factory()->create(['discussion_enabled' => true]);
        $beatmap = $beatmapset->beatmaps()->save(Beatmap::factory()->make());
        $user = factory(User::class)->create();
        $discussion = BeatmapDiscussion::create([
            'beatmapset_id' => $beatmapset->getKey(),
            'beatmap_id' => $beatmap->getKey(),
            'user_id' => $user->getKey(),
            'message_type' => 'suggestion',
        ]);

        $this->assertFalse($discussion->trashed());

        // Soft delete.
        $discussion->softDeleteOrExplode($user);
        $discussion = $discussion->fresh();
        $this->assertTrue($discussion->trashed());

        // Restore.
        $discussion->restore($user);
        $discussion = $discussion->fresh();
        $this->assertFalse($discussion->trashed());

        // Soft delete with deleted beatmap.
        $beatmap->delete();
        $discussion->softDeleteOrExplode($user);
        $discussion = $discussion->fresh();
        $this->assertTrue($discussion->trashed());

        // Restore with deleted beatmap.
        $discussion->restore($user);
        $discussion = $discussion->fresh();
        $this->assertFalse($discussion->trashed());
    }

    public function validBeatmapsetStatuses()
    {
        return array_map(function ($status) {
            return [camel_case($status)];
        }, BeatmapDiscussion::VALID_BEATMAPSET_STATUSES);
    }

    private function newDiscussion($beatmapset)
    {
        return new BeatmapDiscussion(['beatmapset_id' => $beatmapset->getKey()]);
    }
}
