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
