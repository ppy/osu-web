<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\Beatmapset;
use App\Models\User;

class BeatmapDiscussionTest extends TestCase
{
    public function testMapperPost()
    {
        $mapper = factory(User::class)->create();
        $beatmapset = factory(Beatmapset::class)->create([
            'discussion_enabled' => true,
            'user_id' => $mapper->getKey(),
        ]);
        $beatmap = $beatmapset->beatmaps()->save(factory(Beatmap::class)->make());

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
        $beatmapset = factory(Beatmapset::class)->create([
            'discussion_enabled' => true,
            'user_id' => $mapper->getKey(),
        ]);
        $beatmap = $beatmapset->beatmaps()->save(factory(Beatmap::class)->make());
        $modder = factory(User::class)->create();

        $discussion = $this->newDiscussion($beatmapset);
        $discussion->fill([
            'beatmap_id' => $beatmap->beatmap_id,
            'message_type' => 'mapper_note',
            'user_id' => $modder->getKey(),
        ]);

        $this->assertFalse($discussion->isValid());

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
        $beatmapset = factory(Beatmapset::class)->create(['discussion_enabled' => true]);
        $beatmap = $beatmapset->beatmaps()->save(factory(Beatmap::class)->make());

        $otherBeatmapset = factory(Beatmapset::class)->create();
        $otherBeatmap = $otherBeatmapset->beatmaps()->save(factory(Beatmap::class)->make());

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
        $beatmapset = factory(Beatmapset::class)->create(['discussion_enabled' => true]);
        $beatmap = $beatmapset->beatmaps()->save(factory(Beatmap::class)->make());
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

    private function newDiscussion($beatmapset)
    {
        return new BeatmapDiscussion(['beatmapset_id' => $beatmapset->getKey()]);
    }
}
