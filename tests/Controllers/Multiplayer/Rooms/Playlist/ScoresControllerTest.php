<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Multiplayer\Rooms\Playlist;

use App\Models\Beatmap;
use App\Models\Build;
use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\ScoreLink;
use App\Models\Multiplayer\UserScoreAggregate;
use App\Models\ScoreToken;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
            ->completed(['passed' => true, 'total_score' => 30])
            ->create();
        $scoreLinks[] = $userScoreLink = ScoreLink
            ::factory()
            ->state([
                'playlist_item_id' => $playlist,
                'user_id' => $user,
            ])->completed(['passed' => true, 'total_score' => 20])
            ->create();
        $scoreLinks[] = ScoreLink
            ::factory()
            ->state(['playlist_item_id' => $playlist])
            ->completed(['passed' => true, 'total_score' => 10])
            ->create();

        foreach ($scoreLinks as $scoreLink) {
            UserScoreAggregate::lookupOrDefault($scoreLink->user, $scoreLink->playlistItem->room)->recalculate();
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
            ->completed(['passed' => true, 'total_score' => 30])
            ->create();
        $scoreLinks[] = $userScoreLink = ScoreLink
            ::factory()
            ->state([
                'playlist_item_id' => $playlist,
                'user_id' => $user,
            ])->completed(['passed' => true, 'total_score' => 20])
            ->create();
        $scoreLinks[] = ScoreLink
            ::factory()
            ->state(['playlist_item_id' => $playlist])
            ->completed(['passed' => true, 'total_score' => 10])
            ->create();

        foreach ($scoreLinks as $scoreLink) {
            UserScoreAggregate::lookupOrDefault($scoreLink->user, $scoreLink->playlistItem->room)->recalculate();
        }

        $this->actAsScopedUser($user, ['*']);

        $resp = $this->json('GET', route('api.rooms.playlist.scores.show', [
            'room' => $userScoreLink->playlistItem->room_id,
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
        $origClientCheckVersion = $GLOBALS['cfg']['osu']['client']['check_version'];
        config_set('osu.client.check_version', true);
        $user = User::factory()->create();
        $playlistItem = PlaylistItem::factory()->create();
        $build = Build::factory()->create(['allow_ranking' => $allowRanking]);

        $this->actAsScopedUser($user, ['*']);

        if ($hashParam !== null) {
            $this->withHeaders([
                'x-token' => $hashParam ? static::createClientToken($build) : strtoupper(md5('invalid_')),
            ]);
        }

        $countDiff = ((string) $status)[0] === '2' ? 1 : 0;
        $this->expectCountChange(fn () => ScoreToken::count(), $countDiff);

        $this->json('POST', route('api.rooms.playlist.scores.store', [
            'beatmap_hash' => $playlistItem->beatmap->checksum,
            'playlist' => $playlistItem->getKey(),
            'room' => $playlistItem->room_id,
        ]))->assertStatus($status);

        config_set('osu.client.check_version', $origClientCheckVersion);
    }

    /**
     * This scenario is theoretically impossible to occur via osu-web,
     * but realtime multiplayer rooms have their playlist items modified directly in the database
     * by osu-server-spectator.
     * This test case is insurance that invalid updates performed by it do not cause further breakage.
     */
    public function testAttemptToStartPlayOnInconsistentPlaylistItemFails()
    {
        $origClientCheckVersion = $GLOBALS['cfg']['osu']['client']['check_version'];
        config_set('osu.client.check_version', true);
        $user = User::factory()->create();
        $beatmap = Beatmap::factory()->create([
            'playmode' => 2,
        ]);
        $playlistItem = PlaylistItem::factory()->create([
            'beatmap_id' => $beatmap->getKey(),
        ]);

        // simulate invalid external modification from osu-server-spectator
        PlaylistItem::whereKey($playlistItem->getKey())->update(['ruleset_id' => 3]);

        $build = Build::factory()->create(['allow_ranking' => true]);

        $this->actAsScopedUser($user, ['*']);

        $this->withHeaders([
            'x-token' => static::createClientToken($build),
        ]);

        $this->expectCountChange(fn () => ScoreToken::count(), 0);

        $this->json('POST', route('api.rooms.playlist.scores.store', [
            'beatmap_hash' => $playlistItem->beatmap->checksum,
            'playlist' => $playlistItem->getKey(),
            'room' => $playlistItem->room_id,
        ]))->assertStatus(422);

        config_set('osu.client.check_version', $origClientCheckVersion);
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
        $scoreToken = $room->startPlay($user, $playlistItem, 0);

        $this->withHeaders(['x-token' => static::createClientToken($build)]);

        $this->expectCountChange(
            fn () => \LaravelRedis::llen($GLOBALS['cfg']['osu']['client']['token_queue']),
            $status === 200 ? 1 : 0,
        );

        $this->actAsScopedUser($user, ['*']);

        $url = route('api.rooms.playlist.scores.update', [
            'room' => $room,
            'playlist' => $playlistItem,
            'score' => $scoreToken,
        ]);

        $this->json('PUT', $url, $bodyParams)->assertStatus($status);

        $roomAgg = UserScoreAggregate::new($user, $room);
        $this->assertSame($status === 200 ? 1 : 0, $roomAgg->completed);
    }

    public static function dataProviderForTestStore()
    {
        return [
            'ok' => [true, true, 200],
            'invalid hash' => [true, false, 422],
            'missing hash' => [true, null, 422],
            'no ranking build' => [false, true, 422],
        ];
    }

    public static function dataProviderForTestUpdate()
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
