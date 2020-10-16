<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Elasticsearch;

use App\Traits\EsIndexableModel;
use Carbon\Carbon;
use Schema;

trait UserTrait
{
    use EsIndexableModel;

    public static function esIndexName()
    {
        return config('osu.elasticsearch.prefix').'users';
    }

    public static function esIndexingQuery()
    {
        $columns = array_keys((new static())->esFilterFields());
        array_unshift($columns, 'user_id');

        return static::withoutGlobalScopes()
            ->with('usernameChangeHistoryPublic')
            ->select($columns);
    }

    public static function esSchemaFile()
    {
        return config_path('schemas/users.json');
    }

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
}
