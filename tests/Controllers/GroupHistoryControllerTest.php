<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Models\User;
use App\Models\UserGroupEvent;
use Tests\TestCase;

class GroupHistoryControllerTest extends TestCase
{
    public function testIndexExcludesHiddenEventsWhenGuest(): void
    {
        $event = UserGroupEvent::factory()->create(['hidden' => true]);

        $response = $this
            ->getJson(route('group-history.index'))
            ->assertOk()
            ->json();

        $responseEventIds = collect($response['events'])->pluck('id');
        $this->assertNotContains($event->getKey(), $responseEventIds);
    }

    public function testIndexExcludesHiddenEventsWhenNotInGroup(): void
    {
        $event = UserGroupEvent::factory()->create(['hidden' => true]);
        $user = User::factory()->create();

        $response = $this
            ->actingAsVerified($user)
            ->getJson(route('group-history.index'))
            ->assertOk()
            ->json();

        $responseEventIds = collect($response['events'])->pluck('id');
        $this->assertNotContains($event->getKey(), $responseEventIds);
    }

    public function testIndexIncludesHiddenEventsWhenInGroup(): void
    {
        $event = UserGroupEvent::factory()->create(['hidden' => true]);
        $user = User::factory()->withGroup($event->group->identifier)->create();

        $response = $this
            ->actingAsVerified($user)
            ->getJson(route('group-history.index'))
            ->assertOk()
            ->json();

        $responseEventIds = collect($response['events'])->pluck('id');
        $this->assertContains($event->getKey(), $responseEventIds);
    }

    public function testIndexListsEvents(): void
    {
        $event = UserGroupEvent::factory()->create();

        $response = $this
            ->getJson(route('group-history.index'))
            ->assertOk()
            ->json();

        $responseEventIds = collect($response['events'])->pluck('id');
        $this->assertContains($event->getKey(), $responseEventIds);
    }
}
