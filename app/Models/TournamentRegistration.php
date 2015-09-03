<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TournamentRegistration extends Model
{
    protected $table = 'osu.tournament_registrations';
    protected $primaryKey = 'registration_id';

    public function getDates()
    {
        return ['created_at', 'updated_at', 'signup_open', 'signup_close', 'start_date', 'end_date'];
    }

    public function tournament()
    {
        return $this->belongsTo('App\Models\Tournament');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
