<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\InterOp;

use App\Models\Beatmapset;
use App\Models\Event;
use App\Models\Forum\Forum;
use App\Models\Forum\Topic;
use App\Models\Log;
use App\Models\User;
use Tests\TestCase;

class BeatmapsetsControllerTest extends TestCase
{
    public function testDestroy() {
        $owner = factory(User::class)->create();
        $forum = factory(Forum::class, 'parent')->create();
        $topic = factory(Topic::class)->create([
            'forum_id' => $forum->getKey(),
        ]);
        $beatmapset = factory(Beatmapset::class)->create([
            'approved' => Beatmapset::STATES['pending'],
            'thread_id' => $topic->getKey(),
            'user_id' => $owner->getKey(),
        ]);
        $eventBeforeCount = Event::count();
        $logBeforeCount = Log::where('log_operation', 'LOG_BEATMAPSET_DELETE')->count();

        factory(User::class)->create([
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

        $beatmapset->refresh();
        $topic->refresh();

        $this->assertTrue($beatmapset->trashed());
        $this->assertTrue($topic->trashed());
        $this->assertSame($eventBeforeCount, Event::count());
        $this->assertSame($logBeforeCount + 1, Log::where('log_operation', 'LOG_BEATMAPSET_DELETE')->count());
    }
}
