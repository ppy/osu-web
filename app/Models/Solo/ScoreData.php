<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Solo;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use JsonSerializable;

class ScoreData implements Castable, JsonSerializable
{
    public ScoreDataStatistics $maximumStatistics;
    public array $mods;
    public ScoreDataStatistics $statistics;

    public function __construct(array $data)
    {
        $mods = [];
        foreach ($data['mods'] ?? [] as $mod) {
            // TODO: create proper Mod object
            $mod = (array) $mod;
            if (is_array($mod) && isset($mod['acronym'])) {
                $settings = $mod['settings'] ?? null;
                if (is_object($settings) && !empty((array) $settings)) {
                    // already in expected format; do nothing
                } elseif (is_array($settings) && !empty($settings)) {
                    $mod['settings'] = (object) $mod['settings'];
                } else {
                    unset($mod['settings']);
                }
                $mods[] = (object) $mod;
            }
        }

        $this->maximumStatistics = new ScoreDataStatistics($data['maximum_statistics'] ?? []);
        $this->mods = $mods;
        $this->statistics = new ScoreDataStatistics($data['statistics'] ?? []);
    }

    public static function castUsing(array $arguments)
    {
        return new class implements CastsAttributes
        {
            public function get($model, $key, $value, $attributes)
            {
                return new ScoreData(json_decode($value, true));
            }

            public function set($model, $key, $value, $attributes)
            {
                if (!($value instanceof ScoreData)) {
                    $value = new ScoreData($value);
                }

                return ['data' => json_encode($value)];
            }
        };
    }

    public function jsonSerialize(): array
    {
        return [
            'maximum_statistics' => $this->maximumStatistics,
            'mods' => $this->mods,
            'statistics' => $this->statistics,
        ];
    }
}
