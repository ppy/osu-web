<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Elasticsearch;

use App\Traits\EsIndexableModel;
use Carbon\Carbon;

trait UserTrait
{
    use EsIndexableModel;

    public static function esIndexName()
    {
        return config('osu.elasticsearch.prefix').'users';
    }

    public static function esIndexingQuery()
    {
        return static::withoutGlobalScopes()
            ->with('usernameChangeHistoryPublic');
    }

    public static function esSchemaFile()
    {
        return config_path('schemas/users.json');
    }

    public function toEsJson()
    {
        $mappings = static::esMappings();

        $document = [];
        foreach ($mappings as $field => $mapping) {
            switch ($field) {
                case 'is_old':
                    $value = $this->isOld();
                    break;
                case 'previous_usernames':
                    $value = $this->previousUsernames(true)->unique()->values();
                    break;
                case 'user_lastvisit':
                    $value = $this->displayed_last_visit;
                    break;
                default:
                    $value = $this[$field];
            }

            if ($value instanceof Carbon) {
                $value = $value->toIso8601String();
            }

            $document[$field] = $value;
        }

        return $document;
    }
}
