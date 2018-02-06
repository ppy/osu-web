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

trait BeatmapsetTrait
{
    use EsIndexable;

    public function toEsJson()
    {
        return array_merge(
            $this->esBeatmapsetValues(),
            ['difficulties' => $this->esBeatmapValues()]
        );
    }

    public static function esIndexName()
    {
        return config('osu.elasticsearch.prefix').'beatmaps';
    }

    public static function esIndexingQuery()
    {
        return static::on('mysql-readonly')
            ->withoutGlobalScopes()
            ->active()
            ->with('beatmaps'); // note that the with query will run with the default scopes.
    }

    public static function esMappings()
    {
        return array_merge(
            static::ES_MAPPINGS_BEATMAPSETS,
            ['difficulties' => ['properties' => static::ES_MAPPINGS_BEATMAPS]]
        );
    }

    public static function esType()
    {
        return 'beatmaps';
    }

    private function esBeatmapsetValues()
    {
        $mappings = static::ES_MAPPINGS_BEATMAPSETS;

        $values = [];
        foreach ($mappings as $field => $mapping) {
            $value = $this[$field];
            if ($value instanceof Carbon) {
                $value = $value->toIso8601String();
            }

            $values[$field] = $value;
        }

        return $values;
    }

    private function esBeatmapValues()
    {
        $mappings = static::ES_MAPPINGS_BEATMAPS;

        $values = [];
        // initialize everything to an array.
        foreach ($mappings as $field => $mapping) {
            $values[$field] = [];
        }

        foreach ($this->beatmaps as $beatmap) {
            foreach ($mappings as $field => $mapping) {
                $values[$field][] = $beatmap[$field];
            }
        }

        return $values;
    }
}
