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
use DB;

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
        if ($this->user && $this->user->osu_subscriber) {
            return 2;
        }

        return 1;
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
