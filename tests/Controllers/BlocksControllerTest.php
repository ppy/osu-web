<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Models\User;
use Tests\TestCase;

class BlocksControllerTest extends TestCase
{
    public function testStore(): void
    {
        $user = User::factory()->create();
        $target = User::factory()->create();

        $this->expectCountChange(fn () => $user->blocks()->count(), 1);

        $this
            ->actingAsVerified($user)
            ->post(route('blocks.store'), [
                'target' => $target->getKey(),
            ])->assertSuccessful();
    }

    public function testStoreAlreadyBlocked(): void
    {
        $user = User::factory()->create();
        $target = User::factory()->create();
        $user->relations()->create([
            'foe' => true,
            'friend' => false,
            'zebra_id' => $target->getKey(),
        ]);

        $this->expectCountChange(fn () => $user->blocks()->count(), 0);

        $this
            ->actingAsVerified($user)
            ->post(route('blocks.store'), [
                'target' => $target->getKey(),
            ])->assertSuccessful();
    }

    public function testStoreFriends(): void
    {
        $user = User::factory()->create();
        $target = User::factory()->create();
        $user->relations()->create([
            'foe' => false,
            'friend' => true,
            'zebra_id' => $target->getKey(),
        ]);
        $target->relations()->create([
            'foe' => false,
            'friend' => true,
            'zebra_id' => $user->getKey(),
        ]);

        $this->expectCountChange(fn () => $user->friends()->count(), -1);
        $this->expectCountChange(fn () => $target->friends()->count(), -1);
        $this->expectCountChange(fn () => $user->blocks()->count(), 1);

        $this
            ->actingAsVerified($user)
            ->post(route('blocks.store'), [
                'target' => $target->getKey(),
            ])->assertSuccessful();
    }

    public function testStoreNonExistentTarget(): void
    {
        $user = User::factory()->create();
        $targetId = User::max('user_id') + 1;

        $this->expectCountChange(fn () => $user->blocks()->count(), 0);

        $this
            ->actingAsVerified($user)
            ->post(route('blocks.store'), [
                'target' => $targetId,
            ])->assertStatus(404);
    }
}
