<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

class ScreenshotsControllerTest extends TestCase
{
    public function testScreenshot()
    {
        Storage::fake('local-screenshot');

        $user = User::factory()->create();
        $this->actAsScopedUser($user);

        $this->postJson(route('api.screenshots.store'), [
            'screenshot' => UploadedFile::fake()->image('screenshot.jpg'),
        ])->assertOk()->assertJson(['url' => 'http://localhost/ss/1/9784']); // md5("1"."1234567890abcd")
    }
}
