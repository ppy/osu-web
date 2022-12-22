<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Exceptions\InvariantException;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $approved
 * @property \Illuminate\Database\Eloquent\Collection $beatmapDiscussions BeatmapDiscussion
 * @property int $beatmap_id
 * @property Beatmapset $beatmapset
 * @property int|null $beatmapset_id
 * @property float $bpm
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
 * @property int $score_version
 * @property int $total_length
 * @property int $user_id
 * @property string $version
 * @property string|null $youtube_preview
 */
class Beatmap extends Model
{
    use SoftDeletes;

    public $convert = false;

    protected $table = 'osu_beatmaps';
    protected $primaryKey = 'beatmap_id';

    protected $casts = [
        'orphaned' => 'boolean',
    ];

    protected $dates = ['last_update'];
    public $timestamps = false;

    const MODES = [
        'osu' => 0,
        'taiko' => 1,
        'fruits' => 2,
        'mania' => 3,
    ];

    const VARIANTS = [
        'mania' => ['4k', '7k'],
    ];

    public static function isModeValid(?string $mode)
    {
        return array_key_exists($mode, static::MODES);
    }

    public static function isVariantValid(?string $mode, ?string $variant)
    {
        return $variant === null || in_array($variant, static::VARIANTS[$mode] ?? [], true);
    }

    public static function modeInt($str): ?int
    {
        return static::MODES[$str] ?? null;
    }

    public static function modeStr($int): ?string
    {
        static $lookupMap;

        $lookupMap ??= array_flip(static::MODES);

        return $lookupMap[$int] ?? null;
    }

    public function baseDifficultyRatings()
    {
        return $this->difficulty()->where('mods', 0);
    }

    public function baseMaxCombo()
    {
        return $this->difficultyAttribs()->noMods()->maxCombo();
    }

    public function beatmapset()
    {
        return $this->belongsTo(Beatmapset::class, 'beatmapset_id')->withTrashed();
    }

    public function beatmapDiscussions()
    {
        return $this->hasMany(BeatmapDiscussion::class);
    }

    public function difficulty()
    {
        return $this->hasMany(BeatmapDifficulty::class);
    }

