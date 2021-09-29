<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Multiplayer\Rooms\Playlist;

use App\Models\Build;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Score;
use App\Models\User;
use Tests\TestCase;

class ScoresControllerTest extends TestCase
{
    public function testShow()
    {
        $score = factory(Score::class)->create();
        $user = factory(User::class)->create();

        $this->actAsScopedUser($user, ['*']);

        $this->json('GET', route('api.rooms.playlist.scores.show', [
            'room' => $score->room_id,
            'playlist' => $score->playlist_item_id,
            'score' => $score->getKey(),
        ]))->assertSuccessful();
    }

    public function testStore()
    {
        $user = factory(User::class)->create();
        $playlistItem = factory(PlaylistItem::class)->create();
        $build = factory(Build::class)->create(['allow_ranking' => true]);
        $initialScoresCount = Score::count();

        $this->actAsScopedUser($user, ['*']);

        $this->json('POST', route('api.rooms.playlist.scores.store', [
            'room' => $playlistItem->room_id,
            'playlist' => $playlistItem->getKey(),
        ]), [
            'version_hash' => bin2hex($build->hash),
        ])->assertSuccessful();

        $this->assertSame($initialScoresCount + 1, Score::count());
    }

    public function testStoreInvalidHash()
    {
        $user = factory(User::class)->create();
        $playlistItem = factory(PlaylistItem::class)->create();
        $initialScoresCount = Score::count();

        $this->actAsScopedUser($user, ['*']);

        $this->json('POST', route('api.rooms.playlist.scores.store', [
            'room' => $playlistItem->room_id,
            'playlist' => $playlistItem->getKey(),
        ]), [
            'version_hash' => md5('invalid'),
        ])->assertStatus(422);

        $this->assertSame($initialScoresCount, Score::count());
    }

    public function testStoreMissingHash()
    {
        $user = factory(User::class)->create();
        $playlistItem = factory(PlaylistItem::class)->create();
        $initialScoresCount = Score::count();

        $this->actAsScopedUser($user, ['*']);

        $this->json('POST', route('api.rooms.playlist.scores.store', [
            'room' => $playlistItem->room_id,
            'playlist' => $playlistItem->getKey(),
        ]))->assertStatus(422);

        $this->assertSame($initialScoresCount, Score::count());
    }

    public function testStoreNoRankingBuild()
    {
        $user = factory(User::class)->create();
        $playlistItem = factory(PlaylistItem::class)->create();
        $build = factory(Build::class)->create(['allow_ranking' => false]);
        $initialScoresCount = Score::count();

        $this->actAsScopedUser($user, ['*']);

        $this->json('POST', route('api.rooms.playlist.scores.store', [
            'room' => $playlistItem->room_id,
            'playlist' => $playlistItem->getKey(),
        ]), [
            'version_hash' => bin2hex($build->hash),
        ])->assertStatus(422);

        $this->assertSame($initialScoresCount, Score::count());
    }
}
