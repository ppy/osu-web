<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\InterOp;

use App\Models\Beatmapset;
use App\Models\Log;
use App\Models\User;
use Tests\TestCase;

class BeatmapsetsControllerTest extends TestCase
{
    public function testDestroy()
    {
        $owner = factory(User::class)->create();
        $beatmapset = factory(Beatmapset::class)->create([
            'approved' => Beatmapset::STATES['pending'],
            'user_id' => $owner->getKey(),
        ]);

        $banchoBotUser = factory(User::class)->create([
            'user_id' => config('osu.legacy.bancho_bot_user_id'),
        ]);

        $url = route('interop.beatmapsets.destroy', [
            'beatmapset' => $beatmapset->getKey(),
            'timestamp' => time(),
        ]);

        $this
            ->withInterOpHeader($url)
            ->delete($url)
            ->assertStatus(204);

        $this->assertSame(Log::orderBy('log_time', 'desc')->first()->user_id, $banchoBotUser->getKey());
    }
}
