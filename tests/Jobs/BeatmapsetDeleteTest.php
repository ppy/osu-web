<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Jobs;

use App\Jobs\BeatmapsetDelete;
use App\Models\Beatmapset;
use App\Models\Event;
use App\Models\Forum\Topic;
use App\Models\Log;
use App\Models\User;
use Tests\TestCase;

class BeatmapsetDeleteTest extends TestCase
{
    public function testBeatmapsetDeletedByOwner(): void
    {
        $owner = User::factory()->create();
        $topic = Topic::factory()->create();
        $beatmapset = Beatmapset::factory()->create([
            'thread_id' => $topic,
            'user_id' => $owner,
            'approved' => Beatmapset::STATES['pending'],
        ]);

        $this->expectCountChange(fn () => Event::count(), 1);
        $this->expectCountChange(
            fn () => Log::where('log_operation', 'LOG_BEATMAPSET_DELETE')->count(),
            0,
        );

        (new BeatmapsetDelete($beatmapset, $owner))->handle();

        $beatmapset->refresh();
        $topic->refresh();

        $this->assertTrue($beatmapset->trashed());
        $this->assertTrue($topic->trashed());
    }

    public function testBeatmapsetDeletedByAnotherUser(): void
    {
        $moderator = User::factory()->create();
        $owner = User::factory()->create();
        $topic = Topic::factory()->create();
        $beatmapset = Beatmapset::factory()->create([
            'thread_id' => $topic,
            'user_id' => $owner,
            'approved' => Beatmapset::STATES['pending'],
        ]);

        $this->expectCountChange(fn () => Event::count(), 0);
        $this->expectCountChange(
            fn () => Log::where('log_operation', 'LOG_BEATMAPSET_DELETE')->count(),
            1,
        );

        (new BeatmapsetDelete($beatmapset, $moderator))->handle();

        $beatmapset->refresh();
        $topic->refresh();

        $this->assertTrue($beatmapset->trashed());
        $this->assertTrue($topic->trashed());
    }
}
