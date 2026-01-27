<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Score;

use App\Exceptions\ClassNotFoundException;
use App\Models\Beatmap;
use App\Models\Model as BaseModel;
use App\Models\Traits\Scoreable;
use App\Models\User;

/**
 * @property Beatmap $beatmap
 * @property User $user
 */
abstract class Model extends BaseModel
{
    use Scoreable;

    public $timestamps = false;

    protected $casts = [
        'date' => 'datetime',
        'pass' => 'bool',
        'perfect' => 'bool',
        'replay' => 'bool', // for best model
    ];
    protected $primaryKey = 'score_id';

    public static function getClass(string $ruleset): string
    {
        if (!Beatmap::isModeValid($ruleset)) {
            throw new ClassNotFoundException();
        }

        return get_class_namespace(static::class).'\\'.studly_case($ruleset);
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'beatmap_id',
            'beatmapset_id',
            'count100',
            'count300',
            'count50',
            'countgeki',
            'countkatu',
            'countmiss',
            'high_score_id',
            'maxcombo',
            'rank',
            'score',
            'score_id',
            'scorechecksum',
            'user_id' => $this->getRawAttribute($key),

            'hidden',
            'pass',
            'perfect' => (bool) $this->getRawAttribute($key),

            'date' => $this->getTimeFast($key),

            'date_json' => $this->getJsonTimeFast($key),

            'enabled_mods' => $this->getEnabledModsAttribute($this->getRawAttribute('enabled_mods')),

            'best_id' => $this->getRawAttribute('high_score_id'),
            'replay' => $this->best?->replay,
            'pp' => $this->best?->pp,

            'beatmap',
            'best',
            'user' => $this->getRelationValue($key),
        };
    }

    public function getMode(): string
    {
        return snake_case(get_class_basename(static::class));
    }
}
