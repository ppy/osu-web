<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Score\Best;

use App\Libraries\ReplayFile;
use App\Models\Beatmap;
use App\Models\Country;
use App\Models\ReplayViewCount;
use App\Models\Score\Model as BaseModel;
use App\Models\Traits;
use App\Models\User;

/**
 * @property User $user
 */
abstract class Model extends BaseModel implements Traits\ReportableInterface
{
    use Traits\Reportable, Traits\WithDbCursorHelper, Traits\WithWeightedPp;

    protected array $macros = [
        'forListing',
    ];

    const SORTS = [
        'score_asc' => [
            ['column' => 'score', 'order' => 'ASC'],
            ['column' => 'score_id', 'columnInput' => 'id', 'order' => 'DESC'],
        ],
    ];

    const DEFAULT_SORT = 'score_asc';

    public function getAttribute($key)
    {
        return match ($key) {
            'beatmap_id',
            'count100',
            'count300',
            'count50',
            'countgeki',
            'countkatu',
            'countmiss',
            'country_acronym',
            'maxcombo',
            'pp',
            'rank',
            'score',
            'score_id',
            'user_id' => $this->getRawAttribute($key),

            'hidden',
            'perfect',
            'replay' => (bool) $this->getRawAttribute($key),

            'date' => $this->getTimeFast($key),

            'date_json' => $this->getJsonTimeFast($key),

            'best' => $this,
            'enabled_mods' => $this->getEnabledModsAttribute($this->getRawAttribute('enabled_mods')),
            'pass' => true,

            'best_id' => $this->getKey(),

            'beatmap',
            'replayViewCount',
            'reportedIn',
            'user' => $this->getRelationValue($key),
        };
    }

    public function replayFile(): ?ReplayFile
    {
        return $this->replay ? new ReplayFile($this) : null;
    }

    public function getReplayFile(): ?string
    {
        return $this->replayFile()?->get();
    }

    public function macroForListing(): \Closure
    {
        return function ($query, $limit) {
            $limit = \Number::clamp($limit ?? 50, 1, $GLOBALS['cfg']['osu']['beatmaps']['max_scores']);
            $newQuery = (clone $query)->with('user')->limit($limit + 100);

            $result = [];
            $offset = 0;
            $baseResultCount = 0;
            $finalize = function (array $result) {
                return array_values($result);
            };

            while (true) {
                $baseResult = $newQuery->offset($offset)->get();
                $baseResultCount = count($baseResult);

                if ($baseResultCount === 0) {
                    break;
                }

                $offset += $baseResultCount;

                foreach ($baseResult as $entry) {
                    if (isset($result[$entry->user_id])) {
                        continue;
                    }

                    $result[$entry->user_id] = $entry;

                    if (count($result) >= $limit) {
                        return $finalize($result);
                    }
                }
            }

            return $finalize($result);
        };
    }

    public function url(): string
    {
        return route('scores.show', ['rulesetOrScore' => $this->getMode(), 'score' => $this->getKey()]);
    }

    public function scopeDefault($query)
    {
        return $query
            ->whereHas('beatmap')
            ->orderBy('score', 'DESC')
            ->orderBy('score_id', 'ASC');
    }

    public function scopeVisibleUsers($query)
    {
        return $query->where(['hidden' => false]);
    }

    public function scopeWithType($query, $type, $options)
    {
        switch ($type) {
            case 'country':
                $countryAcronym = $options['countryAcronym'] ?? $options['user']->country_acronym ?? Country::UNKNOWN;

                return $query->fromCountry($countryAcronym);
            case 'friend':
                return $query->friendsOf($options['user']);
        }
    }

    public function scopeFromCountry($query, $countryAcronym)
    {
        return $query->where('country_acronym', $countryAcronym);
    }

    public function scopeFriendsOf($query, $user)
    {
        if ($user === null) {
            $userIds = [];
        } else {
            $userIds = $user->friends()->allRelatedIds();
            $userIds[] = $user->getKey();
        }

        return $query->whereIn('user_id', $userIds);
    }

    public function replayViewCount()
    {
        $class = ReplayViewCount::class.'\\'.get_class_basename(static::class);

        return $this->hasOne($class, 'score_id');
    }

    public function trashed()
    {
        return $this->getAttribute('hidden');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * This doesn't delete the score in elasticsearch.
     */
    public function delete()
    {
        $result = $this->getConnection()->transaction(function () {
            $this->replayViewCount?->delete();

            return parent::delete();
        });

        $this->replayFile()?->delete();

        return $result;
    }

    protected function newReportableExtraParams(): array
    {
        return [
            'mode' => Beatmap::modeInt($this->getMode()),
            'reason' => 'Cheating',
            'score_id' => $this->getKey(),
            'user_id' => $this->user_id,
        ];
    }
}
