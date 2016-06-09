<?php

/**
 *    Copyright 2016 ppy Pty. Ltd.
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
namespace App\Models\Forum;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PollVote extends Model
{
    protected $table = 'phpbb_poll_votes';

    public function pollOption()
    {
        return $this
            ->belongsTo(PollOption::class, 'poll_option_id', 'poll_option_id')
            ->where('topic_id', $this->topic_id);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'vote_user_id');
    }
}
