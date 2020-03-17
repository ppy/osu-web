<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Forum;

use App\Models\User;
use App\Traits\Validatable;

/**
 * @property PollOption $pollOption
 * @property int $poll_option_id
 * @property int $topic_id
 * @property User $user
 * @property int $vote_user_id
 * @property string $vote_user_ip
 */
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
