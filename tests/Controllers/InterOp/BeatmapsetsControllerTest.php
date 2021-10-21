<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\InterOp;

use App\Libraries\MorphMap;
use App\Models\Beatmapset;
use App\Models\Log;
use App\Models\Notification;
use App\Models\User;
use Tests\TestCase;

class BeatmapsetsControllerTest extends TestCase
{
    public function testBroadcastNew()
    {
        $user = User::factory()->create();
        $beatmapset = Beatmapset::factory()->create(['user_id' => $user]);
        $follower = User::factory()->create();
        $follower->follows()->create([
            'subtype' => 'mapping',
            'notifiable' => $user,
        ]);
        $notificationCount = Notification::count();
        $followerNotificationCount = $follower->userNotifications()->count();

        $url = route('interop.beatmapsets.broadcast-new', ['beatmapset' => $beatmapset, 'timestamp' => time()]);

        $this
            ->withInterOpHeader($url)
            ->post($url)
            ->assertSuccessful();

        $this->assertSame($notificationCount + 1, Notification::count());
        $this->assertSame($followerNotificationCount + 1, $follower->userNotifications()->count());
    }

    public function testBroadcastRevive()
    {
        $user = User::factory()->create();
        $beatmapset = Beatmapset::factory()->create(['user_id' => $user]);
        $follower = User::factory()->create();
        $follower->follows()->create([
            'subtype' => 'mapping',
            'notifiable' => $user,
        ]);
        $notificationCount = Notification::count();
        $followerNotificationCount = $follower->userNotifications()->count();

        $url = route('interop.beatmapsets.broadcast-revive', ['beatmapset' => $beatmapset, 'timestamp' => time()]);

        $this
            ->withInterOpHeader($url)
            ->post($url)
            ->assertSuccessful();

        $this->assertSame($notificationCount + 1, Notification::count());
        $this->assertSame($followerNotificationCount + 1, $follower->userNotifications()->count());
    }

    public function testDestroy()
    {
        $owner = User::factory()->create();
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES['pending'],
            'user_id' => $owner,
        ]);

        $banchoBotUser = User::factory()->create([
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
