<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\LegacyScoreFirst;

use App\Models\Beatmap;
use App\Models\Model as BaseModel;
use App\Models\Solo\Score;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

abstract class Model extends BaseModel
{
    protected static int $rulesetId;

    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = 'beatmap_id';

    public function scopeDefault(Builder $query): Builder
    {
        return $query->whereHas('beatmap.beatmapset')->whereHas('score');
    }

    public function beatmap(): BelongsTo
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id');
    }

    public function score(): BelongsTo
    {
        return $this->belongsTo(Score::class, 'score_id', 'legacy_score_id')->where('ruleset_id', static::$rulesetId);
    }
}
