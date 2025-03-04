<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers\Teams;

use App\Models\Team;
use App\Models\User;
use Tests\TestCase;

class MembersControllerTest extends TestCase
{
    public function testDestroy()
    {
        $team = Team::factory()->create();
        $userId = User::factory()->create()->getKey();
        $application = $team->applications()->create(['user_id' => $userId]);
        $team->addMember($application);

        $this->expectCountChange(fn () => $team->members()->count(), -1);
        $this
            ->actingAsVerified($team->leader)
            ->delete(route('teams.members.destroy', ['team' => $team->getKey(), 'member' => $userId]))
            ->assertStatus(204);
    }
}
