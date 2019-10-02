<?php

namespace Tests\Controllers;

use App\Models\Achievement;
use App\Models\User;
use Tests\TestCase;

class LegacyInterOpControllerTest extends TestCase
{
    public function testUserAchievement()
    {
        $user = factory(User::class)->create();
        $achievement = factory(Achievement::class)->create();

        $userAchievements = $user->userAchievements()->count();
        $notifications = $user->userNotifications()->count();

        $url = route('lio.user-achievement', [$user->getKey(), $achievement->getKey(), 1, 'timestamp' => time()]);

        $this
            ->withHeaders([
                'X-LIO-Signature' => $this->signature($url),
            ])->post($url)
            ->assertStatus(200);

        $this->assertSame($userAchievements + 1, $user->userAchievements()->count());
        $this->assertSame($notifications + 1, $user->userNotifications()->count());
    }

    private function signature($url)
    {
        return hash_hmac('sha1', $url, config('osu.legacy.shared_interop_secret'));
    }
}
