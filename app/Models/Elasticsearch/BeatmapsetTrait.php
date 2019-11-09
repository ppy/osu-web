<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Models\Elasticsearch;

use App\Models\Beatmap;
use App\Traits\EsIndexable;
use Carbon\Carbon;

trait BeatmapsetTrait
{
    use EsIndexable;

    public function toEsJson()
    {
        return array_merge(
            $this->esBeatmapsetValues(),
            ['beatmaps' => $this->esBeatmapsValues()],
            ['difficulties' => $this->esDifficultiesValues()]
        );
    }

    public function esShouldIndex()
    {
        return !$this->trashed();
    }

    public static function esIndexName()
    {
        return config('osu.elasticsearch.prefix').'beatmaps';
    }

    public static function esIndexingQuery()
    {
        return static::on('mysql')
            ->withoutGlobalScopes()
            ->active()
            ->with('beatmaps') // note that the with query will run with the default scopes.
            ->with(['beatmaps.difficulty' => function ($query) {
                $query->where('mods', 0);
            }]);
    }

    public static function esSchemaFile()
    {
        return config_path('schemas/beatmaps.json');
    }

    public static function esType()
    {
        return 'beatmaps';
    }

    private function esBeatmapsetValues()
    {
        $mappings = static::esMappings();

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

    private function esBeatmapsValues()
    {
        $mappings = static::esMappings()['beatmaps']['properties'];

        $values = [];
        foreach ($this->beatmaps as $beatmap) {
            $beatmapValues = [];
            foreach ($mappings as $field => $mapping) {
                $beatmapValues[$field] = $beatmap[$field];
            }

            $beatmapValues['convert'] = false;
            $values[] = $beatmapValues;

            if ($beatmap->playmode === Beatmap::MODES['osu']) {
                foreach (Beatmap::MODES as $modeInt) {
                    if ($modeInt === Beatmap::MODES['osu']) {
                        continue;
                    }

                    $diff = $beatmap->difficulty->where('mode', $modeInt)->where('mods', 0)->first();
                    $convertValues = $beatmapValues; // is an array, so automatically a copy.
                    $convertValues['convert'] = true;
                    $convertValues['difficultyrating'] = $diff !== null ? $diff->diff_unified : $beatmap->difficultyrating;
                    $convertValues['playmode'] = $modeInt;

                    $values[] = $convertValues;
                }
            }
        }

        return $values;
    }

    private function esDifficultiesValues()
    {
        $mappings = static::esMappings()['difficulties']['properties'];

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
