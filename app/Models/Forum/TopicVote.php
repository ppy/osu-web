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

use App\Traits\Validatable;
use Carbon\Carbon;
use DB;

class TopicVote
{
    use Validatable;

    private $topic;
    private $validated = false;

    public function __construct($topic)
    {
        $this->topic = $topic;
    }

    public function fill($params)
    {
        $this->params = $params;
        $this->validated = false;

        return $this;
    }

    public function isValid($revalidate = false)
    {
        if (!$this->validated || $revalidate) {
            $this->validated = true;
            $this->validationErrors()->reset();

            if (!isset($this->params['option_ids']) || count($this->params['option_ids']) < 1) {
                $this->validationErrors()->add('option_ids', '.required');
            }

            if (count($this->params['option_ids'] ?? []) > $this->topic->poll_max_options) {
                $this->validationErrors()->add('option_ids', '.too_many');
            }
        }

        return $this->validationErrors()->isEmpty();
    }

    public function save()
    {
        if (!$this->isValid()) {
            return false;
        }

        return DB::transaction(function () {
            $this->topic->update([
                'poll_last_vote' => Carbon::now(),
            ]);

            $this
                ->topic
                ->pollVotes()
                ->where('vote_user_id', $this->params['user_id'])
                ->delete();

            foreach (array_unique($this->params['option_ids']) as $optionId) {
                $this
                    ->topic
                    ->pollVotes()
                    ->create([
                        'poll_option_id' => $optionId,
                        'vote_user_id' => $this->params['user_id'],
                        'vote_user_ip' => $this->params['ip'],
                    ]);
            }

            PollOption::updateTotals(['topic_id' => $this->topic->topic_id]);

            return true;
        });
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'forum.topic_vote';
    }
}
