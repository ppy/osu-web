<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Commands;

use App\Models\Multiplayer\DailyChallengeQueueItem;
use App\Models\Multiplayer\Room;
use App\Models\User;
use Tests\TestCase;

class DailyChallengeCreateNextTest extends TestCase
{
    public function testBasicItem()
    {
        $queueItem = DailyChallengeQueueItem::factory()->create();

        $this->artisan('daily-challenge:create-next')->assertOk();

        $room = $queueItem->fresh()->multiplayerRoom()->first();

        $this->assertNotNull($room);

        $this->assertSame(1, $room->playlist()->count());
        $playlistItem = $room->playlist()->first();

        $this->assertSame($queueItem->beatmap_id, $playlistItem->beatmap_id);
        $this->assertSame($queueItem->ruleset_id, $playlistItem->ruleset_id);
        $this->assertEmpty($queueItem->required_mods);
        $this->assertEmpty($queueItem->allowed_mods);
    }

    public function testItemWithRequiredMods()
    {
        $queueItem = DailyChallengeQueueItem::factory()->create([
            'required_mods' => [[
                'acronym' => 'DT',
            ]],
        ]);

        $this->artisan('daily-challenge:create-next')->assertOk();

        $room = $queueItem->fresh()->multiplayerRoom()->first();

        $this->assertNotNull($room);

        $this->assertSame(1, $room->playlist()->count());
        $playlistItem = $room->playlist()->first();

        $this->assertSame($queueItem->beatmap_id, $playlistItem->beatmap_id);
        $this->assertSame($queueItem->ruleset_id, $playlistItem->ruleset_id);
        $this->assertSame($queueItem->required_mods[0]['acronym'], $playlistItem->required_mods[0]->acronym);
        $this->assertEmpty($queueItem->allowed_mods);
    }

    public function testQueueOrderIsRespected()
    {
        $secondItem = DailyChallengeQueueItem::factory()->create(['order' => 2]);
        $firstItem = DailyChallengeQueueItem::factory()->create(['order' => 1]);

        $this->artisan('daily-challenge:create-next')->assertOk();

        $this->assertNotNull($firstItem->fresh()->multiplayerRoom()->first());
        $this->assertNull($secondItem->fresh()->multiplayerRoom()->first());
    }

    public function testPrimaryKeyIsTiebreakerWhenNoSpecifiedOrder()
    {
        $firstItem = DailyChallengeQueueItem::factory()->create();
        $secondItem = DailyChallengeQueueItem::factory()->create();

        $this->artisan('daily-challenge:create-next')->assertOk();

        $this->assertNotNull($firstItem->fresh()->multiplayerRoom()->first());
        $this->assertNull($secondItem->fresh()->multiplayerRoom()->first());
    }

    public function testNothingDoneOnEmptyQueue()
    {
        $this->artisan('daily-challenge:create-next')
            ->expectsOutputToContain('"Daily challenge" queue is empty')
            ->assertFailed();
        $this->assertSame(0, Room::all()->count());
    }

    public function testCommandFailsIfAnotherDailyChallengeRoomOpen()
    {
        $secondItem = DailyChallengeQueueItem::factory()->create(['order' => 2]);
        $firstItem = DailyChallengeQueueItem::factory()->create(['order' => 1]);

        $this->artisan('daily-challenge:create-next')->assertOk();

        $this->assertNotNull($firstItem->fresh()->multiplayerRoom()->first());
        $this->assertNull($secondItem->fresh()->multiplayerRoom()->first());

        $this->assertNotNull(Room::where('category', 'daily_challenge')->first());

        $this->artisan('daily-challenge:create-next')
            ->expectsOutputToContain('Another "daily challenge" room is open')
            ->assertFailed();

        $this->assertNotNull($firstItem->fresh()->multiplayerRoom()->first());
        $this->assertNull($secondItem->fresh()->multiplayerRoom()->first());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $utilityUser = User::factory()->create();
        config_set('osu.legacy.bancho_bot_user_id', $utilityUser->getKey());
    }
}
