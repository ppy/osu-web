<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Exceptions\InvariantException;
use App\Jobs\EsDocument;
use App\Libraries\Transactions\AfterCommit;
use App\Traits\Memoizes;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $approved
 * @property-read Collection<BeatmapDiscussion> $beatmapDiscussions
 * @property-read Collection<BeatmapOwner> $beatmapOwners
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
 * @property-read Collection<BeatmapDifficulty> $difficulty
 * @property-read Collection<BeatmapDifficultyAttrib> $difficultyAttribs
 * @property float $difficultyrating
 * @property-read Collection<BeatmapFailtimes> $failtimes
 * @property string|null $filename
 * @property int $hit_length
 * @property \Carbon\Carbon $last_update
 * @property int $max_combo
 * @property mixed $mode
 * @property-read Collection<User> $owners
 * @property int $passcount
 * @property int $playcount
 * @property int $playmode
 * @property int $score_version
 * @property int $total_length
 * @property User $user
 * @property int $user_id
 * @property string $version
 * @property string|null $youtube_preview
 */
class Beatmap extends Model implements AfterCommit
{
    use Memoizes, SoftDeletes;

    public $convert = false;

    protected $table = 'osu_beatmaps';
    protected $primaryKey = 'beatmap_id';

    protected $casts = [
        'last_update' => 'datetime',
    ];

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

    public function beatmapOwners()
    {
        return $this->hasMany(BeatmapOwner::class);
    }

    public function beatmapset()
    {
        return $this->belongsTo(Beatmapset::class, 'beatmapset_id')->withTrashed();
    }

    public function beatmapDiscussions()
    {
        return $this->hasMany(BeatmapDiscussion::class);
    }

    public function beatmapTags()
    {
        return $this->hasMany(BeatmapTag::class);
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
        $valueQuery = BeatmapDifficultyAttrib
            ::select('value')
            ->whereColumn([
                'beatmap_id' => $this->qualifyColumn('beatmap_id'),
                'mode' => $this->qualifyColumn('playmode'),
            ])
            ->where([
                'attrib_id' => BeatmapDifficultyAttrib::MAX_COMBO,
                'mods' => BeatmapDifficultyAttrib::NO_MODS,
            ]);

        return $query->addSelect(['attrib_max_combo' => $valueQuery]);
    }

    public function scopeWithUserPlaycount(Builder $query, ?int $userId): Builder
    {
        if ($userId === null) {
            $countQuery = \DB::query()->selectRaw('null');
        } else {
            $countQuery = BeatmapPlaycount
                ::where('user_id', $userId)
                ->whereColumn('beatmap_id', $this->qualifyColumn('beatmap_id'))
                ->select('playcount');
        }

        return $query->addSelect(['user_playcount' => $countQuery]);
    }

    public function scopeWithUserTagIds($query, ?int $userId)
    {
        if ($userId === null) {
            $tagQuery = \DB::query()->selectRaw('null');
        } else {
            $tagQuery = BeatmapTag
                ::where('user_id', $userId)
                ->whereColumn('beatmap_id', $this->qualifyColumn('beatmap_id'));
            $tagQuery->selectRaw("json_arrayagg({$tagQuery->qualifyColumn('tag_id')})");
        }

        return $query->addSelect(['user_tag_ids' => $tagQuery]);
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

    public function afterCommit()
    {
        $beatmapset = $this->beatmapset;

        if ($beatmapset !== null) {
            dispatch(new EsDocument($beatmapset));
        }
    }

    public function isScoreable()
    {
        return $this->approved > 0;
    }

    public function canBeConvertedTo(int $rulesetId)
    {
        return $this->playmode === static::MODES['osu'] || $this->playmode === $rulesetId;
    }

    public function expireTopTagIds()
    {
        \Cache::delete("beatmap_top_tag_ids:{$this->getKey()}");
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
            'max_combo',
            'passcount',
            'playcount',
            'playmode',
            'score_version',
            'total_length',
            'user_id',
            'youtube_preview' => $this->getRawAttribute($key),

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
            'beatmapOwners',
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

    public function getUserPlaycount(): int
    {
        if (!array_key_exists('user_playcount', $this->attributes)) {
            throw new \Exception('withUserPlaycount scope is required');
        }

        return $this->attributes['user_playcount'] ?? 0;
    }

    /**
     * Requires calling withUserTagIds scope to populate user_tag_ids
     *
     * @return int[]
     */
    public function getUserTagIds(): array
    {
        return json_decode($this->attributes['user_tag_ids'] ?? '', true) ?? [];
    }

    /**
     * @return Collection<User>
     */
    public function getOwners(): Collection
    {
        $owners = $this->beatmapOwners->loadMissing('user')->map(
            fn ($beatmapOwner) => $beatmapOwner->user ?? new DeletedUser(['user_id' => $beatmapOwner->user_id])
        );

        // TODO: remove when everything writes to beatmap_owners.
        if (!$owners->contains(fn ($beatmapOwner) => $beatmapOwner->user_id === $this->user_id)) {
            $owners->prepend($this->user ?? new DeletedUser(['user_id' => $this->user_id]));
        }

        return $owners;
    }

    public function isOwner(User $user): bool
    {
        if ($this->user_id === $user->getKey()) {
            return true;
        }

        return $this->relationLoaded('beatmapOwners')
            ? $this->beatmapOwners->contains('user_id', $user->getKey())
            : $this->beatmapOwners()->where('user_id', $user->getKey())->exists();
    }

    public function maxCombo()
    {
        if (!$this->convert) {
            $rowMaxCombo = $this->max_combo;

            if ($rowMaxCombo > 0) {
                return $rowMaxCombo;
            }
            if (array_key_exists('attrib_max_combo', $this->attributes)) {
                return $this->attributes['attrib_max_combo'];
            }
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

    public function status()
    {
        return array_search($this->approved, Beatmapset::STATES, true);
    }

    public function topTagIds()
    {
        // TODO: Add option to multi query when beatmapset requests all tags for beatmaps?
        return $this->memoize(
            __FUNCTION__,
            fn () => \Cache::remember(
                "beatmap_top_tag_ids:{$this->getKey()}",
                $GLOBALS['cfg']['osu']['tags']['beatmap_tags_cache_duration'],
                fn () => $this->beatmapTags()->topTagIds()->limit(50)->get()->toArray(),
            ),
        );
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
                    return \Number::clamp($accuracy + 1, 4, 7);
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
