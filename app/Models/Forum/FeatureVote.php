<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Forum;

use App\Models\User;
use App\Traits\Validatable;
use DB;

/**
 * @property \Carbon\Carbon $date
 * @property int $star_id
 * @property Topic $topic
 * @property int $topic_id
 * @property mixed $type
 * @property User $user
 * @property int $user_id
 */
class FeatureVote extends Model
{
    use Validatable;

    protected $table = 'phpbb_topics_stars';
    protected $primaryKey = 'star_id';

    public $timestamps = false;
    protected $dates = ['date'];

    const COST = 1;

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function voteIncrement()
    {
        switch ($this->type) {
            case 'supporter':
                return 2;
            case 'user':
                return 1;
        }
    }

    public function setType()
    {
        if ($this->user !== null && $this->user->osu_subscriber) {
            $this->type = 'supporter';
        } else {
            $this->type = 'user';
        }
    }

    public function validateTopic()
    {
        if ($this->topic === null) {
            $this->validationErrors()->add('topic_id', 'required');

            return;
        }

        if (!$this->topic->isFeatureTopic()) {
            $this->validationErrors()->add('topic_id', '.not_feature_topic');
        }
    }

    public function validateUser()
    {
        if ($this->user === null) {
            $this->validationErrors()->add('user_id', 'required');

            return;
        }

        if ($this->user->osu_featurevotes < static::COST) {
            $this->validationErrors()->add('user_id', '.not_enough_feature_votes');
        }
    }

    public function isValid()
    {
        $this->validationErrors()->reset();
        $this->validateUser();
        $this->validateTopic();

        return $this->validationErrors()->isEmpty();
    }

    public static function createNew($params)
    {
        $star = new static($params);
        $star->setType();

        if ($star->isValid()) {
            DB::transaction(function () use ($star) {
                // So the strings can be used with interpolation
                // instead of concatenation or sprintf.
                $cost = (string) static::COST;
                $increment = (string) $star->voteIncrement();

                // phpcs:ignore
                return
                    $star->user->update([
                        'osu_featurevotes' => DB::raw("osu_featurevotes - ({$cost})"),
                    ]) &&

                    $star->topic->update([
                        'osu_starpriority' => DB::raw("osu_starpriority + ({$increment})"),
                    ]) &&

                    $star->saveOrFail();
            });
        }

        return $star;
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'forum.feature_vote';
    }
}
