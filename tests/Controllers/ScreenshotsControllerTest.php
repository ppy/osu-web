<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\Screenshot;
use App\Models\User;
use Config;
use Illuminate\Http\UploadedFile;
use Illuminate\Testing\Fluent\AssertableJson;
use Storage;
use Tests\TestCase;

class ScreenshotsControllerTest extends TestCase
{
    public function testStore()
    {
        $user = User::factory()->create();
        $this->actAsScopedUser($user);

        Storage::fake('local-screenshot');

        $url = $this->postJson(route('api.screenshots.store'), [
            'screenshot' => UploadedFile::fake()->image('screenshot.jpg'),
        ])->assertCreated()->assertJson(fn (AssertableJson $json) =>
            $json->whereType('url', 'string'))->json('url');

        $matches = [];

        $this->assertGreaterThan(0, preg_match('/https?:\/\/.+\/(\d+)\/(.{4})/', $url, $matches));

        Storage::disk('local-screenshot')->assertExists("{$matches[1]}.jpg");
        $this->assertStringStartsWith($matches[2], md5($matches[1].config('osu.screenshots.shared_secret')));
    }

    public function testShow()
    {
        $user = User::factory()->create();
        $screenshot = Screenshot::factory()->create(['user_id' => $user->getKey()]);
        Storage::fake('local-screenshot')->putFileAs('/', UploadedFile::fake()->image('ss.jpg'), "{$screenshot->getKey()}.jpg");

        $this->get(route('screenshots.show', [
            'screenshot' => $screenshot->getKey(),
            'hash' => substr(md5($screenshot->getKey().config('osu.screenshots.shared_secret')), 0, 4),
        ]))->assertOk()->assertHeader('Content-Type', 'image/jpeg');
    }

    /**
     * @depends testShow
     */
    public function testShowInvalidHash()
    {
        $user = User::factory()->create();
        Screenshot::factory()->create(['screenshot_id' => 727, 'user_id' => $user->getKey()]);

        $this->get(route('screenshots.show', [
            'screenshot' => 727,
            'hash' => 'asdf',
        ]))->assertNotFound();
    }

    public function testShowLegacy()
    {
        Storage::fake('local-screenshot');

        $user = User::factory()->create();
        $screenshot = Screenshot::factory()->create(['user_id' => $user->getKey()]);
        Storage::disk('local-screenshot')->putFileAs('/', UploadedFile::fake()->image('ss.jpg'), "{$screenshot->getKey()}.jpg");

        Config::set('osu.screenshots.legacy_id_cutoff', $screenshot->getKey() + 1);

        $this->get(route('screenshots.show-legacy', [
            'screenshot' => $screenshot->getKey(),
        ]))->assertOk()->assertHeader('Content-Type', 'image/jpeg');
    }

    public function testShowLegacyIdAboveCutoff()
    {
        Config::set('osu.screenshots.legacy_id_cutoff', 727000);

        $this->get(route('screenshots.show-legacy', [
            'screenshot' => 727001,
        ]))->assertNotFound();
    }
}
