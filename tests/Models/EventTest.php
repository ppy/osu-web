<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Models\Achievement;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Event;
use App\Models\User;
use App\Models\UsernameChangeHistory;
use Tests\TestCase;

class EventTest extends TestCase
{
    public function testAchievementEventEscaping()
    {
        $achievement = Achievement::factory()->create([
            'name' => 'Test & Stuff',
        ]);
        $user = User::factory()->create([
            'user_id' => 222,
            'username' => 'john123',
        ]);

        $event = Event::generate('achievement', ['achievement' => $achievement, 'user' => $user]);

        $this->assertSame('<b><a href=\'/users/222\'>john123</a></b> unlocked the "<b>Test & Stuff</b>" medal!', $event->text);

        $this->assertArrayNotHasKey('parse_error', $event->parse()->details);
        $this->assertSame('achievement', $event->type);
    }

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

        $this->assertArrayNotHasKey('parse_error', $event->parse()->details);
        $this->assertSame('beatmapsetApprove', $event->type);
    }


    public function testBeatmapsetDeleteEventEscaping()
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

        $event = Event::generate('beatmapsetDelete', ['beatmapset' => $beatmapset, 'user' => $user]);

        $this->assertSame('<a href=\'/beatmapsets/333\'>artist &amp; artist - &lt; title &gt;</a> has been deleted.', $event->text);

        $this->assertArrayNotHasKey('parse_error', $event->parse()->details);
        $this->assertSame('beatmapsetDelete', $event->type);
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

        $this->assertArrayNotHasKey('parse_error', $event->parse()->details);
        $this->assertSame('beatmapsetRevive', $event->type);
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

        $this->assertArrayNotHasKey('parse_error', $event->parse()->details);
        $this->assertSame('beatmapsetUpdate', $event->type);
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

        $this->assertArrayNotHasKey('parse_error', $event->parse()->details);
        $this->assertSame('beatmapsetUpload', $event->type);
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

        $this->assertArrayNotHasKey('parse_error', $event->parse()->details);
        $this->assertSame('rank', $event->type);
    }

    public function testRankLostEscaping()
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

        $event = Event::generate('rankLost', [
            'beatmap' => $beatmap,
            'ruleset' => 'fruits',
            'user' => $user,
            'legacy_score_event' => null,
        ]);

        $this->assertSame('<b><a href=\'/users/222\'>john123</a></b> has lost first place on <a href=\'/beatmaps/444?ruleset=fruits\'>artist &amp; artist - &lt; title &gt; [a &amp; b&#039;s Normal]</a> (osu!catch)', $event->text);
        $this->assertSame('[http://localhost/users/222 john123] has lost first place on [http://localhost/beatmaps/444?ruleset=fruits artist & artist - < title > [a & b\'s Normal]] (osu!catch)', $event->text_clean);

        $this->assertArrayNotHasKey('parse_error', $event->parse()->details);
        $this->assertSame('rankLost', $event->type);
    }

    public function testUsernameChangeEventEscaping()
    {
        $user = User::factory()->create([
            'user_id' => 222,
            'username' => 'john123',
        ]);
        $usernameChange = UsernameChangeHistory::factory()->create([
            'user_id' => $user->getKey(),
            'username_last' => 'john122',
            'username' => 'john123',
        ]);

        $event = Event::generate('usernameChange', ['user' => $user, 'history' => $usernameChange]);

        $this->assertSame('<b><a href=\'/users/222\'>john122</a></b> has changed their username to john123!', $event->text);

        $this->assertArrayNotHasKey('parse_error', $event->parse()->details);
        $this->assertSame('usernameChange', $event->type);
    }

    public function testUserSupportGiftEventEscaping()
    {
        $user = User::factory()->create([
            'user_id' => 222,
            'username' => 'john123',
        ]);

        $event = Event::generate('userSupportGift', ['user' => $user, 'date' => now()]);

        $this->assertSame('<b><a href=\'/users/222\'>john123</a></b> has received the gift of osu! supporter!', $event->text);

        $this->assertArrayNotHasKey('parse_error', $event->parse()->details);
        $this->assertSame('userSupportGift', $event->type);
    }

    public function testUserSupportFirstEventEscaping()
    {
        $user = User::factory()->create([
            'user_id' => 222,
            'username' => 'john123',
        ]);

        $event = Event::generate('userSupportFirst', ['user' => $user, 'date' => now()]);

        $this->assertSame('<b><a href=\'/users/222\'>john123</a></b> has become an osu! supporter - thanks for your generosity!', $event->text);

        $this->assertArrayNotHasKey('parse_error', $event->parse()->details);
        $this->assertSame('userSupportFirst', $event->type);
    }

    public function testUserSupportAgainEventEscaping()
    {
        $user = User::factory()->create([
            'user_id' => 222,
            'username' => 'john123',
        ]);

        $event = Event::generate('userSupportAgain', ['user' => $user, 'date' => now()]);

        $this->assertSame('<b><a href=\'/users/222\'>john123</a></b> has once again chosen to support osu! - thanks for your generosity!', $event->text);

        $this->assertArrayNotHasKey('parse_error', $event->parse()->details);
        $this->assertSame('userSupportAgain', $event->type);
    }
}
