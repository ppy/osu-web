<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Traits\Es;

use App\Models\Beatmap;

trait BeatmapsetSearch
{
    use BaseDbIndexable;

    public static function esIndexName()
    {
        return $GLOBALS['cfg']['osu']['elasticsearch']['prefix'].'beatmaps';
    }

    public static function esIndexingQuery()
    {
        return static::withoutGlobalScopes()
            ->active()
            ->with('beatmaps') // note that the with query will run with the default scopes.
            ->with(['beatmaps.beatmapTags' => fn ($q) => $q->default()])
            ->with('beatmaps.beatmapOwners')
            ->with('beatmaps.baseDifficultyRatings');
    }

    public static function esSchemaFile()
    {
        return config_path('schemas/beatmapsets.json');
    }

    private static function esBeatmapTags(Beatmap $beatmap): array
    {
        $tags = app('tags');

        return array_reject_null(
            array_map(
                fn ($tagId) => $tags->get($tagId['tag_id'])?->name,
                $beatmap->slowTopTagIds()
            )
        );
    }

    public function esShouldIndex()
    {
        return !$this->trashed() && !present($this->download_disabled_url);
    }

    protected function getEsFieldValue(string $field)
    {
        return match ($field) {
            'beatmaps' => $this->esBeatmapsValues(),
            'difficulties' => $this->esDifficultiesValues(),
            'id' => $this->getKey(),
            default => $this->$field,
        };
    }

    private function esBeatmapsValues()
    {
        $mappings = static::esMappings()['beatmaps']['properties'];

        $values = [];
        foreach ($this->beatmaps as $beatmap) {
            $beatmapValues = [];
            foreach ($mappings as $field => $mapping) {
                $topTags = $this->esBeatmapTags($beatmap);
                $value = match ($field) {
                    'top_tags' => $topTags,
                    // TODO: remove adding $beatmap->user_id once everything else also populated beatmap_owners by default.
                    // Duplicate user_id in the array should be fine for now since the field isn't scored for querying.
                    'user_id' => $beatmap->beatmapOwners->pluck('user_id')->add($beatmap->user_id),
                    default => $beatmap->$field,
                };

                $beatmapValues[$field] = $value;
            }

            $values[] = $beatmapValues;

            if ($beatmap->playmode === Beatmap::MODES['osu']) {
                foreach (Beatmap::MODES as $modeInt) {
                    if ($modeInt === Beatmap::MODES['osu']) {
                        continue;
                    }

                    $convert = clone $beatmap;
                    $convert->playmode = $modeInt;
                    $convert->convert = true;
                    $convertValues = [];
                    foreach ($mappings as $field => $_mapping) {
                        $convertValues[$field] = match ($field) {
                            // just add a copy for converts too.
                            'top_tags',
                            'user_id' => $beatmapValues[$field],

                            default => $convert->$field,
                        };
                    }

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
