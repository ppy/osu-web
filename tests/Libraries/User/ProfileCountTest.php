<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\User;

use App\Models\BeatmapDiscussion;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\User;
use Tests\TestCase;

class ProfileCountTest extends TestCase
{
    public function testBeatmapsModdedCount(): void
    {
        $user = User::factory()->create();
        $host = User::factory()->create();

        $beatmapset = Beatmapset::factory()->owner($host)->pending()->create();
        BeatmapDiscussion::factory()->general()->messageType('suggestion')->create([
            'beatmapset_id' => $beatmapset,
            'user_id' => $user,
        ]);
        BeatmapDiscussion::factory()->general()->problem()->create([
            'beatmapset_id' => $beatmapset,
            'user_id' => $user,
        ]);
        BeatmapDiscussion::factory()->review()->create([
            'beatmapset_id' => Beatmapset::factory()->owner($host)->pending(),
            'user_id' => $user,
        ]);
        BeatmapDiscussion::factory()->general()->problem()->create([
            'beatmapset_id' => Beatmapset::factory()->owner($user)->pending(),
            'user_id' => $user,
        ]);

        $this->assertSame(2, $user->profileCount()->get('beatmapsModded'));
    }

    public function testBeatmapsetStatusCounts(): void
    {
        $user = User::factory()->create();

        Beatmapset::factory()->owner($user)->ranked()->create();
        Beatmapset::factory()->owner($user)->state(['approved' => Beatmapset::STATES['approved']])->create();
        Beatmapset::factory()->owner($user)->qualified()->create();
        Beatmapset::factory()->owner($user)->pending()->create();
        Beatmapset::factory()->owner($user)->state(['approved' => Beatmapset::STATES['wip']])->create();
        Beatmapset::factory()->owner($user)->state(['approved' => Beatmapset::STATES['graveyard']])->create();

        $this->assertEquals([
            'graveyard' => 1,
            'wip' => 1,
            'pending' => 1,
            'ranked' => 1,
            'approved' => 1,
            'qualified' => 1,
        ], $user->profileCount()->beatmapsetStatusCounts());

        $this->assertSame(3, $user->profileCount()->get('rankedBeatmapsets'));
        $this->assertSame(2, $user->profileCount()->get('pendingBeatmapsets'));
        $this->assertSame(0, $user->profileCount()->get('lovedBeatmapsets'));
        $this->assertSame([], User::factory()->create()->profileCount()->beatmapsetStatusCounts());
    }

    public function testIssuesResolvedCount(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();

        $discussion = BeatmapDiscussion::factory()->general()->problem()->create();
        $this->logResolve($user, $discussion);
        $this->logResolve($user, $discussion);

        $ownMap = BeatmapDiscussion::factory()->general()->problem()->create([
            'beatmapset_id' => Beatmapset::factory()->owner($user)->pending(),
            'user_id' => $user,
        ]);
        $this->logResolve($user, $ownMap);

        $this->logResolve($other, BeatmapDiscussion::factory()->general()->problem()->create());

        $this->assertSame(2, $user->profileCount()->get('issuesResolved'));
    }

    private function logResolve(User $user, BeatmapDiscussion $discussion): void
    {
        BeatmapsetEvent::log(
            BeatmapsetEvent::ISSUE_RESOLVE,
            $user,
            $discussion->beatmapDiscussionPosts()->first(),
        )->saveOrExplode();
    }
}
