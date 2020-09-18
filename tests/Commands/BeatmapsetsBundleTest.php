<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Commands;

use App\Models\Beatmapset;
use Carbon\Carbon;
use Tests\TestCase;

class BeatmapsetsBundleTest extends TestCase
{
    /**
     * @dataProvider bundledExamples
     */
    public function testBundleBeatmapsets(Carbon $date, array $tutorialIds, array $canBundleIds, array $expectedBundled)
    {
        $this->createCanBundleBeatmapsets($tutorialIds, 0);
        foreach ($canBundleIds as $modeInt => $canBundleIdsForMode) {
            $this->createCanBundleBeatmapsets($canBundleIdsForMode, $modeInt);
        }

        Carbon::setTestNow($date);
        config()->set('osu.beatmapset.tutorial_ids', $tutorialIds);

        $this->artisan('beatmapsets:bundle');

        sort($expectedBundled);
        $this->assertSame(
            $expectedBundled,
            Beatmapset::bundled()->pluck('beatmapset_id')->sort()->all(),
        );
    }

    public function bundledExamples(): array
    {
        return [
            // Beatmapsets with multiple game modes and tutorial beatmapset with can_bundle
            [
                Carbon::createFromTimestamp(100000000),
                [1],
                [
                    [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16],
                    [17, 18, 19, 20, 21, 22, 1, 2],
                    [23, 24, 25, 26, 27, 28, 3, 4],
                    [29, 30, 31, 32, 33, 34, 5, 6],
                ],
                [1, 5, 6, 10, 13, 11, 7, 14, 8, 19, 20, 21, 24, 25, 26, 30, 31, 32],
            ],

            // Real data from osu!stable
            [
                Carbon::createMidnightDate(2020, 9, 12, 'UTC'),
                [1011011],
                [
                    [682286, 682287, 682289, 682290, 682416, 682595, 716211, 716213, 716215, 716219, 716249, 716390, 716441, 716630, 729808, 751771, 751772, 751773, 751774, 751779, 751782, 751785, 751846, 751866, 751894, 751896, 751932, 751972, 779173, 780932, 785572, 785650, 785677, 785731, 785774, 786498, 789374, 789528, 789529, 789544, 789905, 791667, 791798, 791845, 792241, 792396, 795432, 831322, 847764, 847776, 847812, 847900, 847930, 848003, 848068, 848090, 848259, 848976, 851543, 864748, 873667, 876227, 880487, 883088, 891333, 891334, 891337, 891338, 891339, 891345, 891348, 891356, 891366, 891417, 891441, 891632, 891712, 901091, 916990, 929284, 933940, 934415, 934627, 934666, 936126, 940377, 940597, 941085, 949297, 952380, 954272, 955866, 961320, 964553, 965651, 966225, 966324, 972810, 972932, 977276, 981616, 985788, 996628, 996898, 1003554, 1014936, 1019827, 1020213, 1021450],
                    [707824, 789553, 827822, 847323, 847433, 847576, 847957, 876282, 876648, 877069, 877496, 877935, 878344, 918446, 918903, 919251, 919704, 921535, 927206, 927544, 930806, 931741, 935699, 935732, 941145, 942334, 946540, 948844, 949122, 951618, 957412, 961335, 965178, 966087, 966277, 966407, 966451, 972301, 973173, 973954, 975435, 978759, 982559, 984361, 1023681, 1034358, 1037567],
                    [554256, 693123, 767009, 767346, 815162, 840964, 932657, 933700, 933984, 934785, 936545, 943803, 943876, 946773, 955808, 957808, 957842, 965730, 966240, 968232, 972302, 972887, 1008600, 1032103],
                    [943516, 946394, 966408, 971561, 983864, 989512, 994104, 1003217, 1009907, 1015169],
                ],
                [1011011, 891339, 786498, 949297, 848090, 716211, 934415, 785650, 682290, 966407, 847957, 961335, 932657, 767346, 933984, 994104, 971561, 1009907],
            ],
        ];
    }

    private function createCanBundleBeatmapsets(array $ids, int $mode): void
    {
        foreach ($ids as $id) {
            Beatmapset::firstOrCreate(
                ['beatmapset_id' => $id],
                ['can_bundle' => true],
            )
                ->beatmaps()
                ->create(['playmode' => $mode]);
        }
    }
}
