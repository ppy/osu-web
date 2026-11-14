<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\User;

use App\Libraries\User\ModdingActivityHeatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\User;
use Carbon\CarbonImmutable;
use Tests\TestCase;

class ModdingActivityHeatmapTest extends TestCase
{
    public function testEmptyWindow(): void
    {
        $user = User::factory()->create();

        $result = $this->heatmap($user);

        $this->assertSame([], $result['days']);
        $this->assertSame(
            CarbonImmutable::MONDAY,
            CarbonImmutable::parse($result['start_date'], 'UTC')->dayOfWeek,
        );
        $this->assertSame(
            CarbonImmutable::now('UTC')->toDateString(),
            $result['end_date'],
        );
    }

    public function testNominations(): void
    {
        $user = User::factory()->create();
        $host = User::factory()->create();
        $today = CarbonImmutable::now('UTC')->toDateString();

        $beatmapset = Beatmapset::factory()->owner($host)->pending()->create();
        BeatmapsetEvent::log(
            BeatmapsetEvent::NOMINATE,
            $user,
            $beatmapset,
            ['modes' => ['osu', 'taiko']],
        )->saveOrExplode();

        $resetSet = Beatmapset::factory()->owner($host)->pending()->create();
        BeatmapsetEvent::factory()->create([
            'beatmapset_id' => $resetSet,
            'comment' => ['modes' => ['osu']],
            'type' => BeatmapsetEvent::NOMINATE,
            'user_id' => $user,
        ]);
        $resetSet->beatmapsetNominations()->update([
            'reset' => true,
            'reset_at' => CarbonImmutable::now('UTC'),
        ]);

        $day = $this->dayAt($this->heatmap($user), $today);

        $this->assertNotNull($day);
        $this->assertSame(2, $day['nominations']);
        $this->assertSame(0, $day['posts']);
        $this->assertSame(0, $day['ranks']);
    }

    public function testPosts(): void
    {
        $user = User::factory()->create();
        $host = User::factory()->create();
        $today = CarbonImmutable::now('UTC')->toDateString();

        $others = Beatmapset::factory()->owner($host)->pending()->create();
        $discussion = BeatmapDiscussion::factory()->general()->create([
            'beatmapset_id' => $others,
            'user_id' => $user,
        ]);
        BeatmapDiscussionPost::factory()->create([
            'beatmap_discussion_id' => $discussion,
            'user_id' => $user,
        ]);

        BeatmapDiscussion::factory()->general()->create([
            'beatmapset_id' => Beatmapset::factory()->owner($user)->pending(),
            'user_id' => $user,
        ]);

        BeatmapDiscussionPost::factory()->create([
            'beatmap_discussion_id' => $discussion,
            'message' => ['type' => 'resolved', 'value' => true],
            'system' => true,
            'user_id' => $user,
        ]);

        $deleted = BeatmapDiscussionPost::factory()->create([
            'beatmap_discussion_id' => $discussion,
            'user_id' => $user,
        ]);
        $deleted->update(['deleted_at' => CarbonImmutable::now('UTC')]);

        $day = $this->dayAt($this->heatmap($user), $today);

        $this->assertNotNull($day);
        $this->assertSame(2, $day['posts']);
    }

    public function testPostsOutsideWindowAreOmitted(): void
    {
        $user = User::factory()->create();
        $host = User::factory()->create();

        $discussion = BeatmapDiscussion::factory()->general()->create([
            'beatmapset_id' => Beatmapset::factory()->owner($host)->pending(),
            'user_id' => $user,
        ]);
        $discussion->beatmapDiscussionPosts()->first()->update([
            'created_at' => CarbonImmutable::now('UTC')->subMonths(8),
        ]);

        $this->assertSame([], $this->heatmap($user)['days']);
    }

    public function testRanks(): void
    {
        $user = User::factory()->create();
        $host = User::factory()->create();
        $today = CarbonImmutable::now('UTC')->toDateString();

        $owned = Beatmapset::factory()->owner($user)->ranked()->create();
        $owned->events()->create(['type' => BeatmapsetEvent::RANK]);

        $nominated = Beatmapset::factory()->owner($host)->ranked()->create();
        BeatmapsetEvent::log(
            BeatmapsetEvent::NOMINATE,
            $user,
            $nominated,
            ['modes' => ['osu']],
        )->saveOrExplode();
        $nominated->events()->create(['type' => BeatmapsetEvent::RANK]);

        $day = $this->dayAt($this->heatmap($user), $today);

        $this->assertNotNull($day);
        $this->assertSame(1, $day['ranks']);
        $this->assertSame(1, $day['nominations']);
    }

    private function dayAt(array $result, string $date): ?array
    {
        foreach ($result['days'] as $day) {
            if ($day['date'] === $date) {
                return $day;
            }
        }

        return null;
    }

    private function heatmap(User $user): array
    {
        return (new ModdingActivityHeatmap($user))->calculate();
    }
}
