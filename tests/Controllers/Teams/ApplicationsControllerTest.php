<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers\Teams;

use App\Jobs\Notifications\TeamApplicationAccept;
use App\Jobs\Notifications\TeamApplicationReject;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use Tests\TestCase;

class ApplicationsControllerTest extends TestCase
{
    public function testAccept()
    {
        \Queue::fake();
        $team = Team::factory()->create();
        $leader = $team->leader;
        $application = $team->applications()->create(['user_id' => User::factory()->create()->getKey()]);

        $this->expectCountChange(fn () => $team->applications()->count(), -1);
        $this->expectCountChange(fn () => $team->members()->count(), 1);
        $this
            ->actingAsVerified($leader)
            ->post(route('teams.applications.accept', ['team' => $team->getKey(), 'application' => $application->getKey()]))
            ->assertStatus(204);

        \Queue::assertPushed(TeamApplicationAccept::class);
    }

    public function testAcceptFull()
    {
        $team = Team::factory()->create();
        $leader = $team->leader;
        TeamMember::factory()->count($team->emptySlots())->create(['team_id' => $team]);
        $application = $team->applications()->create(['user_id' => User::factory()->create()->getKey()]);

        $this->expectCountChange(fn () => $team->applications()->count(), 0);
        $this->expectCountChange(fn () => $team->members()->count(), 0);
        $this
            ->actingAsVerified($leader)
            ->post(route('teams.applications.accept', ['team' => $team->getKey(), 'application' => $application->getKey()]))
            ->assertStatus(403);
    }

    public function testReject()
    {
        \Queue::fake();
        $team = Team::factory()->create();
        $leader = $team->leader;
        $application = $team->applications()->create(['user_id' => User::factory()->create()->getKey()]);

        $this->expectCountChange(fn () => $team->applications()->count(), -1);
        $this->expectCountChange(fn () => $team->members()->count(), 0);
        $this
            ->actingAsVerified($leader)
            ->post(route('teams.applications.reject', ['team' => $team->getKey(), 'application' => $application->getKey()]))
            ->assertStatus(204);

        \Queue::assertPushed(TeamApplicationReject::class);
    }

    public function testStore()
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();

        $this->expectCountChange(fn () => $team->applications()->count(), 1);

        $this
            ->actingAsVerified($user)
            ->post(route('teams.applications.store', ['team' => $team->getKey()]))
            ->assertStatus(204);
    }

    public function testStoreAlreadyApplying()
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();
        $team->applications()->create(['user_id' => $user->getKey()]);
        $otherTeam = Team::factory()->create();

        $this->expectCountChange(fn () => $otherTeam->applications()->count(), 0);

        $this
            ->actingAsVerified($user)
            ->post(route('teams.applications.store', ['team' => $otherTeam->getKey()]))
            ->assertStatus(403);
    }

    public function testStoreAlreadyTeamMember()
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();
        $team->members()->create([
            'user_id' => $user->getKey(),
        ]);

        $this->expectCountChange(fn () => $team->applications()->count(), 0);

        $this
            ->actingAsVerified($user)
            ->post(route('teams.applications.store', ['team' => $team->getKey()]))
            ->assertStatus(403);
    }

    public function testStoreAlreadyOtherTeamMember()
    {
        $user = User::factory()->create();
        $otherTeam = Team::factory()->create();
        $otherTeam->members()->create([
            'user_id' => $user->getKey(),
        ]);
        $team = Team::factory()->create();

        $this->expectCountChange(fn () => $team->applications()->count(), 0);
        $this->expectCountChange(fn () => $otherTeam->applications()->count(), 0);

        $this
            ->actingAsVerified($user)
            ->post(route('teams.applications.store', ['team' => $team->getKey()]))
            ->assertStatus(403);
    }
}
