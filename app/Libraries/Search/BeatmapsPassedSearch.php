<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

class BeatmapsPassedSearch
{
    private const AGG_NAME = 'by_beatmap';

    private ?array $completedBeatmapIds = null;
    private ScoreSearch $search;

    public function __construct(
        int $userId,
        array $beatmapIds,
        bool $noDiffReduction = true,
        ?int $rulesetId = null,
        ?bool $isLegacy = null
    ) {
        if (count($beatmapIds) === 0) {
            $this->completedBeatmapIds = [];
        } else {
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

            $this->search = new ScoreSearch(ScoreSearchParams::fromArray($params));
            $this->search->size(0);
            $this->search->setAggregations([self::AGG_NAME => [
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
        }
    }

    public function completedBeatmapIds(): array
    {
        if ($this->completedBeatmapIds === null) {
            $response = $this->search->response();
            $this->search->assertNoError();

            $this->completedBeatmapIds = array_map(
                fn (array $hit): int => (int) $hit['key'],
                $response->aggregations(self::AGG_NAME)['buckets'],
            );
        }

        return $this->completedBeatmapIds;
    }
}
