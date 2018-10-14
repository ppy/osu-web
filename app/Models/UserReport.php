<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

use App\Models\Score\Best\Model as BestModel;

class UserReport extends Model
{
    const CREATED_AT = 'timestamp';

    protected $table = 'osu_user_reports';
    protected $primaryKey = 'report_id';

    protected $dates = ['timestamp'];

    public $timestamps = false;

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function score()
    {
        return $this->morphTo();
    }

    public function getScoreTypeAttribute()
    {
        return BestModel::getClass($this->mode);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
