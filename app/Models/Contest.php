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

use Illuminate\Database\Eloquent\Model;
use DB;

class Contest extends Model
{
    protected $dates = ['ends_at'];

    public function entries()
    {
        return $this->hasMany(ContestEntry::class);
    }

    public function votes()
    {
        return $this->hasMany(ContestVote::class);
    }

    public function vote(User $user, ContestEntry $entry)
    {
        $vote = $this->votes()->where('user_id', $user->user_id)->where('contest_entry_id', $entry->id);
        if ($vote->exists()) {
            $vote->delete();
        } else {
            // there's probably a race-condition here, but abusing this just results in the user diluting their vote... so *shrug*
            if ($this->votes->where('user_id', $user->user_id)->count() < $this->max_votes) {
                $this->votes()->create(['user_id' => $user->user_id, 'contest_entry_id' => $entry->id]);
            }
        }
    }
}
