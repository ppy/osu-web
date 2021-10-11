<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models;

use App\Models\Beatmap;
use App\Models\BeatmapPack;
use App\Models\Beatmapset;
use App\Models\Score\Best as ScoreBest;
use App\Models\User;
use Tests\TestCase;

class BeatmapPackTest extends TestCase
{
    public function testUserCompletionData()
    {
        $beatmapset = Beatmapset::factory()->create();
        $pack = factory(BeatmapPack::class)->create(['playmode' => null]);
        $pack->items()->create(['beatmapset_id' => $beatmapset->getKey()]);
        $scoreBest = factory(ScoreBest\Taiko::class)->create();
        $scoreBest->beatmap->update(['beatmapset_id' => $beatmapset->getKey()]);
        $user = User::find($scoreBest->user_id);

        $pack->refresh();

        // unspecified pack playmode, non-convert score
        $data = $pack->userCompletionData($user);
        $this->assertSame(1, count($data['beatmapset_ids']));
        $this->assertSame(true, $data['completed']);

        // specified pack playmode, non-convert score but different mode
        $pack->update(['playmode' => Beatmap::MODES['osu']]);
        $data = $pack->userCompletionData($user);
        $this->assertSame(0, count($data['beatmapset_ids']));
        $this->assertSame(false, $data['completed']);

        // specified pack playmode, with match non-convert score mode
        $pack->update(['playmode' => Beatmap::MODES['taiko']]);
        $data = $pack->userCompletionData($user);
        $this->assertSame(1, count($data['beatmapset_ids']));
        $this->assertSame(true, $data['completed']);
    }

    public function testUserCompletionDataEmptyUser()
    {
        $beatmapset = Beatmapset::factory()->create();
        $pack = factory(BeatmapPack::class)->create(['playmode' => null]);
        $pack->items()->create(['beatmapset_id' => $beatmapset->getKey()]);
        $scoreBest = factory(ScoreBest\Taiko::class)->create();
        $scoreBest->beatmap->update(['beatmapset_id' => $beatmapset->getKey()]);
        $user = User::factory()->create();

        $pack->refresh();

        foreach ([$user, null] as $u) {
            $data = $pack->userCompletionData($u);
            $this->assertSame(0, count($data['beatmapset_ids']));
            $this->assertSame(false, $data['completed']);

            $pack->update(['playmode' => Beatmap::MODES['osu']]);
            $data = $pack->userCompletionData($u);
            $this->assertSame(0, count($data['beatmapset_ids']));
            $this->assertSame(false, $data['completed']);

            $pack->update(['playmode' => Beatmap::MODES['taiko']]);
            $data = $pack->userCompletionData($u);
            $this->assertSame(0, count($data['beatmapset_ids']));
            $this->assertSame(false, $data['completed']);
        }
    }

    public function testUserCompletionDataConverts()
    {
        $beatmapset = Beatmapset::factory()->create();
        $pack = factory(BeatmapPack::class)->create(['playmode' => null]);
        $pack->items()->create(['beatmapset_id' => $beatmapset->getKey()]);
        $scoreBest = factory(ScoreBest\Taiko::class)->create();
        $scoreBest->beatmap->update([
            'beatmapset_id' => $beatmapset->getKey(),
            'playmode' => Beatmap::MODES['osu'],
        ]);
        $user = User::find($scoreBest->user_id);

        $pack->refresh();

        // convert scores are ignored when playmode is null
        $data = $pack->userCompletionData($user);
        $this->assertSame(0, count($data['beatmapset_ids']));
        $this->assertSame(false, $data['completed']);

        // convert scores are ok when playmode is specified
        $pack->update(['playmode' => Beatmap::MODES['taiko']]);
        $data = $pack->userCompletionData($user);
        $this->assertSame(1, count($data['beatmapset_ids']));
        $this->assertSame(true, $data['completed']);
    }
}
