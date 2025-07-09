<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

class BeatmapsPassedSearch
{
    private const AGG_NAME = 'by_beatmap';

    public static function completedIds(
        int $userId,
        array $beatmapIds,
        bool $noDiffReduction,
        ?int $rulesetId,
        ?bool $isLegacy
    ) {
        if (count($beatmapIds) === 0) {
            return [];
        }

        $params = [
            'beatmap_ids' => $beatmapIds,
            'exclude_converts' => $rulesetId === null,
            'is_legacy' => $isLegacy,
            'ruleset_id' => $rulesetId,
            'user_id' => $userId,
        ];

        if ($noDiffReduction) {
            $params['exclude_mods'] = app('mods')->difficultyReductionIds->toArray();
            if ($isLegacy !== true) {
                // the intended meaning of this check is that the scores should not include mods
                // that disqualify them from granting pp.
                // mods are not the only reason why pp might be missing, but it's the best that we have for now.
                // see also: https://github.com/ppy/osu-queue-score-statistics/pull/234
                $params['exclude_without_pp'] = true;
            }
        }

        $search = new ScoreSearch(ScoreSearchParams::fromArray($params));
        $search->size(0);
        $search->setAggregations([self::AGG_NAME => [
            'terms' => [
                'field' => 'beatmap_id',
                'size' => count($beatmapIds),
            ],
            'aggs' => [
                'scores' => [
                    'top_hits' => [
                        'size' => 1,
                    ],
                ],
            ],
        ]]);

        $response = $search->response();
        $search->assertNoError();

        return array_map(
            fn (array $hit): int => (int) $hit['key'],
            $response->aggregations(self::AGG_NAME)['buckets'],
        );
    }
}
