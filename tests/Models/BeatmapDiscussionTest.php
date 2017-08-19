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
use App\Models\BeatmapsetDiscussion;

class BeatmapDiscussionTest extends TestCase
{
    public function testIsValid()
    {
        $beatmapset = factory(Beatmapset::class)->create();
        $beatmap = $beatmapset->beatmaps()->save(factory(Beatmap::class)->make());

        $otherBeatmapset = factory(Beatmapset::class)->create();
        $otherBeatmap = $otherBeatmapset->beatmaps()->save(factory(Beatmap::class)->make());

        $beatmapsetDiscussion = BeatmapsetDiscussion::create(['beatmapset_id' => $beatmap->beatmapset_id]);

        $invalidTimestamp = $beatmap->total_length * 1000 + 1;

        // blank everything not fine
        $discussion = $this->newDiscussion($beatmapsetDiscussion);
        $this->assertFalse($discussion->isValid());

        // is valid with message_type
        $discussion = $this->newDiscussion($beatmapsetDiscussion);
        $discussion->fill(['message_type' => 'problem']);
        $this->assertTrue($discussion->isValid());

        // just beatmap_id is not fine (per-beatmap general)
        $discussion = $this->newDiscussion($beatmapsetDiscussion);
        $discussion->fill(['beatmap_id' => $beatmap->beatmap_id]);
        $this->assertFalse($discussion->isValid());

        // just beatmap_id is not fine (per-beatmap general)
        $discussion = $this->newDiscussion($beatmapsetDiscussion);
        $discussion->fill([
            'beatmap_id' => $beatmap->beatmap_id,
            'message_type' => 'problem',
        ]);
        $this->assertTrue($discussion->isValid());

        // complete data is fine as well
        $discussion = $this->newDiscussion($beatmapsetDiscussion);
        $discussion->fill(['timestamp' => 0, 'message_type' => 'praise', 'beatmap_id' => $beatmap->beatmap_id]);
        $this->assertTrue($discussion->isValid());

        // just timestamp is not valid
        $discussion = $this->newDiscussion($beatmapsetDiscussion);
        $discussion->fill(['timestamp' => 0]);
        $this->assertFalse($discussion->isValid());

        // nor is wrong beatmap_id
        $discussion = $this->newDiscussion($beatmapsetDiscussion);
        $discussion->fill(['timestamp' => 0, 'message_type' => 'praise', 'beatmap_id' => $otherBeatmap->beatmap_id]);
        $this->assertFalse($discussion->isValid());

        // nor is wrong timestamp
        $discussion = $this->newDiscussion($beatmapsetDiscussion);
        $discussion->fill(['timestamp' => $invalidTimestamp, 'message_type' => 'praise', 'beatmap_id' => $beatmap->beatmap_id]);
        $this->assertFalse($discussion->isValid());
    }

    private function newDiscussion($beatmapsetDiscussion)
    {
        return new BeatmapDiscussion(['beatmapset_discussion_id' => $beatmapsetDiscussion->id]);
    }
}
