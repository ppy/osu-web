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
    ];

    private $_cover;

    public function getCoverAttribute()
    {
        if ($this->_cover === null) {
            $this->_cover = new ProfileCover($this->user_id, $this->cover_json);
        }

        return $this->_cover;
    }

    public function setCover(&$errors, $id, $file)
    {
        $this->cover_json = $this->cover->set($id, $file);
        $errors = $this->cover->errors;

        if (count($errors) === 0) {
            $this->save();
        }
    }

    public function __construct($attributes = [])
    {
        $this->cover_json = ['id' => null, 'file' => null];

        return parent::__construct($attributes);
    }
}
