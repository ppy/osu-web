<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Score;

use App\Libraries\Search\ScoreSearch;
use App\Libraries\Search\ScoreSearchParams;

class FetchDedupedScores
{
    private int $limit;
    private array $result;

    public function __construct(private string $dedupeColumn, private ScoreSearchParams $params)
    {
        $this->limit = $this->params->size;
    }

    public function all(): array
    {
        $this->params->size = $this->limit + 50;
        $search = new ScoreSearch($this->params);

        $nextCursor = null;
        $hasNext = true;
        $this->result = [];

        while ($hasNext) {
            if ($nextCursor !== null) {
                // FIXME: cursor value returned is 0/1 but elasticsearch expects false/true...
                $nextCursor['is_legacy'] = get_bool($nextCursor['is_legacy']);
                $search->searchAfter(array_values($nextCursor));
            }
            $response = $search->response();
            $search->assertNoError();

            $records = $response->records()->whereHas('beatmap.beatmapset')->get()->all();
            if ($this->append($records)) {
                break;
            }

            $nextCursor = $search->getSortCursor();
            $hasNext = $nextCursor !== null;
        }

        return $this->result;
    }

    private function append(array $newScores): bool
    {
        $dedupeColumn = $this->dedupeColumn;

        foreach ($newScores as $score) {
            $dedupeColumnValue = $score->$dedupeColumn;

            if (!isset($this->result[$dedupeColumnValue])) {
                $this->result[$dedupeColumnValue] = $score;

                if (count($this->result) >= $this->limit) {
                    return true;
                }
            }
        }

        return false;
    }
}
