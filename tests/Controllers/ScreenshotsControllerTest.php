<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Models\Screenshot;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ScreenshotsControllerTest extends TestCase
{
    public function testStore()
    {
        $user = User::factory()->create();
        $this->actAsScopedUser($user);

        \Storage::fake('local-screenshot');

        $url = $this->postJson(route('api.screenshots.store'), [
            'screenshot' => UploadedFile::fake()->image('screenshot.jpg'),
        ])->assertOk()->assertJson(fn (AssertableJson $json) =>
            $json->whereType('url', 'string'))->json('url');

        $matches = [];

        $this->assertGreaterThan(0, preg_match('#(\d+)/(.{4})$#', $url, $matches));

        $this->get(route('screenshots.show', [
            'screenshot' => $matches[1],
            'hash' => $matches[2],
        ]))->assertOk();
    }

    public function testShow()
    {
        $user = User::factory()->create();
        $screenshot = Screenshot::factory()->create(['user_id' => $user->getKey()]);
        $screenshot->store(UploadedFile::fake()->image('ss.jpg'));

        $this->expectCountChange(fn () => $screenshot->fresh()->hits, 1);

        $this->get($screenshot->url())
            ->assertOk()
            ->assertHeader('Content-Type', 'image/jpeg');

        $this->assertEqualsUpToOneSecond(Carbon::now(), $screenshot->fresh()->last_access);
    }

    /**
     * @depends testShow
     */
    public function testShowInvalidHash()
    {
        $oldDate = Carbon::now()->subDays(7);

        $user = User::factory()->create();
        $screenshot = Screenshot::factory()->create([
            'screenshot_id' => 727,
            'user_id' => $user->getKey(),
            'last_access' => $oldDate,
        ]);

        $this->expectCountChange(fn () => $screenshot->fresh()->hits, 0);
        $this->get(route('screenshots.show', [
            'screenshot' => $screenshot->getKey(),
            'hash' => 'asdf',
        ]))->assertNotFound();
        $this->assertEqualsUpToOneSecond($oldDate, $screenshot->fresh()->last_access);
    }

    public function testShowLegacy()
    {
        \Storage::fake('local-screenshot');

        $user = User::factory()->create();
        $screenshot = Screenshot::factory()->create(['user_id' => $user->getKey()]);
        $screenshot->store(UploadedFile::fake()->image('ss.jpg'));

        config_set('osu.screenshots.legacy_id_cutoff', $screenshot->getKey() + 1);

        $this->expectCountChange(fn () => $screenshot->fresh()->hits, 1);

        $this->get($screenshot->url())
            ->assertOk()
            ->assertHeader('Content-Type', 'image/jpeg');

        $this->assertEqualsUpToOneSecond(Carbon::now(), $screenshot->fresh()->last_access);
    }

    public function testShowLegacyIdAboveCutoff()
    {
        config_set('osu.screenshots.legacy_id_cutoff', 727000);

        $this->get(route('screenshots.show', [
            'screenshot' => 727001,
        ]))->assertNotFound();
    }
}
