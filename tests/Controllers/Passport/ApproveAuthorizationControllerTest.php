<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Passport;

use App\Models\User;
use Tests\TestCase;

class ApproveAuthorizationControllerTest extends TestCase
{
    public function testApproveWithInvalidSession(): void
    {
        $user = User::factory()->create();

        $this->actingAsVerified($user)
            ->post(route('oauth.authorizations.authorize'))
            ->assertStatus(422);
    }
}
