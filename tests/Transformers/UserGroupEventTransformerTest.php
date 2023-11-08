<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Transformers;

use App\Models\User;
use App\Models\UserGroupEvent;
use Tests\TestCase;

class UserGroupEventTransformerTest extends TestCase
{
    public function testActorNameNotInRoot(): void
    {
        $eventJson = json_item(UserGroupEvent::factory()->create(), 'UserGroupEvent');

        $this->assertArrayNotHasKey('actor_name', $eventJson);
    }

    public function testActorNotVisibleWhenGuest(): void
    {
        $eventJson = json_item(UserGroupEvent::factory()->create(), 'UserGroupEvent');

        $this->assertArrayNotHasKey('actor', $eventJson);
    }

    public function testActorNotVisibleWhenNotInGroup(): void
    {
        $this->actAsUser(User::factory()->create());

        $eventJson = json_item(UserGroupEvent::factory()->create(), 'UserGroupEvent');

        $this->assertArrayNotHasKey('actor', $eventJson);
    }

    public function testActorVisibleWhenInGroup(): void
    {
        $event = UserGroupEvent::factory()->create();

        $this->actAsUser(User::factory()->withGroup($event->group->identifier)->create());

        $eventJson = json_item($event, 'UserGroupEvent');

        $this->assertArrayHasKey('actor', $eventJson);
    }
}