    public function difficultyAttribs()
    {
        return $this->hasMany(BeatmapDifficultyAttrib::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeDefault($query)
    {
        return $query
            ->orderBy('playmode', 'ASC')
            ->orderBy('difficultyrating', 'ASC');
    }

    public function scopeIncreasesStatistics(Builder $query): Builder
    {
        return $query->whereHas('beatmapset', fn ($q) => $q->withTrashed(false));
    }

    public function scopeScoreable($query)
    {
        return $query->where('approved', '>', 0);
    }

    public function scopeWithMaxCombo($query)
    {
        $mods = BeatmapDifficultyAttrib::NO_MODS;
        $attrib = BeatmapDifficultyAttrib::MAX_COMBO;
        $attribTable = (new BeatmapDifficultyAttrib())->tableName();
        $mode = $this->qualifyColumn('playmode');
        $id = $this->qualifyColumn('beatmap_id');

        return $query
            ->select(DB::raw("*, (
                SELECT value
                FROM {$attribTable}
                WHERE beatmap_id = {$id}
                    AND mode = {$mode}
                    AND mods = {$mods}
                    AND attrib_id = {$attrib}
            ) AS max_combo"));
    }

    public function failtimes()
    {
        return $this->hasMany(BeatmapFailtimes::class);
    }

    public function scores($mode = null)
    {
        return $this->getScores(Score::class, $mode);
    }

    public function scoresBest($mode = null)
    {
        return $this->getScores(Score\Best::class, $mode);
    }

    public function scoresBestOsu()
    {
        return $this->hasMany(Score\Best\Osu::class);
    }

    public function scoresBestTaiko()
    {
        return $this->hasMany(Score\Best\Taiko::class);
    }

    public function scoresBestFruits()
    {
        return $this->hasMany(Score\Best\Fruits::class);
    }

    public function scoresBestMania()
    {
        return $this->hasMany(Score\Best\Mania::class);
    }

    public function isScoreable()
    {
        return $this->approved > 0;
    }

    public function canBeConverted()
    {
        return $this->playmode === static::MODES['osu'];
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'approved',
            'beatmap_id',
            'beatmapset_id',
            'bpm',
            'checksum',
            'countNormal',
            'countSlider',
            'countSpinner',
            'countTotal',
            'diff_approach',
            'diff_drain',
            'diff_overall',
            'filename',
            'hit_length',
            'passcount',
            'playcount',
            'playmode',
            'score_version',
            'total_length',
            'user_id',
            'youtube_preview' => $this->getRawAttribute($key),

            'orphaned' => (bool) $this->getRawAttribute($key),

            'deleted_at',
            'last_update' => $this->getTimeFast($key),

            'deleted_at_json',
            'last_update_json' => $this->getJsonTimeFast($key),

            'diff_size' => $this->getDiffSize(),
            'difficultyrating' => $this->getDifficultyrating(),
            'mode' => $this->getMode(),
            'version' => $this->getVersion(),

            'baseDifficultyRatings',
            'baseMaxCombo',
            'beatmapDiscussions',
            'beatmapset',
            'difficulty',
            'difficultyAttribs',
            'failtimes',
            'scoresBestFruits',
            'scoresBestMania',
            'scoresBestOsu',
            'scoresBestTaiko',
            'user' => $this->getRelationValue($key),
        };
    }

    public function maxCombo()
    {
        if (!$this->convert && array_key_exists('max_combo', $this->attributes)) {
            return $this->attributes['max_combo'];
        }

        if ($this->relationLoaded('baseMaxCombo')) {
            $maxCombo = $this->baseMaxCombo->firstWhere('mode', $this->playmode);
        } else {
            $maxCombo = $this->difficultyAttribs()
                ->mode($this->playmode)
                ->noMods()
                ->maxCombo()
                ->first();
        }

        return $maxCombo?->value;
    }

    public function setOwner($newUserId)
    {
        if ($newUserId === null) {
            throw new InvariantException('user_id must be specified');
        }

        if (User::find($newUserId) === null) {
            throw new InvariantException('invalid user_id');
        }

        if ($newUserId === $this->user_id) {
            throw new InvariantException('the specified user_id is already the owner');
        }

        $this->fill(['user_id' => $newUserId])->saveOrExplode();
    }

    public function status()
    {
        return array_search($this->approved, Beatmapset::STATES, true);
    }

    private function getDifficultyrating()
    {
        if ($this->convert) {
            $value = (
                $this->relationLoaded('baseDifficultyRatings')
                    ? $this->baseDifficultyRatings
                    : $this->baseDifficultyRatings()
            )->firstWhere('mode', $this->playmode)
            ?->diff_unified ?? 0;
        } else {
            $value = $this->getRawAttribute('difficultyrating');
        }

        return round($value, 2);
    }

    private function getDiffSize()
    {
        /*
         * Matches client implementation.
         * all round()s here use PHP_ROUND_HALF_EVEN to match C# default Math.Round.
         * References:
         * - (implementation) https://github.com/ppy/osu/blob/6bbc23c831cd73bf126b31edb0bb4fa729f947d1/osu.Game.Rulesets.Mania/Beatmaps/ManiaBeatmapConverter.cs#L40
         * - (rounding) https://msdn.microsoft.com/en-us/library/wyk4d9cy(v=vs.110).aspx
         */
        $value = $this->getRawAttribute('diff_size');
        if ($this->playmode === static::MODES['mania']) {
            $roundedValue = (int) round($value, 0, PHP_ROUND_HALF_EVEN);

            if ($this->convert) {
                $sliderOrSpinner = ($this->countSlider ?? 0) + ($this->countSpinner ?? 0);
                $total = max(1, $sliderOrSpinner + ($this->countNormal ?? 0));
                $percentSliderOrSpinner = $sliderOrSpinner / $total;

                $accuracy = (int) round($this->diff_overall ?? 0, 0, PHP_ROUND_HALF_EVEN);

                if ($percentSliderOrSpinner < 0.2) {
                    return 7;
                } elseif ($percentSliderOrSpinner < 0.3 || $roundedValue >= 5) {
                    return $accuracy > 5 ? 7 : 6;
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

    private function getMode()
    {
        return static::modeStr($this->playmode);
    }

    private function getScores($modelPath, $mode)
    {
        $mode ?? ($mode = $this->mode);

        if (!static::isModeValid($mode)) {
            throw new InvariantException(osu_trans('errors.beatmaps.invalid_mode'));
        }

        if ($this->mode !== 'osu' && $this->mode !== $mode) {
            throw new InvariantException(osu_trans('errors.beatmaps.standard_converts_only'));
        }

        $mode = studly_case($mode);

        return $this->hasMany("{$modelPath}\\{$mode}");
    }

    private function getVersion()
    {
        $value = $this->getRawAttribute('version');
        if ($this->mode === 'mania') {
            $keys = $this->getDiffSize();

            if (strpos($value, "{$keys}k") === false && strpos($value, "{$keys}K") === false) {
                return "[{$keys}K] {$value}";
            }
        }

        return $value;
    }
}
