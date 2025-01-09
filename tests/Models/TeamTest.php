<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use Tests\TestCase;

class TeamTest extends TestCase
{
    public function testDelete(): void
    {
        $team = Team::factory()->create();
        $team->members()->create(['user_id' => User::factory()->create()->getKey()]);
        $otherTeam = Team::factory()->create();
        $otherTeam->members()->create(['user_id' => User::factory()->create()->getKey()]);

        $this->expectCountChange(fn () => Team::count(), -1);
        $this->expectCountChange(fn () => TeamMember::count(), -2);
        $this->expectCountChange(fn () => $otherTeam->members()->count(), 0);

        $team->fresh()->delete();

        $this->assertNotNull($otherTeam->fresh());
    }
}
