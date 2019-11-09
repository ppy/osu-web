<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace Tests\Jobs;

use App\Jobs\BeatmapsetDelete;
use App\Models\Beatmapset;
use App\Models\Event;
use App\Models\Log;
use App\Models\User;
use Tests\TestCase;

class BeatmapsetDeleteTest extends TestCase
{
    public function testBeatmapsetDeletedByOwner()
    {
        $owner = factory(User::class)->create();
        $beatmapset = factory(Beatmapset::class)->create([
            'user_id' => $owner->user_id,
            'approved' => Beatmapset::STATES['pending'],
        ]);
        $eventBeforeCount = Event::count();
        $logBeforeCount = Log::where('log_operation', 'LOG_BEATMAPSET_DELETE')->count();

        (new BeatmapsetDelete($beatmapset, $owner))->handle();

        $beatmapset->refresh();

        $this->assertTrue($beatmapset->trashed());
        $this->assertSame($eventBeforeCount + 1, Event::count());
        $this->assertSame($logBeforeCount, Log::where('log_operation', 'LOG_BEATMAPSET_DELETE')->count());
    }

    public function testBeatmapsetDeletedByAnotherUser()
    {
        $moderator = factory(User::class)->create();
        $owner = factory(User::class)->create();
        $beatmapset = factory(Beatmapset::class)->create([
            'user_id' => $owner->user_id,
            'approved' => Beatmapset::STATES['pending'],
        ]);
        $eventBeforeCount = Event::count();
        $logBeforeCount = Log::where('log_operation', 'LOG_BEATMAPSET_DELETE')->count();

        (new BeatmapsetDelete($beatmapset, $moderator))->handle();

        $beatmapset->refresh();

        $this->assertTrue($beatmapset->trashed());
        $this->assertSame($eventBeforeCount, Event::count());
        $this->assertSame($logBeforeCount + 1, Log::where('log_operation', 'LOG_BEATMAPSET_DELETE')->count());
    }
}
