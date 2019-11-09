<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Models;

use App\Exceptions\ScoreRetrievalException;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $approved
 * @property \Illuminate\Database\Eloquent\Collection $beatmapDiscussions BeatmapDiscussion
 * @property int $beatmap_id
 * @property Beatmapset $beatmapset
 * @property int|null $beatmapset_id
 * @property string|null $checksum
 * @property int $countNormal
 * @property int $countSlider
 * @property int $countSpinner
 * @property int $countTotal
 * @property \Carbon\Carbon|null $deleted_at
 * @property float $diff_approach
 * @property float $diff_drain
 * @property float $diff_overall
 * @property float $diff_size
 * @property \Illuminate\Database\Eloquent\Collection $difficulty BeatmapDifficulty
 * @property \Illuminate\Database\Eloquent\Collection $difficultyAttribs BeatmapDifficultyAttrib
 * @property float $difficultyrating
 * @property \Illuminate\Database\Eloquent\Collection $failtimes BeatmapFailtimes
 * @property string|null $filename
 * @property int $hit_length
 * @property \Carbon\Carbon $last_update
 * @property mixed $mode
 * @property bool $orphaned
 * @property int $passcount
 * @property int $playcount
 * @property int $playmode
 * @property int $total_length
 * @property int $user_id
 * @property string $version
 * @property string|null $youtube_preview
 */
class Beatmap extends Model
{
    use SoftDeletes;

    protected $table = 'osu_beatmaps';
    protected $primaryKey = 'beatmap_id';

    protected $casts = [
        'orphaned' => 'boolean',
    ];

    protected $dates = ['last_update'];
    public $timestamps = false;

    protected $hidden = ['checksum', 'filename', 'orphaned'];

    const MODES = [
        'osu' => 0,
        'taiko' => 1,
        'fruits' => 2,
        'mania' => 3,
    ];

    public static function isModeValid(?string $mode)
    {
        return array_key_exists($mode, static::MODES);
    }

    public static function modeInt($str)
    {
        return static::MODES[$str] ?? null;
    }

    public static function modeStr($int)
    {
        return array_search_null($int, static::MODES);
    }

    public function beatmapset()
    {
        return $this->belongsTo(Beatmapset::class, 'beatmapset_id')->withTrashed();
    }

    public function beatmapDiscussions()
    {
        return $this->hasMany(BeatmapDiscussion::class, 'beatmap_id');
    }

    public function creator()
    {
        return $this->parent->user();
    }

    public function difficulty()
    {
        return $this->hasMany(BeatmapDifficulty::class, 'beatmap_id');
    }

    public function difficultyAttribs()
    {
        return $this->hasMany(BeatmapDifficultyAttrib::class, 'beatmap_id');
    }

    public function getDifficultyratingAttribute($value)
    {
        return round($value, 2);
    }

    public function getModeAttribute()
    {
        return static::modeStr($this->playmode);
    }

    public function getDiffSizeAttribute($value)
    {
        /*
         * Matches client implementation.
         * all round()s here use PHP_ROUND_HALF_EVEN to match C# default Math.Round.
         * References:
         * - (implmentation) https://github.com/ppy/osu/blob/c9276ce2b8b2eb728b1e5fc74f5f7ef81b0c6e09/osu.Game.Rulesets.Mania/Beatmaps/ManiaBeatmapConverter.cs#L36
         * - (rounding) https://msdn.microsoft.com/en-us/library/wyk4d9cy(v=vs.110).aspx
         */
        if ($this->mode === 'mania') {
            $roundedValue = (int) round($value, 0, PHP_ROUND_HALF_EVEN);

            if ($this->convert) {
                $sliderOrSpinner = $this->countSlider + $this->countSpinner;
                $total = max(1, $sliderOrSpinner + $this->countNormal);
                $percentSliderOrSpinner = $sliderOrSpinner / $total;

                $accuracy = (int) round($this->diff_overall, 0, PHP_ROUND_HALF_EVEN);

                if ($percentSliderOrSpinner < 0.2) {
                    return 7;
                } elseif ($percentSliderOrSpinner < 0.3 || $roundedValue >= 5) {
                    return $accuracy > 5 ? 7 : 5;
                } elseif ($percentSliderOrSpinner > 0.6) {
                    return $accuracy > 4 ? 5 : 4;
                } else {
                    return clamp($accuracy + 1, 4, 7);
                }
            } else {
                return max(1, $roundedValue);
            }
        }

        return $value;
    }

    public function getVersionAttribute($value)
    {
        if ($this->mode === 'mania') {
            $keys = $this->diff_size;

            if (strpos($value, "{$keys}k") === false && strpos($value, "{$keys}K") === false) {
                return "[{$keys}K] {$value}";
            }
        }

        return $value;
    }

    public function scopeDefault($query)
    {
        return $query
            ->orderBy('playmode', 'ASC')
            ->orderBy('difficultyrating', 'ASC');
    }

    public function failtimes()
    {
        return $this->hasMany(BeatmapFailtimes::class, 'beatmap_id');
    }

    private function getScores($modelPath, $mode)
    {
        $mode ?? ($mode = $this->mode);

        if (!static::isModeValid($mode)) {
            throw new ScoreRetrievalException(trans('errors.beatmaps.invalid_mode'));
        }

        if ($this->mode !== 'osu' && $this->mode !== $mode) {
            throw new ScoreRetrievalException(trans('errors.beatmaps.standard_converts_only'));
        }

        $mode = studly_case($mode);

        return $this->hasMany("{$modelPath}\\{$mode}", 'beatmap_id');
    }

    public function scores($mode = null)
    {
        return $this->getScores("App\Models\Score", $mode);
    }

    public function scoresBest($mode = null)
    {
        return $this->getScores("App\Models\Score\Best", $mode);
    }

    public function status()
    {
        return array_search($this->approved, Beatmapset::STATES, true);
    }
}
