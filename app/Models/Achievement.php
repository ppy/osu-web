<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property int $achievement_id
 * @property string|null $description
 * @property bool $enabled
 * @property string $grouping
 * @property string|null $image
 * @property int|null $mode
 * @property string $name
 * @property int $ordering
 * @property int $progression
 * @property string|null $quest_instructions
 * @property int|null $quest_ordering
 * @property string $slug
 */
class Achievement extends Model
{
    protected $table = 'osu_achievements';
    protected $primaryKey = 'achievement_id';

    protected $casts = [
        'enabled' => 'boolean',
    ];
    public $timestamps = false;
    public $incrementing = false;

    public function scopeAchievable($query)
    {
        return $query
            ->where('enabled', true)
            ->where('slug', '<>', '');
    }

    public function iconUrl()
    {
        return config('osu.achievement.icon_prefix').e($this->slug).'.png';
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'achievement_id',
            'description',
            'grouping',
            'image',
            'name',
            'ordering',
            'progression',
            'quest_instructions',
            'quest_ordering',
            'slug' => $this->getRawAttribute($key),

            'enabled' => (bool) $this->getRawAttribute($key),

            'mode' => $this->getMode(),
        };
    }

    private function getMode()
    {
        $value = $this->getRawAttribute('mode');

        return $value === null
            ? null
            : Beatmap::modeStr($value);
    }
}
