<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Libraries\Elasticsearch\BoolQuery;
use App\Libraries\Elasticsearch\Es;
use App\Libraries\Elasticsearch\Search;
use App\Libraries\Elasticsearch\Sort;
use App\Libraries\Search\BasicSearch;
use App\Models\Score\Best;
use App\Models\User;

/**
 * Used to check the best scores for a user if it exists in elasticsearch but not longer
 * exists in the database. A mismatch tends to break the current pager, so this can be run to
 * fix it by deleting the invalid score from elasticsearch.
 *
 * e.g.
 * (new UserBestScoresCheck(User::find($user_id)))->run($mode).
 */
class UserBestScoresCheck
{
    /** @var int */
    public $dbIdsFound;
    /** @var int */
    public $esIdsFound;

    /** @var User */
    private $user;

    /**
     * @param User $user The User to check the scores for.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Checks for extraneous scores in Elasticsearch.
     *
     * @param string $mode The game mode.
     * @return array List of score_ids that exist in Elasticsearch but not the database.
     */
    public function check(string $mode)
    {
        $this->dbIdsFound = 0;
        $this->esIdsFound = 0;

        $clazz = Best\Model::getClassByString($mode);

        $search = $this->newSearch($mode);
        $cursor = [0];

        $missingIds = [];

        while ($cursor !== null) {
            $esIds = $search->searchAfter(array_values($cursor))->response()->ids();
            $this->esIdsFound += count($esIds);

            $dbIds = $clazz::default()->whereIn('score_id', $esIds)->pluck('score_id')->all();
            $this->dbIdsFound += count($dbIds);

            $missingIds = array_merge(
                $missingIds,
                array_values(array_diff($esIds, $dbIds))
            );

            $cursor = $search->getSortCursor();
        }

        return $missingIds;
    }

    /**
     * Removes extraneous scores from Elasticsearch.
     *
     * @param string $mode The game mode.
     * @param array $ids List of score_ids to remove.
     * @return array The raw response from Elasticsearch.
     */
    public function removeFromEs(string $mode, array $ids)
    {
        return Es::getClient('scores')->deleteByQuery([
            'index' => config('osu.elasticsearch.prefix')."high_scores_{$mode}",
            'body' => ['query' => ['terms' => ['score_id' => $ids]]],
        ]);
    }

    /**
     * Checks for extraneous scores in Elasticsearch and removes them.
     *
     * @param string $mode The game mode.
     * @return array The raw response from Elasticsearch.
     */
    public function run(string $mode)
    {
        return $this->removeFromEs($mode, $this->check($mode));
    }

    private function newSearch(string $mode): Search
    {
        $index = config('osu.elasticsearch.prefix')."high_scores_{$mode}";

        $search = new BasicSearch($index, "user_best_scores_check_{$mode}");
        $search->connectionName = 'scores';

        return $search
            ->sort(new Sort('score_id', 'asc'))
            ->size(Es::CHUNK_SIZE)
            ->query((new BoolQuery())->filter(['term' => ['user_id' => $this->user->getKey()]]));
    }
}
