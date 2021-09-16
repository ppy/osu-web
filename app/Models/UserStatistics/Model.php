<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\UserStatistics;

use App\Exceptions\ClassNotFoundException;
use App\Models\Beatmap;
use App\Models\Model as BaseModel;
use App\Models\Score\Best;
use App\Models\User;
use App\Traits\Memoizes;

/**
 * @property mixed $country_acronym
 * @property User $user
 */
abstract class Model extends BaseModel
{
    use Memoizes;

    protected $primaryKey = 'user_id';

    public $timestamps = false;
    public $incrementing = false;

    const UPDATED_AT = 'last_update';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function setCreatedAt($value)
    {
        // Do nothing.
    }

    public function getCreatedAtColumn()
    {
        // Do nothing.
    }

    public function getCountryAcronymAttribute($value)
    {
        return presence($value);
    }

    public function getHitAccuracyAttribute($value)
    {
        return $this->accuracy_new ?? round($this->accuracy * 100, 2);
    }

    public function currentLevelProgress()
    {
        return fmod($this->level, 1);
    }

    public function currentLevelProgressPercent()
    {
        return floor($this->currentLevelProgress() * 100);
    }

    public function currentLevel()
    {
        return intval($this->level);
    }

    public function totalHits()
    {
        return $this->count300 + $this->count100 + $this->count50;
    }

    public static function calculateRecommendedStarDifficulty(?self $stats)
    {
        if ($stats !== null && $stats->rank_score > 0) {
            return pow($stats->rank_score, 0.4) * 0.195;
        }

        return 1.0;
    }

    public static function getClass($modeStr, $variant = null)
    {
        if (!Beatmap::isModeValid($modeStr)) {
            throw new ClassNotFoundException();
        }

        if (!Beatmap::isVariantValid($modeStr, $variant)) {
            throw new ClassNotFoundException();
        }

        $variant = $variant === null ? '' : "_{$variant}";

        return get_class_namespace(static::class).'\\'.studly_case("{$modeStr}{$variant}");
    }

    public static function getMode(): string
    {
        return snake_case(get_class_basename(static::class));
    }

    public static function recalculateRankedScoreForUser(User $user)
    {
        $bestClass = Best\Model::getClassByString(static::getMode());

        $instance = new static();
        $statsTable = $instance->getTable();
        $bestTable = (new $bestClass())->getTable();

        $instance->getConnection()->update(
            "UPDATE {$statsTable} SET accuracy_count = 0, accuracy_total = 0, ranked_score = (SELECT COALESCE(SUM(score), 0) FROM (SELECT MAX(score) AS score FROM {$bestTable} WHERE user_id = {$user->getKey()} GROUP BY beatmap_id) s) WHERE user_id = {$user->getKey()}"
        );
    }

    public function __construct($attributes = [], $zeroInsteadOfNull = true)
    {
        if ($zeroInsteadOfNull) {
            $this->level = 1;

            $this->rank_score_index = 0;
            $this->ranked_score = 0;

            $this->accuracy_new = 0;
            $this->playcount = 0;
            $this->total_score = 0;
            $this->max_combo = 0;

            $this->count300 = 0;
            $this->count100 = 0;
            $this->count50 = 0;

            $this->replay_popularity = 0;

            $this->x_rank_count = 0;
            $this->xh_rank_count = 0;
            $this->s_rank_count = 0;
            $this->sh_rank_count = 0;
            $this->a_rank_count = 0;

            $this->accuracy_total = 0;
            $this->accuracy_count = 0;
            $this->accuracy = 0;
            $this->rank = 0;
            $this->rank_score = 0;
        }

        return parent::__construct($attributes);
    }

    public function countryRank()
    {
        return $this->memoize(__FUNCTION__, function () {
            if (!$this->isRanked()) {
                return;
            }

            if ($this->country_acronym === null) {
                return;
            }

            // Using $this->rank_score isn't accurate because it's a float value.
            // Hence the raw sql query.
            // There's this alternative
            //   rank_score_index < $this->rank_score_index AND rank_score_index > 0 AND rank_score > 0
            // but it is slower.
            return static::where('country_acronym', $this->country_acronym)
                ->where('rank_score', '>', function ($q) {
                    $q->from($this->table)->where('user_id', $this->user_id)->select('rank_score');
                })
                ->count() + 1;
        });
    }

    public function globalRank()
    {
        if (!$this->isRanked()) {
            return;
        }

        return $this->rank_score_index;
    }

    public function isRanked()
    {
        return $this->rank_score !== 0.0 && $this->rank_score_index !== 0;
    }

    public function scopeFriendsOf($query, $user)
    {
        $userIds = $user->friends()->allRelatedIds();
        $userIds[] = $user->getKey();

        return $query->whereIn('user_id', $userIds);
    }
}
