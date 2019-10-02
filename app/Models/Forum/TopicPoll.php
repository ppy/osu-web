<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    private $params;
    private $votedBy = [];

    public function canEdit()
    {
        return $this->topic->topic_time > Carbon::now()->subHours(config('osu.forum.poll_edit_hours'));
    }

    public function exists()
    {
        return present($this->topic->poll_title);
    }

    public function fill($params)
    {
        $this->params = array_merge([
            'hide_results' => false,
            'length_days' => 0,
            'max_options' => 1,
            'vote_change' => false,
        ], $params);
        $this->validated = false;

        return $this;
    }

    public function isOpen()
    {
        if ($this->topic === null) {
            return false;
        }

        return $this->topic->pollEnd() === null || $this->topic->pollEnd()->isFuture();
    }

    public function isValid($revalidate = false)
    {
        if (!$this->validated || $revalidate) {
            $this->validated = true;
            $this->validationErrors()->reset();

            if (!isset($this->params['title']) || !present($this->params['title'])) {
                $this->validationErrors()->add('title', 'required');
            }

            if (count($this->params['options']) > count(array_unique($this->params['options']))) {
                $this->validationErrors()->add('options', '.duplicate_options');
            }

            if (count($this->params['options']) < 2) {
                $this->validationErrors()->add('options', '.minimum_two_options');
            }

            if (count($this->params['options']) > 10) {
                $this->validationErrors()->add('options', '.too_many_options');
            }

            if ($this->params['max_options'] < 1) {
                $this->validationErrors()->add('max_options', '.minimum_one_selection');
            }

            if ($this->params['max_options'] > count($this->params['options'])) {
                $this->validationErrors()->add('max_options', '.invalid_max_options');
            }

            if ($this->params['hide_results'] && $this->params['length_days'] === 0) {
                $this->validationErrors()->add('hide_results', '.hiding_results_forever');
            }

            if ($this->topic !== null && $this->topic->exists && !$this->canEdit()) {
                $this->validationErrors()->add(
                    'edit',
                    '.grace_period_expired',
                    ['limit' => config('osu.forum.poll_edit_hours')]
                );
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
                'poll_title' => $this->params['title'],
                'poll_start' => Carbon::now(),
                'poll_length' => $this->params['length_days'] * 3600 * 24,
                'poll_max_options' => $this->params['max_options'],
                'poll_vote_change' => $this->params['vote_change'],
                'poll_hide_results' => $this->params['hide_results'],
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

    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'forum.topic_poll';
    }

    public function votedBy($user)
    {
        if ($user === null) {
            return false;
        }

        if ($this->topic === null) {
            return false;
        }

        $userId = $user->getKey();

        if (!isset($this->votedBy[$userId])) {
            $this->votedBy[$userId] = $this->topic->pollVotes()->where('vote_user_id', $userId)->exists();
        }

        return $this->votedBy[$userId];
    }
}
