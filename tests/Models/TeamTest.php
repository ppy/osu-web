<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Models\Chat;
use App\Models\Team;
use App\Models\TeamApplication;
use App\Models\TeamMember;
use App\Models\TeamStatistics;
use App\Models\User;
use Tests\TestCase;

class TeamTest extends TestCase
{
    public static function dataProviderForTestUniquenessValidation(): array
    {
        return [
            ['name'],
            ['short_name'],
        ];
    }

    public function testDelete(): void
    {
        [$team, $otherTeam] = array_map(function () {
            $team = Team::factory()->create();
            $team->addMember($team->applications()->make(['user_id' => User::factory()->create()->getKey()]));
            Chat\Message::factory()->create(['channel_id' => $team->channel, 'user_id' => $team->leader_id]);
            $team->applications()->create(['user_id' => User::factory()->create()->getKey()]);
            $team->statistics()->create(['ruleset_id' => 0]);

            return $team;
        }, [null, null]);

        $this->expectCountChange(fn () => Team::count(), -1);
        $this->expectCountChange(fn () => TeamMember::count(), -2);
        $this->expectCountChange(fn () => Chat\UserChannel::count(), -2);
        $this->expectCountChange(fn () => TeamApplication::count(), -1);
        $this->expectCountChange(fn () => TeamStatistics::count(), -1);
        // Members are booted from the channel but the channel and message themselves are preserved.
        $this->expectCountChange(fn () => Chat\Channel::count(), 0);
        $this->expectCountChange(fn () => Chat\Message::count(), 0);

        $this->expectCountChange(fn () => $otherTeam->members()->count(), 0);
        $this->expectCountChange(fn () => $otherTeam->channel->userChannels()->count(), 0);
        $this->expectCountChange(fn () => $otherTeam->applications()->count(), 0);
        $this->expectCountChange(fn () => $otherTeam->statistics()->count(), 0);

        $team->fresh()->delete();

        $this->assertNotNull($otherTeam->fresh());
        $this->assertSame("#DeletedTeam_{$team->getKey()}", $team->channel->fresh()->name);
    }

    public function testDeleteNoChannelMessage(): void
    {
        $team = Team::factory()->create();

        $this->expectCountChange(fn () => Chat\UserChannel::count(), -1);
        $this->expectCountChange(fn () => Chat\Channel::count(), -1);

        $team->fresh()->delete();
    }

    /**
     * @dataProvider dataProviderForTestUniquenessValidation
     */
    public function testUniquenessValidation(string $field): void
    {
        $existingTeam = Team::factory()->create();

        $this->expectCountChange(fn () => Team::count(), 0);

        $team = Team::factory()->make([$field => $existingTeam->$field]);
        $team->save();
        $this->assertFalse($team->validationErrors()->isEmpty());
    }
}
