<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Models\User;
use Tests\TestCase;

class FriendsControllerTest extends TestCase
{
    public function testStore(): void
    {
        $user = User::factory()->create();
        $target = User::factory()->create();

        $this->expectCountChange(fn () => $user->friends()->count(), 1);

        $this
            ->actingAsVerified($user)
            ->post(route('friends.store'), [
                'target' => $target->getKey(),
            ])->assertSuccessful();
    }

    public function testStoreAlreadyFriend(): void
    {
        $user = User::factory()->create();
        $target = User::factory()->create();
        $user->relations()->create([
            'foe' => false,
            'friend' => true,
            'zebra_id' => $target->getKey(),
        ]);

        $this->expectCountChange(fn () => $user->friends()->count(), 0);

        $this
            ->actingAsVerified($user)
            ->post(route('friends.store'), [
                'target' => $target->getKey(),
            ])->assertSuccessful();
    }

    public function testStoreBlocked(): void
    {
        $user = User::factory()->create();
        $target = User::factory()->create();
        $user->relations()->create([
            'foe' => true,
            'friend' => false,
            'zebra_id' => $target->getKey(),
        ]);

        $this->expectCountChange(fn () => $user->friends()->count(), 1);
        $this->expectCountChange(fn () => $user->blocks()->count(), -1);

        $this
            ->actingAsVerified($user)
            ->post(route('friends.store'), [
                'target' => $target->getKey(),
            ])->assertSuccessful();
    }

    public function testStoreNonExistentTarget(): void
    {
        $user = User::factory()->create();
        $targetId = User::max('user_id') + 1;

        $this->expectCountChange(fn () => $user->friends()->count(), 0);

        $this
            ->actingAsVerified($user)
            ->post(route('friends.store'), [
                'target' => $targetId,
            ])->assertStatus(404);
    }
}
