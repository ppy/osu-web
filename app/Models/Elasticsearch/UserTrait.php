<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

use App\Traits\EsIndexableModel;
use Carbon\Carbon;
use Schema;

trait UserTrait
{
    use EsIndexableModel;

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

        $values['previous_usernames'] = $this->previousUsernames(true)->unique()->values();

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

    public static function esIndexName()
    {
        return config('osu.elasticsearch.prefix').'users';
    }

    public static function esIndexingQuery()
    {
        $columns = array_keys((new static())->esFilterFields());
        array_unshift($columns, 'user_id');

        return static::on('mysql')
            ->withoutGlobalScopes()
            ->with('usernameChangeHistoryPublic')
            ->select($columns);
    }

    public static function esSchemaFile()
    {
        return config_path('schemas/users.json');
    }

    public static function esType()
    {
        return 'users';
    }
}
