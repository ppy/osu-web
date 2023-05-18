<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Models\BeatmapDifficulty;
use App\Models\BeatmapDifficultyAttrib;
use App\Models\BeatmapFailtimes;
use App\Models\BeatmapModeStats;
use App\Models\Chat;
use App\Models\FavouriteBeatmapset;
use App\Models\Forum;
use App\Models\LegacyMatch;
use App\Models\UserAchievement;
use App\Models\UserClient;
use App\Models\UserDonation;
use App\Models\UserGroup;
use App\Models\UserRelation;
use App\Models\UserReplaysWatchedCount;
use Carbon\Carbon;
use Tests\TestCase;

class ModelCompositePrimaryKeysTest extends TestCase
{
    /**
     * @dataProvider dataProviderBase
     */
    public function testDelete(string $class, array $baseParams, array $item2Params, array $check)
    {
        [$item1, $item2] = $this->createModels($class, $baseParams, $item2Params, $check);

        $this->expectCountChange(fn () => $class::count(), -1);
        $item1->delete();
        $this->assertNull($item1->fresh());
        $this->assertNotNull($item2->fresh());
    }

    /**
     * @dataProvider dataProviderBase
     */
    public function testFresh(string $class, array $baseParams, array $item2Params, array $check)
    {
        [$item1, $item2] = $this->createModels($class, $baseParams, $item2Params, $check);

        $this->assertSame(':composite', $item1->getKeyName());
        $this->assertFalse($item1->incrementing);

        $key = $check[0];
        $cast = $this->getCast($check[2]);
        $this->assertSame($cast($check[1][0]), $cast($item1->fresh()->$key));
        $this->assertSame($cast($check[2]), $cast($item2->fresh()->$key));
    }

    /**
     * @dataProvider dataProviderBase
     */
    public function testUpdate(string $class, array $baseParams, array $item2Params, array $check)
    {
        [$item1, $item2] = $this->createModels($class, $baseParams, $item2Params, $check);

        $key = $check[0];
        $newValue = $check[1][1];
        $item1->update([$key => $newValue]);
        $cast = $this->getCast($check[2]);
        $this->assertSame($cast($newValue), $cast($item1->fresh()->$key));
        $this->assertSame($cast($check[2]), $cast($item2->fresh()->$key));
    }

    public function dataProviderBase()
    {
        // 0: class name
        // 1: base params
        // 2: base params for item 2
        // 3:
        //   0: check column
        //   1: item 1 value
        //     0: initial value
        //     1: update value
        //   2: item 2 value
        return [
            [
                BeatmapDifficulty::class,
                [
                    'beatmap_id' => 0,
                    'mode' => 0,
                    'mods' => 0,
                ],
                ['beatmap_id' => 1],
                ['diff_unified', [0.0, 10.0], 11.0],
            ],
            [
                BeatmapDifficultyAttrib::class,
                [
                    'attrib_id' => 0,
                    'beatmap_id' => 0,
                    'mode' => 0,
                    'mods' => 0,
                ],
                ['beatmap_id' => 1],
                ['value', [0.0, 10.0], 11.0],
            ],
            [
                BeatmapFailtimes::class,
                [
                    'beatmap_id' => 0,
                    'type' => 'fail',
                ],
                ['type' => 'exit'],
                ['p1', [0, 10], 11],
            ],
            [
                BeatmapModeStats::class,
                [
                    'beatmap_id' => 0,
                    'mode' => 0,
                ],
                ['mode' => 1],
                ['ss_ratio', [0.0, 0.5], 1.0],
            ],
            [
                Chat\UserChannel::class,
                [
                    'channel_id' => 0,
                    'user_id' => 0,
                ],
                ['channel_id' => 1],
                ['last_read_id', [1, 2], 3],
            ],
            [
                FavouriteBeatmapset::class,
                [
                    'beatmapset_id' => 0,
                    'user_id' => 0,
                ],
                ['beatmapset_id' => 2],
                ['dateadded', [Carbon::now()->subDays(5), Carbon::now()->subDays(1)], Carbon::now()],
            ],
            [
                Forum\AuthRole::class,
                [
                    'auth_option_id' => 0,
                    'role_id' => 0,
                ],
                ['role_id' => 1],
                ['auth_setting', [0, 1], 2],
            ],
            [
                Forum\Authorize::class,
                [
                    'auth_option_id' => 0,
                    'auth_role_id' => 0,
                    'forum_id' => 0,
                    'group_id' => 0,
                ],
                [],
                ['auth_setting', [0, 1], 2],
            ],
            [
                Forum\ForumTrack::class,
                [
                    'forum_id' => 0,
                ],
                [],
                ['user_id', [0, 1], 2],
            ],
            [
                Forum\TopicTrack::class,
                [
                    'topic_id' => 0,
                ],
                [],
                ['user_id', [0, 1], 2],
            ],
            [
                Forum\TopicWatch::class,
                [
                    'topic_id' => 0,
                ],
                [],
                ['user_id', [0, 1], 2],
            ],
            [
                LegacyMatch\Score::class,
                [
                    'game_id' => 0,
                    'slot' => 0,
                    'user_id' => 0,
                ],
                ['slot' => 1],
                ['score', [10, 20], 30],
            ],
            [
                UserAchievement::class,
                [
                    'user_id' => 0,
                    'achievement_id' => 0,
                ],
                ['user_id' => 1],
                ['beatmap_id', [1, 2], 3],
            ],
            [
                UserClient::class,
                [
                    'osu_md5' => md5('', true),
                    'unique_md5' => md5('', true),
                    'disk_md5' => md5('', true),
                ],
                [],
                ['user_id', [0, 1], 2],
            ],
            [
                UserDonation::class,
                [
                    'user_id' => 0,
                    'transaction_id' => '',
                    'amount' => 1,
                ],
                ['user_id' => 1],
                ['length', [1, 2], 3],
            ],
            [
                UserGroup::class,
                [
                    'user_id' => 0,
                    'group_id' => 0,
                ],
                ['user_id' => 1],
                ['group_leader', [true, false], true],
            ],
            [
                UserRelation::class,
                [
                    'user_id' => 0,
                ],
                [],
                ['zebra_id', [1, 2], 3],
            ],
            [
                UserReplaysWatchedCount::class,
                [
                    'user_id' => 0,
                    'year_month' => '0101',
                ],
                ['user_id' => 1],
                ['count', [0, 1], 2],
            ],
        ];
    }

    private function createModels(string $class, array $baseParams, array $item2Params, array $check)
    {
        return [
            $class::create(array_merge($baseParams, [$check[0] => $check[1][0]])),
            $class::create(array_merge($baseParams, $item2Params, [$check[0] => $check[2]])),
        ];
    }

    private function getCast(mixed $value): callable
    {
        return $value instanceof Carbon
            ? fn (Carbon $value): string => json_time($value)
            : fn (mixed $value): mixed => $value;
    }
}
