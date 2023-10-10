<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Multiplayer\Rooms\Playlist;

use App\Models\Build;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\ScoreLink;
use App\Models\Multiplayer\UserScoreAggregate;
use App\Models\User;
use Tests\TestCase;

class ScoresControllerTest extends TestCase
{
    public function testIndex()
    {
        $playlist = PlaylistItem::factory()->create();
        $user = User::factory()->create();
        $scoreLinks = [];
        $scoreLinks[] = ScoreLink
            ::factory()
            ->state(['playlist_item_id' => $playlist])
            ->completed([], ['passed' => true, 'total_score' => 30])
            ->create();
        $scoreLinks[] = $userScoreLink = ScoreLink
            ::factory()
            ->state([
                'playlist_item_id' => $playlist,
                'user_id' => $user,
            ])->completed([], ['passed' => true, 'total_score' => 20])
            ->create();
        $scoreLinks[] = ScoreLink
            ::factory()
            ->state(['playlist_item_id' => $playlist])
            ->completed([], ['passed' => true, 'total_score' => 10])
            ->create();

        foreach ($scoreLinks as $scoreLink) {
            UserScoreAggregate::lookupOrDefault($scoreLink->user, $scoreLink->room)->recalculate();
        }

        $this->actAsScopedUser($user, ['*']);

        $resp = $this->json('GET', route('api.rooms.playlist.scores.index', [
            'room' => $playlist->room_id,
            'playlist' => $playlist->getKey(),
        ]))->assertSuccessful();

        $json = json_decode($resp->getContent(), true);
        $this->assertSame(count($scoreLinks), count($json['scores']));
        foreach ($json['scores'] as $i => $jsonScore) {
            $this->assertSame($scoreLinks[$i]->getKey(), $jsonScore['id']);
        }
        $this->assertSame($json['user_score']['id'], $userScoreLink->getKey());
    }

    public function testShow()
    {
        $playlist = PlaylistItem::factory()->create();
        $user = User::factory()->create();
        $scoreLinks = [];
        $scoreLinks[] = ScoreLink
            ::factory()
            ->state(['playlist_item_id' => $playlist])
            ->completed([], ['passed' => true, 'total_score' => 30])
            ->create();
        $scoreLinks[] = $userScoreLink = ScoreLink
            ::factory()
            ->state([
                'playlist_item_id' => $playlist,
                'user_id' => $user,
            ])->completed([], ['passed' => true, 'total_score' => 20])
            ->create();
        $scoreLinks[] = ScoreLink
            ::factory()
            ->state(['playlist_item_id' => $playlist])
            ->completed([], ['passed' => true, 'total_score' => 10])
            ->create();

        foreach ($scoreLinks as $scoreLink) {
            UserScoreAggregate::lookupOrDefault($scoreLink->user, $scoreLink->room)->recalculate();
        }

        $this->actAsScopedUser($user, ['*']);

        $resp = $this->json('GET', route('api.rooms.playlist.scores.show', [
            'room' => $userScoreLink->room_id,
            'playlist' => $userScoreLink->playlist_item_id,
            'score' => $userScoreLink->getKey(),
        ]))->assertSuccessful();

        $json = json_decode($resp->getContent(), true);
        $this->assertSame($json['id'], $userScoreLink->getKey());
        $this->assertSame($json['scores_around']['higher']['scores'][0]['id'], $scoreLinks[0]->getKey());
        $this->assertSame($json['scores_around']['lower']['scores'][0]['id'], $scoreLinks[2]->getKey());
    }

    /**
     * @dataProvider dataProviderForTestStore
     */
    public function testStore($allowRanking, $hashParam, $status)
    {
        $user = User::factory()->create();
        $playlistItem = PlaylistItem::factory()->create();
        $build = Build::factory()->create(['allow_ranking' => $allowRanking]);

        $this->actAsScopedUser($user, ['*']);

        $params = [];
        if ($hashParam !== null) {
            $params['version_hash'] = $hashParam ? bin2hex($build->hash) : md5('invalid_');
        }

        $countDiff = ((string) $status)[0] === '2' ? 1 : 0;
        $this->expectCountChange(fn () => ScoreLink::count(), $countDiff);

        $this->json('POST', route('api.rooms.playlist.scores.store', [
            'room' => $playlistItem->room_id,
            'playlist' => $playlistItem->getKey(),
        ]), $params)->assertStatus($status);
    }

    /**
     * @dataProvider dataProviderForTestUpdate
     */
    public function testUpdate($bodyParams, $status)
    {
        $user = User::factory()->create();
        $playlistItem = PlaylistItem::factory()->create();
        $room = $playlistItem->room;
        $build = Build::factory()->create(['allow_ranking' => true]);
        $scoreLink = $room->startPlay($user, $playlistItem, 0);

        $this->actAsScopedUser($user, ['*']);

        $url = route('api.rooms.playlist.scores.update', [
            'room' => $room,
            'playlist' => $playlistItem,
            'score' => $scoreLink,
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
