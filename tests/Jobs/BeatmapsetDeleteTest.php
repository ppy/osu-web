<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Jobs;

use App\Jobs\BeatmapsetDelete;
use App\Models\Beatmapset;
use App\Models\Event;
use App\Models\Forum\Forum;
use App\Models\Forum\Topic;
use App\Models\Log;
use App\Models\User;
use Tests\TestCase;

class BeatmapsetDeleteTest extends TestCase
{
    public function testBeatmapsetDeletedByOwner()
    {
        $owner = User::factory()->create();
        $forum = factory(Forum::class)->states('parent')->create();
        $topic = factory(Topic::class)->create([
            'forum_id' => $forum->getKey(),
        ]);
        $beatmapset = Beatmapset::factory()->create([
            'thread_id' => $topic,
            'user_id' => $owner,
            'approved' => Beatmapset::STATES['pending'],
        ]);
        $eventBeforeCount = Event::count();
        $logBeforeCount = Log::where('log_operation', 'LOG_BEATMAPSET_DELETE')->count();

        (new BeatmapsetDelete($beatmapset, $owner))->handle();

        $beatmapset->refresh();
        $topic->refresh();

        $this->assertTrue($beatmapset->trashed());
        $this->assertTrue($topic->trashed());
        $this->assertSame($eventBeforeCount + 1, Event::count());
        $this->assertSame($logBeforeCount, Log::where('log_operation', 'LOG_BEATMAPSET_DELETE')->count());
    }

    public function testBeatmapsetDeletedByAnotherUser()
    {
        $moderator = User::factory()->create();
        $owner = User::factory()->create();
        $forum = factory(Forum::class)->states('parent')->create();
        $topic = factory(Topic::class)->create([
            'forum_id' => $forum->getKey(),
        ]);
        $beatmapset = Beatmapset::factory()->create([
            'thread_id' => $topic,
            'user_id' => $owner,
            'approved' => Beatmapset::STATES['pending'],
        ]);
        $eventBeforeCount = Event::count();
        $logBeforeCount = Log::where('log_operation', 'LOG_BEATMAPSET_DELETE')->count();

        (new BeatmapsetDelete($beatmapset, $moderator))->handle();

        $beatmapset->refresh();
        $topic->refresh();

        $this->assertTrue($beatmapset->trashed());
        $this->assertTrue($topic->trashed());
        $this->assertSame($eventBeforeCount, Event::count());
        $this->assertSame($logBeforeCount + 1, Log::where('log_operation', 'LOG_BEATMAPSET_DELETE')->count());
    }
}
