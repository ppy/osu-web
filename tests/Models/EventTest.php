<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Event;
use App\Models\User;
use Tests\TestCase;

class EventTest extends TestCase
{
    public function testBeatmapsetApproveEventEscaping()
    {
        $user = User::factory()->create([
            'user_id' => 222,
            'username' => 'john123',
        ]);
        $beatmapset = BeatmapSet::factory()->create([
            'beatmapset_id' => 333,
            'user_id' => $user->getKey(),
            'artist' => 'artist & artist',
            'title' => '< title >',
            'approved' => 1,
        ]);

        $event = Event::generate('beatmapsetApprove', ['beatmapset' => $beatmapset]);

        $this->assertSame('<a href=\'/beatmapsets/333\'>artist &amp; artist - &lt; title &gt;</a> by <b><a href=\'/users/222\'>john123</a></b> has just been ranked!', $event->text);
        $this->assertSame('[http://localhost/beatmapsets/333 artist & artist - < title >] by [http://localhost/users/222 john123] has just been ranked!', $event->text_clean);
    }

    public function testBeatmapsetReviveEventEscaping()
    {
        $user = User::factory()->create([
            'user_id' => 222,
            'username' => 'john123',
        ]);
        $beatmapset = BeatmapSet::factory()->create([
            'beatmapset_id' => 333,
            'user_id' => $user->getKey(),
            'artist' => 'artist & artist',
            'title' => '< title >',
            'approved' => 1,
        ]);

        $event = Event::generate('beatmapsetRevive', ['beatmapset' => $beatmapset]);

        $this->assertSame('<a href=\'/beatmapsets/333\'>artist &amp; artist - &lt; title &gt;</a> has been revived from eternal slumber by <b><a href=\'/users/222\'>john123</a></b>.', $event->text);
        $this->assertSame('[http://localhost/beatmapsets/333 artist & artist - < title >] has been revived from eternal slumber by [http://localhost/users/222 john123].', $event->text_clean);
    }

    public function testBeatmapsetUpdateEventEscaping()
    {
        $user = User::factory()->create([
            'user_id' => 222,
            'username' => 'john123',
        ]);
        $beatmapset = BeatmapSet::factory()->create([
            'beatmapset_id' => 333,
            'user_id' => $user->getKey(),
            'artist' => 'artist & artist',
            'title' => '< title >',
            'approved' => 1,
        ]);

        $event = Event::generate('beatmapsetUpdate', ['beatmapset' => $beatmapset, 'user' => $user]);

        $this->assertSame('<b><a href=\'/users/222\'>john123</a></b> has updated the beatmap "<a href=\'/beatmapsets/333\'>artist &amp; artist - &lt; title &gt;</a>"', $event->text);
        $this->assertSame('[http://localhost/users/222 john123] has updated the beatmap "[http://localhost/beatmapsets/333 artist & artist - < title >]"', $event->text_clean);
    }

    public function testBeatmapsetUploadEventEscaping()
    {
        $user = User::factory()->create([
            'user_id' => 222,
            'username' => 'john123',
        ]);
        $beatmapset = BeatmapSet::factory()->create([
            'beatmapset_id' => 333,
            'user_id' => $user->getKey(),
            'artist' => 'artist & artist',
            'title' => '< title >',
            'approved' => 1,
        ]);

        $event = Event::generate('beatmapsetUpload', ['beatmapset' => $beatmapset]);

        $this->assertSame('<b><a href=\'/users/222\'>john123</a></b> has submitted a new beatmap "<a href=\'/beatmapsets/333\'>artist &amp; artist - &lt; title &gt;</a>"', $event->text);
        $this->assertSame('[http://localhost/users/222 john123] has submitted a new beatmap "[http://localhost/beatmapsets/333 artist & artist - < title >]"', $event->text_clean);
    }

    public function testRankEventEscaping()
    {
        $user = User::factory()->create([
            'user_id' => 222,
            'username' => 'john123',
        ]);
        $beatmapset = BeatmapSet::factory()->create([
            'beatmapset_id' => 333,
            'user_id' => $user->getKey(),
            'artist' => 'artist & artist',
            'title' => '< title >',
            'approved' => 1,
        ]);
        $beatmap = Beatmap::factory()->create([
            'beatmap_id' => 444,
            'beatmapset_id' => $beatmapset->getKey(),
            'version' => 'a & b\'s Normal',
            'playmode' => 0,
        ]);

        $event = Event::generate('rank', [
            'beatmap' => $beatmap,
            'ruleset' => 'fruits',
            'user' => $user,
            'position_after' => 321,
            'rank' => 'SH',
            'legacy_score_event' => null,
        ]);

        $this->assertSame('<img src=\'/images/SH_small.png\'/> <b><a href=\'/users/222\'>john123</a></b> achieved rank #321 on <a href=\'/beatmaps/444?ruleset=fruits\'>artist &amp; artist - &lt; title &gt; [a &amp; b&#039;s Normal]</a> (osu!catch)', $event->text);
        $this->assertSame('[http://localhost/users/222 john123] achieved rank #321 on [http://localhost/beatmaps/444?ruleset=fruits artist & artist - < title > [a & b\'s Normal]] (osu!catch)', $event->text_clean);
    }
}
