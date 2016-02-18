<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
use Illuminate\Database\Eloquent\Model;

class UserProfileCustomization extends Model
{
    protected $casts = [
        'cover_json' => 'array',
        'extras_order' => 'array',
    ];

    private $_cover;

    public function getCoverAttribute()
    {
        if ($this->_cover === null) {
            $this->_cover = new ProfileCover($this->user_id, $this->cover_json);
        }

        return $this->_cover;
    }

    public function setCover($id, $file)
    {
        $this->cover_json = $this->cover->set($id, $file);

        $this->save();
    }

    /**
     * An array of all possible profile sections, also in their default order.
     */
    public static $sections = ['me', 'performance', 'recent_activities', 'top_ranks', 'medals', 'historical', 'beatmaps', 'kudosu'];

    public function setExtrasOrder($order)
    {
        $this->extras_order = $order;

        $this->save();
    }

    public function getExtrasOrder()
    {
        if ($this->extras_order === null) {
            $this->extras_order = self::$sections;
        }

        return $this->extras_order;
    }

    public function __construct($attributes = [])
    {
        $this->cover_json = ['id' => null, 'file' => null];
        $this->extras_order = null;

        return parent::__construct($attributes);
    }
}
