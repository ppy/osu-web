<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Elasticsearch;

use App\Models\Beatmap;
use App\Traits\EsIndexableModel;
use Carbon\Carbon;

trait BeatmapsetTrait
{
    use EsIndexableModel;

    public static function esIndexName()
    {
        return config('osu.elasticsearch.prefix').'beatmaps';
    }

    public static function esIndexingQuery()
    {
        return static::withoutGlobalScopes()
            ->active()
            ->with('beatmaps') // note that the with query will run with the default scopes.
            ->with('beatmaps.baseDifficultyRatings');
    }

    public static function esSchemaFile()
    {
        return config_path('schemas/beatmaps.json');
    }

    public function esShouldIndex()
    {
        return !$this->trashed() && !present($this->download_disabled_url);
    }

    public function toEsJson()
    {
        return array_merge(
            $this->esBeatmapsetValues(),
            ['beatmaps' => $this->esBeatmapsValues()],
            ['difficulties' => $this->esDifficultiesValues()]
        );
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

                    $diff = $beatmap->baseDifficultyRatings?->firstWhere('mode', $modeInt);
                    $convertValues = $beatmapValues; // is an array, so automatically a copy.
                    $convertValues['convert'] = true;
                    $convertValues['difficultyrating'] = $diff?->diff_unified ?? $beatmap->difficultyrating;
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
