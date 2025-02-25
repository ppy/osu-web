<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Models\Chat;
use App\Models\Team;
use App\Models\TeamApplication;
use App\Models\TeamMember;
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
        $team = Team::factory()->create();
        $team->members()->create(['user_id' => User::factory()->create()->getKey()]);
        Chat\Message::factory()->create(['channel_id' => $team->channel, 'user_id' => $team->leader_id]);
        $team->applications()->create(['user_id' => User::factory()->create()->getKey()]);

        $otherTeam = Team::factory()->create();
        $otherTeam->members()->create(['user_id' => User::factory()->create()->getKey()]);
        Chat\Message::factory()->create(['channel_id' => $otherTeam->channel]);

        $this->expectCountChange(fn () => Team::count(), -1);
        $this->expectCountChange(fn () => TeamApplication::count(), -1);
        $this->expectCountChange(fn () => TeamMember::count(), -2);
        $this->expectCountChange(fn () => $otherTeam->members()->count(), 0);

        // Members are booted from the channel but the channel and message themselves are preserved.
        $this->expectCountChange(fn () => $team->channel->userChannels()->count(), -1);
        $this->expectCountChange(fn () => Chat\Channel::count(), 0);
        $this->expectCountChange(fn () => Chat\Message::count(), 0);

        $team->fresh()->delete();

        $this->assertNotNull($otherTeam->fresh());
        $this->assertSame("#DeletedTeam_{$team->getKey()}", $team->channel->fresh()->name);
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
