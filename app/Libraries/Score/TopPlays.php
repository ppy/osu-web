<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Score;

use App\Libraries\Search\ScoreSearch;
use App\Libraries\Search\ScoreSearchParams;

class TopPlays
{
    const string KEY = 'score_top_plays';

    private readonly string $key;

    public function __construct(private readonly int $rulesetId, private readonly ?string $countryCode = null)
    {
        $key = static::KEY.':'.$this->rulesetId;

        if ($this->countryCode !== null) {
            $key = $key.':'.$this->countryCode;
        }

        $this->key = $key;
    }

    public function updateCache(): void
    {
        $search = new ScoreSearch(ScoreSearchParams::fromArray([
            'excludeWithoutPp' => true,
            'limit' => 3000,
            'ruleset_id' => $this->rulesetId,
            'sort' => 'pp_desc',
            'country_code' => $this->countryCode,
            'type' => $this->countryCode === null ? 'global' : 'country',
        ]));
        $search->connectionName = 'scores_slow';
        $search->searchTimeout = "{$GLOBALS['cfg']['elasticsearch']['connections']['scores_slow']['connectionParams']['client']['timeout']}s";

        $scores = $search->records();
        $ids = [];
        foreach ($scores as $score) {
            // the loop is in descending order so the first assignment will be the highest pp score.
            $ids["{$score->user_id}:{$score->beatmap_id}"] ??= $score->getKey();
        }
        $data = [
            'ids' => array_values(array_slice($ids, 0, 1500)),
            'time' => time(),
        ];

        \Cache::put($this->key, $data);
    }

    public function get(): ?array
    {
        return \Cache::get($this->key);
    }
}
