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
        static $lowercase_stick = [
            'analyzer' => 'username_lower',
            'type' => 'most_fields',
            'fields' => ['username', 'username._*'],
        ];

        static $whitespace_stick = [
            'analyzer' => 'whitespace',
            'type' => 'most_fields',
            'fields' => ['username', 'username._*'],
        ];

        $query = (new BoolQuery())
            ->mustNot(['terms' => ['_id' => $this->params->blockedUserIds()]])
            ->mustNot(['term' => ['is_old' => true]])
            ->filter(['term' => ['user_warnings' => 0]])
            ->filter(['term' => ['user_type' => 0]]);

        static $boost_groups = null;

        if ($boost_groups === null) {
            $getGroupId = fn ($identifier) => app('groups')->byIdentifier($identifier)?->getKey();

            $boost_groups = [
                'staff_bn' => array_values(array_filter([
                    $getGroupId('ppy'),
                    $getGroupId('gmt'),
                    $getGroupId('nat'),
                    $getGroupId('bng'),
                    $getGroupId('bng_limited'),
                    $getGroupId('dev'),
                    $getGroupId('support'),
                    $getGroupId('featured_artist'),
                ])),
                'contributors' => array_values(array_filter([
                    $getGroupId('alumni'),
                    $getGroupId('loved'),
                    $getGroupId('beatmap_spotlights'),
                    $getGroupId('tournament_staff'),
                ])),
            ];
        }

        if ($this->params->queryString !== null) {
            $textQuery = (new BoolQuery())->shouldMatch(1)
                ->should(['term' => ['_id' => ['value' => $this->params->queryString, 'boost' => 100]]])
                ->should(['match' => ['username.raw' => ['query' => $this->params->queryString, 'boost' => 10]]])
                ->should(['match' => ['previous_usernames' => ['query' => $this->params->queryString]]])
                ->should(['multi_match' => array_merge(['query' => $this->params->queryString], $lowercase_stick)])
                ->should(['multi_match' => array_merge(['query' => $this->params->queryString], $whitespace_stick)])
                ->should(['match_phrase' => ['username._slop' => $this->params->queryString]]);

            $query->must($textQuery);

            if ($boost_groups['staff_bn']) {
                $query->should(['terms' => ['groups' => $boost_groups['staff_bn'], 'boost' => 5]]);
            }

            if ($boost_groups['contributors']) {
                $query->should(['terms' => ['groups' => $boost_groups['contributors'], 'boost' => 2]]);
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
