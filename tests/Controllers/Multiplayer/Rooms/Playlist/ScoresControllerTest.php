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

    /**
     * @dataProvider dataProviderForTestStore
     */
    public function testStore($allowRanking, $hashParam, $status)
    {
        $user = factory(User::class)->create();
        $playlistItem = factory(PlaylistItem::class)->create();
        $build = Build::factory()->create(['allow_ranking' => $allowRanking]);
        $initialScoresCount = Score::count();

        $this->actAsScopedUser($user, ['*']);

        $params = [];
        if ($hashParam !== null) {
            $params['version_hash'] = $hashParam ? bin2hex($build->hash) : md5('invalid_');
        }

        $this->json('POST', route('api.rooms.playlist.scores.store', [
            'room' => $playlistItem->room_id,
            'playlist' => $playlistItem->getKey(),
        ]), $params)->assertStatus($status);

        $countDiff = ((string) $status)[0] === '2' ? 1 : 0;

        $this->assertSame($initialScoresCount + $countDiff, Score::count());
    }

    /**
     * @dataProvider dataProviderForTestUpdate
     */
    public function testUpdate($bodyParams, $status)
    {
        $user = factory(User::class)->create();
        $playlistItem = factory(PlaylistItem::class)->create();
        $room = $playlistItem->room;
        $build = Build::factory()->create(['allow_ranking' => true]);
        $score = $room->startPlay($user, $playlistItem);

        $this->actAsScopedUser($user, ['*']);

        $url = route('api.rooms.playlist.scores.update', [
            'room' => $room,
            'playlist' => $playlistItem,
            'score' => $score,
        ]);

        $this->json('PUT', $url, $bodyParams)->assertStatus($status);
    }

    public function dataProviderForTestStore()
    {
        return [
            'ok' => [true, true, 200],
            'invalid hash' => [true, false, 422],
            'missing hash' => [true, null, 422],
            'no ranking build' => [false, true, 422],
        ];
    }

    public function dataProviderForTestUpdate()
    {
        static $validBodyParams = [
            'accuracy' => 1,
            'max_combo' => 10,
            'passed' => true,
            'rank' => 'A',
            'statistics' => ['Good' => 1],
            'total_score' => 10,
        ];

        return [
            'ok' => [$validBodyParams, 200],
            'empty params' => [[], 422],
        ];
    }
}
