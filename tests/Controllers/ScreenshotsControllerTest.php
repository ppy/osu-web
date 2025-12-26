<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\Screenshot;
use App\Models\User;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

class ScreenshotsControllerTest extends TestCase
{
    private static FilesystemAdapter $storage;

    public static function setUpBeforeClass(): void
    {
        $user = User::factory()->create();

        // create a bunch of legacy/hashless screenshots
        // these are created in setUpBeforeClass so that they have proper
        // IDs lower or equal than config('osu.screenshots.legacy_id_cutoff')
        Screenshot::factory()->count(5)->create(['user_id' => $user->getKey()]);
    }

    public function testStore()
    {
        $user = User::factory()->create();
        $this->actAsScopedUser($user);

        Storage::fake('local-screenshot');

        $this->postJson(route('api.screenshots.store'), [
            'screenshot' => UploadedFile::fake()->image('screenshot.jpg'),
        ])->assertCreated()->assertJson(['url' => 'http://localhost/ss/6/6437']); // md5("6"."1234567890abcd")

        Storage::disk('local-screenshot')->assertExists('6.jpg');
    }

    public function testShow()
    {
        $user = User::factory()->create();
        Screenshot::factory()->create(['screenshot_id' => 123, 'user_id' => $user->getKey()]);

        Storage::fake('local-screenshot');

        Storage::disk('local-screenshot')->putFileAs('/', UploadedFile::fake()->image('screenshot.jpg'), '123.jpg');

        $this->get(route('screenshots.show', [
            'screenshot' => 123,
            'hash' => '9d78', // md5("123"."1234567890abcd")
        ]))->assertOk()->assertHeader('Content-Type', 'image/jpeg');
    }

    /**
     * @depends testShow
     */
    public function testShowInvalidHash()
    {
        $this->get(route('screenshots.show', [
            'screenshot' => 123,
            'hash' => 'asdf',
        ]))->assertNotFound();
    }

    public function testShowLegacy()
    {
        Storage::fake('local-screenshot');

        for ($i = 1; $i <= 5; $i++) {
            Storage::disk('local-screenshot')->putFileAs('/', UploadedFile::fake()->image('screenshot.jpg'), "$i.jpg");
        }

        $this->get(route('screenshots.show-legacy', [
            'screenshot' => 3,
        ]))->assertOk()->assertHeader('Content-Type', 'image/jpeg');
    }

    public function testShowLegacyIdAboveCutoff()
    {
        $this->get(route('screenshots.show-legacy', [
            'screenshot' => 50,
        ]))->assertNotFound();
    }
}
