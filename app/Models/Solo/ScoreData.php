<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Solo;

use App\Exceptions\InvariantException;
use App\Libraries\ScoreRank;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use JsonSerializable;

class ScoreData implements Castable, JsonSerializable
{
    public float $accuracy;
    public int $beatmapId;
    public ?int $buildId;
    public Carbon $endedAt;
    public ?int $legacyScoreId;
    public int $maxCombo;
    public ScoreDataStatistics $maximumStatistics;
    public array $mods;
    public bool $passed;
    public string $rank;
    public int $rulesetId;
    public ?Carbon $startedAt;
    public ScoreDataStatistics $statistics;
    public int $totalScore;
    public int $userId;

    public function __construct(array $data)
    {
        $mods = [];

        foreach ($data['mods'] ?? [] as $mod) {
            $mod = (array) $mod;
            if (is_array($mod) && isset($mod['acronym'])) {
                if (isset($mod['settings'])) {
                    $mod['settings'] = (object) $mod['settings'];
                }
                $mods[] = (object) $mod;
            }
        }

        $this->accuracy = $data['accuracy'] ?? 0;
        $this->beatmapId = $data['beatmap_id'];
        $this->buildId = $data['build_id'] ?? null;
        $this->endedAt = parse_time_to_carbon($data['ended_at']);
        $this->legacyScoreId = $data['legacy_score_id'] ?? null;
        $this->maxCombo = $data['max_combo'] ?? 0;
        $this->maximumStatistics = new ScoreDataStatistics($data['maximum_statistics'] ?? []);
        // TODO: create a proper Mod object
        $this->mods = $mods;
        $this->passed = $data['passed'] ?? false;
        $this->rank = $data['rank'] ?? 'F';
        $this->rulesetId = $data['ruleset_id'];
        $this->startedAt = parse_time_to_carbon($data['started_at'] ?? null);
        $this->statistics = new ScoreDataStatistics($data['statistics'] ?? []);
        $this->totalScore = $data['total_score'] ?? 0;
        $this->userId = $data['user_id'];
    }

    public static function castUsing(array $arguments)
    {
        return new class implements CastsAttributes
        {
            public function get($model, $key, $value, $attributes)
            {
                $dataJson = json_decode($value, true);
                $dataJson['beatmap_id'] ??= $attributes['beatmap_id'];
                $dataJson['ended_at'] ??= $attributes['created_at'];
                $dataJson['ruleset_id'] ??= $attributes['ruleset_id'];
                $dataJson['user_id'] ??= $attributes['user_id'];

                return new ScoreData($dataJson);
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

    public function assertCompleted(): void
    {
        if (!ScoreRank::isValid($this->rank)) {
            throw new InvariantException("'{$this->rank}' is not a valid rank.");
        }

        foreach (['totalScore', 'accuracy', 'maxCombo', 'passed'] as $field) {
            if (!present($this->$field)) {
                throw new InvariantException("field missing: '{$field}'");
            }
        }

        if ($this->statistics->isEmpty()) {
            throw new InvariantException("field cannot be empty: 'statistics'");
        }
    }

    public function jsonSerialize(): array
    {
        return [
            'accuracy' => $this->accuracy,
            'beatmap_id' => $this->beatmapId,
            'build_id' => $this->buildId,
            'ended_at' => json_time($this->endedAt),
            'legacy_score_id' => $this->legacyScoreId,
            'max_combo' => $this->maxCombo,
            'maximum_statistics' => $this->maximumStatistics,
            'mods' => $this->mods,
            'passed' => $this->passed,
            'rank' => $this->rank,
            'ruleset_id' => $this->rulesetId,
            'started_at' => json_time($this->startedAt),
            'statistics' => $this->statistics,
            'total_score' => $this->totalScore,
            'user_id' => $this->userId,
        ];
    }
}
