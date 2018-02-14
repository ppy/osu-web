<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Models\Elasticsearch;

use App\Traits\EsIndexable;
use Carbon\Carbon;
use Schema;

trait UserTrait
{
    use EsIndexable;

    public function toEsJson()
    {
        $mappings = $this->esFilterFields();

        $values = [];
        foreach ($mappings as $field => $mapping) {
            $value = $this[$field];
            if ($value instanceof Carbon) {
                $value = $value->toIso8601String();
            }

            $values[$field] = $value;
        }

        $values['is_old'] = $this->isOld();

        return $values;
    }

    /**
     * Returns the fields which have a directly corresponding column.
     * This is intended to filter out fields calculated for indexing purposes.
     */
    protected function esFilterFields()
    {
        // get table columns to intersect with.
        // getAttributes() doesn't return attributes that aren't populated.
        // This involves reading the schema from the database;
        static $columnMap;
        // read once.
        if (!isset($columnMap)) {
            $columnMap = [];
            $columns = Schema::getColumnListing($this->table);
            foreach ($columns as $column) {
                $columnMap[$column] = '';
            }
        }

        return array_intersect_key(static::esMappings(), $columnMap);
    }

    public static function esAnalysisSettings()
    {
        static $settings = [
            'filter' => [
                // sloppy match index filter
                'username_slop_filter' => [
                    'type' => 'ngram',
                    'min_gram' => 2,
                    'max_gram' => 8,
                ],
            ],
            'analyzer' => [
                'username_slop' => [
                    'type' => 'custom',
                    'tokenizer' => 'standard',
                    'filter' => ['lowercase', 'username_slop_filter'],
                ],
                'username_lower' => [
                    'type' => 'custom',
                    'tokenizer' => 'standard',
                    'filter' => ['lowercase'],
                ],
                'whitespace' => [
                    'type' => 'custom',
                    'tokenizer' => 'whitespace',
                    'filter' => ['lowercase'],
                ],
            ],
        ];

        return $settings;
    }

    public static function esIndexName()
    {
        return config('osu.elasticsearch.prefix').'users';
    }

    public static function esIndexingQuery()
    {
        $columns = array_keys((new static())->esFilterFields());
        array_unshift($columns, 'user_id');

        return static::on('mysql-readonly')->withoutGlobalScopes()->select($columns);
    }

    public static function esMappings()
    {
        return static::ES_MAPPINGS;
    }

    public static function esType()
    {
        return 'users';
    }

    public static function usernameSearchQuery(string $username)
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

        return [
            'bool' => [
                'minimum_should_match' => 1,
                'should' => [
                    ['match' => ['username.raw' => ['query' => $username, 'boost' => 5]]],
                    ['multi_match' => array_merge(['query' => $username], $lowercase_stick)],
                    ['multi_match' => array_merge(['query' => $username], $whitespace_stick)],
                    ['match_phrase' => ['username._slop' => $username]],
                ],
                'must_not' => [
                    ['term' => ['is_old' => true]],
                ],
                'filter' => [
                    ['term' => ['user_warnings' => 0]],
                    ['term' => ['user_type' => 0]],
                ],
            ],
        ];
    }
}
