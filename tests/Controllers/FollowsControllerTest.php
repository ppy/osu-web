<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Libraries\MorphMap;
use App\Models\Follow;
use App\Models\User;
use Tests\TestCase;

class FollowsControllerTest extends TestCase
{
    public function testDestroy()
    {
        $user = User::factory()->create();
        $mapper = User::factory()->create();

        Follow::create([
            'notifiable_id' => $mapper->getKey(),
            'notifiable_type' => MorphMap::getType($mapper),
            'subtype' => 'mapping',
            'user_id' => $user->getKey(),
        ]);

        $initialCount = Follow::count();

        $this
            ->actingAsVerified($user)
            ->json('DELETE', route('follows.destroy'), [
                'follow' => [
                    'notifiable_type' => MorphMap::getType($mapper),
                    'notifiable_id' => $mapper->getKey(),
                    'subtype' => 'mapping',
                ],
            ])->assertSuccessful();

        $this->assertSame(Follow::count(), $initialCount - 1);
    }

    public function testDestroyNonexistent()
    {
        $user = User::factory()->create();
        $mapper = User::factory()->create();

        $initialCount = Follow::count();

        $this
            ->actingAsVerified($user)
            ->json('DELETE', route('follows.destroy'), [
                'follow' => [
                    'notifiable_type' => MorphMap::getType($mapper),
                    'notifiable_id' => $mapper->getKey(),
                    'subtype' => 'mapping',
                ],
            ])->assertSuccessful();

        $this->assertSame(Follow::count(), $initialCount);
    }

    public function testStore()
    {
        $user = User::factory()->create();
        $mapper = User::factory()->create();

        $initialCount = Follow::count();

        $this
            ->actingAsVerified($user)
            ->json('POST', route('follows.store'), [
                'follow' => [
                    'notifiable_type' => MorphMap::getType($mapper),
                    'notifiable_id' => $mapper->getKey(),
                    'subtype' => 'mapping',
                ],
            ])->assertSuccessful();

        $this->assertSame(Follow::count(), $initialCount + 1);
    }

    public function testStoreDuplicate()
    {
        $user = User::factory()->create();
        $mapper = User::factory()->create();

        Follow::create([
            'notifiable_id' => $mapper->getKey(),
            'notifiable_type' => MorphMap::getType($mapper),
            'subtype' => 'mapping',
            'user_id' => $user->getKey(),
        ]);

        $initialCount = Follow::count();

        $this
            ->actingAsVerified($user)
            ->json('POST', route('follows.store'), [
                'follow' => [
                    'notifiable_type' => MorphMap::getType($mapper),
                    'notifiable_id' => $mapper->getKey(),
                    'subtype' => 'mapping',
                ],
            ])->assertSuccessful();

        $this->assertSame(Follow::count(), $initialCount);
    }
}
