<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\User;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function testBbcodePreview()
    {
        $text = 'test';

        $this
            ->post(route('bbcode-preview'), ['text' => 'test'])
            ->assertStatus(200);
    }

    public function testDownloadQuotaCheckApi()
    {
        $user = User::factory()->create();

        $this->actAsScopedUser($user);
        $this
            ->get(route('api.download-quota-check'))
            ->assertSuccessful()
            ->assertJson(['quota_used' => 0]);
    }

    public function testRoot()
    {
        $this
            ->get(route('home'))
            ->assertStatus(200);
    }
}
