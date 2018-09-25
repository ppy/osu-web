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

namespace App\Models\Forum;

use App\Models\User;
use App\Traits\Validatable;

class PollVote extends Model
{
    use Validatable;

    protected $table = 'phpbb_poll_votes';
    public $timestamps = false;

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

    public function validationErrorsTranslationPrefix()
    {
        return 'forum.poll_vote';
    }

    public function isValid()
    {
        $this->validationErrors()->reset();

        if ($this->pollOption === null) {
            $this->validationErrors()->add('poll_option_id', '.invalid');
        }

        return $this->validationErrors()->isEmpty();
    }

    public function save(array $options = [])
    {
        return $this->isValid() && parent::save($options);
    }
}
