<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\UserStatistics;

abstract class VariantModel extends Model
{
    // placeholder as the table is missing some columns
    public float $accuracy;
    public int $accuracy_count;
    public int $accuracy_total;
    public int $count100;
    public int $count300;
    public int $count50;
    public int $countMiss;
    public int $exit_count;
    public int $fail_count;
    public float $level;
    public int $max_combo;
    public int $rank;
    public int $ranked_score;
    public int $replay_popularity;
    public int $total_score;
    public int $total_seconds_played;

    // placeholder setters so they can be assigned using #fill etc
    public function setAccuracyAttribute($value)
    {
        $this->accuracy = $value;
    }

    public function setAccuracyCountAttribute($value)
    {
        $this->accuracy_count = $value;
    }

    public function setAccuracyTotalAttribute($value)
    {
        $this->accuracy_total = $value;
    }

    public function setCount100Attribute($value)
    {
        $this->count100 = $value;
    }

    public function setCount300Attribute($value)
    {
        $this->count300 = $value;
    }

    public function setCount50Attribute($value)
    {
        $this->count50 = $value;
    }

    public function setCountMissAttribute($value)
    {
        $this->countMiss = $value;
    }

    public function setExitCountAttribute($value)
    {
        $this->exit_count = $value;
    }

    public function setFailCountAttribute($value)
    {
        $this->fail_count = $value;
    }

    public function setLevelAttribute($value)
    {
        $this->level = $value;
    }

    public function setMaxComboAttribute($value)
    {
        $this->max_combo = $value;
    }

    public function setRankAttribute($value)
    {
        $this->rank = $value;
    }

    public function setRankedScoreAttribute($value)
    {
        $this->ranked_score = $value;
    }

    public function setReplayPopularityAttribute($value)
    {
        $this->replay_popularity = $value;
    }

    public function setTotalScoreAttribute($value)
    {
        $this->total_score = $value;
    }

    public function setTotalSecondsPlayedAttribute($value)
    {
        $this->total_seconds_played = $value;
    }
}
