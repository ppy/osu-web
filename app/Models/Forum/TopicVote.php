<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Forum;

use App\Traits\Validatable;
use Carbon\Carbon;
use DB;

class TopicVote
{
    use Validatable;

    private array $params = [];
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

    public function validationErrorsTranslationPrefix(): string
    {
        return 'forum.topic_vote';
    }
}
