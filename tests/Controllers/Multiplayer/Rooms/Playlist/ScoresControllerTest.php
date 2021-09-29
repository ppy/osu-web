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
     * @dataProvider storeDataProvider
     */
    public function testStore($allowRanking, $hashParam, $status)
    {
        $user = factory(User::class)->create();
        $playlistItem = factory(PlaylistItem::class)->create();
        $build = factory(Build::class)->create(['allow_ranking' => $allowRanking]);
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

    public function storeDataProvider()
    {
        return [
            'ok' => [true, true, 200],
            'invalid hash' => [true, false, 422],
            'missing hash' => [true, null, 422],
            'no ranking build' => [false, true, 422],
        ];
    }
}
