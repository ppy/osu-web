<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\InterOp;

use App\Models\Country;
use App\Models\User;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    public function testStore()
    {
        $previousCount = User::count();
        $country = Country::factory()->create();
        $url = route('interop.users.store', ['timestamp' => time()]);

        $this
            ->withInterOpHeader($url)
            ->json('POST', $url, [
                'user' => [
                    'country_acronym' => $country->getKey(),
                    'password' => 'password',
                    'user_email' => 'test@user.com',
                    'username' => 'testuser',
                ],
            ])->assertJsonFragment([
                'username' => 'testuser',
            ]);

        $this->assertSame($previousCount + 1, User::count());
    }

    public function testStoreUserCopy()
    {
        $country = Country::factory()->create();
        $sourceUser = User::factory()->create(['country_acronym' => $country->getKey(), 'user_ip' => '127.0.0.1']);
        $url = route('interop.users.store', ['timestamp' => time()]);
        $username = 'userbot';
        $group = 'bot';
        $previousCount = User::count();

        $this
            ->withInterOpHeader($url)
            ->json('POST', $url, [
                'source_user_id' => $sourceUser->getKey(),
                'user' => [
                    'username' => $username,
                    'group' => $group,
                ],
            ])->assertJsonFragment([
                'username' => $username,
            ]);

        $this->assertSame($previousCount + 1, User::count());

        $user = User::where(['username' => $username])->first();

        foreach (['user_password', 'user_ip', 'country_acronym'] as $copiedAttribute) {
            $this->assertSame($sourceUser->$copiedAttribute, $user->$copiedAttribute, $copiedAttribute);
        }

        $this->assertStringContainsString("+${username}@", $user->user_email);
        $this->assertTrue($user->isGroup(app('groups')->byIdentifier($group)));
    }

    public function testStoreUserCopyMissingUsername()
    {
        $country = Country::factory()->create();
        $sourceUser = User::factory()->create(['country_acronym' => $country->getKey(), 'user_ip' => '127.0.0.1']);

        $previousCount = User::count();
        $url = route('interop.users.store', ['timestamp' => time()]);

        $this
            ->withInterOpHeader($url)
            ->json('POST', $url, [
                'source_user_id' => $sourceUser->getKey(),
            ])->assertStatus(422);

        $this->assertSame($previousCount, User::count());
    }
}
