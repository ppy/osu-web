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
namespace App\Models\Forum;

use App\Traits\Validatable;
use Carbon\Carbon;
use DB;

class TopicPoll
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

            if (!isset($this->params['title']) || !present($this->params['title'])) {
                $this->validationErrors()->add('title', '.required');
            }

            if (count($this->params['options']) < 2) {
                $this->validationErrors()->add('options', '.minimum_two');
            }

            if (count($this->params['options']) > 10) {
                $this->validationErrors()->add('options', '.too_many');
            }

            if ($this->params['max_options'] < 1) {
                $this->validationErrors()->add('max_options', '.minimum_one');
            }

            if ($this->params['max_options'] > count($this->params['options'])) {
                $this->validationErrors()->add('max_options', '.minimum_one');
            }
        }

        return $this->validationErrors()->isAny();
    }

    public function save()
    {
        if (!$this->isValid()) {
            return false;
        }

        return DB::transaction(function () {
            $this->topic->update([
                'poll_title' => $this->params['title'],
                'poll_start' => Carbon::now(),
                'poll_length' => ($this->params['length_days'] ?? 0) * 3600,
                'poll_max_options' => $this->params['max_options'],
                'poll_vote_change' => $this->params['vote_change'] ?? false,
            ]);

            $this
                ->topic
                ->pollVotes()
                ->delete();

            $this
                ->topic
                ->pollOptions()
                ->delete();

            for ($i = 0; $i < count($this->params['options']); $i++) {
                PollOption::create([
                    'topic_id' => $this->topic->topic_id,
                    'poll_option_id' => $i,
                    'poll_option_text' => $this->params['options'][$i],
                ]);
            }

            return true;
        });
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'forum.topic_vote';
    }
}
