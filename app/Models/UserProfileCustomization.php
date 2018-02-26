<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

use App\Libraries\ProfileCover;

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
    ];

    protected $guarded = [];

    private $cover;

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

    public function getExtrasOrderAttribute($value)
    {
        if ($value === null) {
            return static::SECTIONS;
        }

        return static::repairExtrasOrder(json_decode($value, true));
    }

    public function setExtrasOrderAttribute($value)
    {
        $this->attributes['extras_order'] = json_encode(static::repairExtrasOrder($value));
    }

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
}
