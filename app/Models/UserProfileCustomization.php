<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Models;

use App\Libraries\CommentBundleParams;
use App\Libraries\ProfileCover;

/**
 * @property array|null $cover_json
 * @property \Carbon\Carbon $created_at
 * @property string|null $extras_order
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property int|null $user_id
 */
class UserProfileCustomization extends Model
{
    /**
     * An array of all possible profile sections, also in their default order.
     */
    const SECTIONS = [
        'me',
        'recent_activity',
        'top_ranks',
        'medals',
        'historical',
        'beatmaps',
        'kudosu',
    ];

    protected $casts = [
        'cover_json' => 'array',
        'options' => 'array',
    ];

    private $cover;

    public static function repairExtrasOrder($value)
    {
        // read from inside out
        return
            array_values(
                // remove duplicate sections from previous merge
                array_unique(
                    // ensure all sections are included
                    array_merge(
                        // remove invalid sections
                        array_intersect($value, static::SECTIONS),
                        static::SECTIONS
                    )
                )
            );
    }

    public function cover()
    {
        if ($this->cover === null) {
            $this->cover = new ProfileCover($this->user_id, $this->cover_json);
        }

        return $this->cover;
    }

    public function setCover($id, $file)
    {
        $this->cover_json = $this->cover()->set($id, $file);

        $this->save();
    }

    public function getCommentsSortAttribute()
    {
        return $this->options['comments_sort'] ?? CommentBundleParams::DEFAULT_SORT;
    }

    public function setCommentsSortAttribute($value)
    {
        if ($value !== null && !in_array($value, array_keys(CommentBundleParams::SORTS), true)) {
            $value = null;
        }

        $this->setOption('comments_sort', $value);
    }

    public function getExtrasOrderAttribute($value)
    {
        if ($value !== null) {
            $value = json_decode($value, true);
        }

        $value = $this->options['extras_order'] ?? $value;

        if ($value === null) {
            return static::SECTIONS;
        }

        return static::repairExtrasOrder($value, true);
    }

    public function setExtrasOrderAttribute($value)
    {
        $this->attributes['extras_order'] = null;
        $this->setOption('extras_order', static::repairExtrasOrder($value));
    }

    public function getRankingExpandedAttribute()
    {
        return $this->options['ranking_expanded'] ?? true;
    }

    public function setRankingExpandedAttribute($value)
    {
        $this->setOption('ranking_expanded', $value);
    }

    public function setOption($key, $value)
    {
        $this->options = array_merge($this->options ?? [], [$key => $value]);
    }
}
