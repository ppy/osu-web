<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Search\BeatmapsetSearch;

use App\Models\Beatmapset;

class TitleFilterTest extends TestCase
{
    protected array $defaultExpectedSort = ['_score', 'id'];

    public static function dataProvider(): array
    {
        return [
            // TODO: find a working solution to relevancy ordering; the problem is scores are not consistent between test runs
            // depending on elasticsearch term frequency statistic updates.
            // _scores of test #0 when TitleFilterTest run alone
            // [[1.2779001,0],[0.8136996,4],[0.33432162,3],[0.28844222,2],[0.27818984,1]]
            // [[1.2878734,0],[0.8301021,4],[0.32621458,3],[0.28144777,2],[0.271444,1]]
            // [[1.2516384,0],[0.7690376,4],[0.35742703,3],[0.30837688,2],[0.2974159,1]]
            //
            // when tests are run together
            // [[4.0467224,0],[3.039711,4],[2.9713743,3],[2.7553484,2],[2.6568809,1]]
            // [[4.9247246,0],[3.8785365,3],[3.8699822,4],[3.6045477,2],[3.4773993,1]]
            // [[4.9854345,0],[3.9834518,4],[3.8591044,3],[3.580671,2],[3.4518704,1]]

            [['q' => 'best'], [0, 4, 3, 2, 1]],
            [['q' => 'best beatmap'], [3, 2, 1, 0, 4]],
            [['q' => '"best beatmap"'], [3, 2, 1]],
            [['q' => '-best'], []],
            [['q' => '-best -beatmap'], []],
            [['q' => '-"best beatmap"'], [4, 0]],

            [['q' => 'title=best'], [0, 3, 2, 1]],
            [['q' => 'title="best beatmap"'], [3, 2, 1]],
            [['q' => 'title="the beatmap"'], [1, 2]],
            [['q' => 'title=""best beatmap""'], [3, 2, 1]],
            [['q' => 'title=""the beatmap""'], []],
        ];
    }

    public static function setUpBeforeClass(): void
    {
        static::withDbAccess(function () {
            $factory = Beatmapset::factory()->fixedStrings()->ranked()->withBeatmaps(beatmapState: ['version' => 'test']);
            static::$beatmapsets = [
                $factory->create(['title' => 'best']),
                $factory->create(['title' => 'the best beatmap']),
                $factory->create(['title' => 'the best beatmap', 'title_unicode' => 'ダ best beatmap']),
                $factory->create(['title' => 'best beatmap']),
                $factory->create(['artist' => 'the best artist']),
            ];
        });

        parent::setUpBeforeClass();
    }
}
