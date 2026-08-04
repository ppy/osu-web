<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\BoolQuery;
use App\Libraries\Elasticsearch\RecordSearch;
use App\Models\User;
use App\Transformers\UserCompactTransformer;

class UserSearch extends RecordSearch
{
    private const BOOST_GROUPS = [
        2 => ['alumni', 'loved', 'bsc', 'tc'],
        5 => ['ppy', 'gmt', 'nat', 'bng', 'bng_limited', 'dev', 'support', 'featured_artist'],
    ];

    public function __construct(?UserSearchParams $params = null)
    {
        parent::__construct(
            User::esIndexName(),
            $params ?? new UserSearchParams(),
            User::class
        );
    }

    public function records()
    {
        return $this->response()->records()->with(UserCompactTransformer::CARD_INCLUDES_PRELOAD)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getQuery()
    {
        static $lowercaseStick = [
            'analyzer' => 'username_lower',
            'type' => 'most_fields',
            'fields' => ['username', 'username._*'],
        ];

        static $whitespaceStick = [
            'analyzer' => 'whitespace',
            'type' => 'most_fields',
            'fields' => ['username', 'username._*'],
        ];

        static $boostGroups;

        if (!isset($boostGroups)) {
            $allGroupsByIdentifier = app('groups')->allByIdentifier();
            foreach (self::BOOST_GROUPS as $boost => $identifiers) {
                $boostGroups[$boost] = array_reject_null(array_map(fn ($identifier) => ($allGroupsByIdentifier[$identifier] ?? null)?->getKey(), $identifiers));
            }
        }

        $query = (new BoolQuery())
            ->mustNot(['terms' => ['_id' => $this->params->blockedUserIds()]])
            ->mustNot(['term' => ['is_old' => true]])
            ->filter(['term' => ['user_warnings' => 0]])
            ->filter(['term' => ['user_type' => 0]]);

        if ($this->params->queryString !== null) {
            $query->must((new BoolQuery())->shouldMatch(1)
                ->should(['term' => ['_id' => ['value' => $this->params->queryString, 'boost' => 100]]])
                ->should(['match' => ['username.raw' => ['query' => $this->params->queryString, 'boost' => 10]]])
                ->should(['match' => ['previous_usernames' => ['query' => $this->params->queryString]]])
                ->should(['multi_match' => array_merge(['query' => $this->params->queryString], $lowercaseStick)])
                ->should(['multi_match' => array_merge(['query' => $this->params->queryString], $whitespaceStick)])
                ->should(['match_phrase' => ['username._slop' => $this->params->queryString]]));

            foreach ($boostGroups as $boost => $groupIds) {
                $query->should(['terms' => ['groups' => $groupIds, 'boost' => $boost]]);
            }
            $query->should(['range' => ['user_lastvisit' => ['gte' => 'now-30d/d', 'boost' => 1.5]]]);
        }

        if ($this->params->recentOnly) {
            $query->filter([
                'range' => [
                    'user_lastvisit' => [
                        'gte' => 'now-90d',
                    ],
                ],
            ]);
        }

        return $query;
    }

    protected function maxResults(): int
    {
        return $GLOBALS['cfg']['osu']['search']['max']['user'];
    }
}
