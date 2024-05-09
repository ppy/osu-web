<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Commands;

use App\Models\Multiplayer\BeatmapOfTheDayQueueItem;
use App\Models\Multiplayer\Room;
use App\Models\User;
use Tests\TestCase;

class BeatmapOfTheDayQueueNextTest extends TestCase
{
    private int $originalUtilityUserId;

    public function testBasicItem()
    {
        $queueItem = BeatmapOfTheDayQueueItem::factory()->create();

        $this->artisan('beatmap-of-the-day:queue-next')->assertOk();

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
        $queueItem = BeatmapOfTheDayQueueItem::factory()->create([
            'required_mods' => [[
                'acronym' => 'DT',
            ]],
        ]);

        $this->artisan('beatmap-of-the-day:queue-next')->assertOk();

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
        $secondItem = BeatmapOfTheDayQueueItem::factory()->create(['order' => 2]);
        $firstItem = BeatmapOfTheDayQueueItem::factory()->create(['order' => 1]);

        $this->artisan('beatmap-of-the-day:queue-next')->assertOk();

        $this->assertNotNull($firstItem->fresh()->multiplayerRoom()->first());
        $this->assertNull($secondItem->fresh()->multiplayerRoom()->first());
    }

    public function testPrimaryKeyIsTiebreakerWhenNoSpecifiedOrder()
    {
        $firstItem = BeatmapOfTheDayQueueItem::factory()->create();
        $secondItem = BeatmapOfTheDayQueueItem::factory()->create();

        $this->artisan('beatmap-of-the-day:queue-next')->assertOk();

        $this->assertNotNull($firstItem->fresh()->multiplayerRoom()->first());
        $this->assertNull($secondItem->fresh()->multiplayerRoom()->first());
    }

    public function testNothingDoneOnEmptyQueue()
    {
        $this->artisan('beatmap-of-the-day:queue-next')
            ->expectsOutputToContain('Beatmap of the day queue is empty')
            ->assertFailed();
        $this->assertSame(0, Room::all()->count());
    }

    public function testConfirmationRequiredIfAnotherRoomOpen()
    {
        $secondItem = BeatmapOfTheDayQueueItem::factory()->create(['order' => 2]);
        $firstItem = BeatmapOfTheDayQueueItem::factory()->create(['order' => 1]);

        $this->artisan('beatmap-of-the-day:queue-next')->assertOk();

        $this->assertNotNull($firstItem->fresh()->multiplayerRoom()->first());
        $this->assertNull($secondItem->fresh()->multiplayerRoom()->first());

        $this->assertNotNull(Room::where('category', 'beatmap_of_the_day')->first());

        $this->artisan('beatmap-of-the-day:queue-next')
            ->expectsOutputToContain("Another 'beatmap of the day' room is open")
            ->assertFailed();

        $this->assertNotNull($firstItem->fresh()->multiplayerRoom()->first());
        $this->assertNull($secondItem->fresh()->multiplayerRoom()->first());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $utilityUser = User::factory()->create();
        $this->originalUtilityUserId = $GLOBALS['cfg']['osu']['legacy']['bancho_bot_user_id'];
        config_set('osu.legacy.bancho_bot_user_id', $utilityUser->getKey());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        config_set('osu.legacy.bancho_bot_user_id', $this->originalUtilityUserId);
    }
}
