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

use App\Libraries\BBCodeForDB;
use DB;

class PollOption extends Model
{
    protected $table = 'phpbb_poll_options';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    // for bbcode_uid
    public function post()
    {
        return $this
            ->belongsTo(Post::class, 'topic_id', 'topic_id')
            ->orderBy('post_id', 'ASC')
            ->limit(1);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function votes()
    {
        return $this->hasMany(PollVote::class, 'poll_option_id', 'poll_option_id')->where('topic_id', $this->topic_id);
    }

    public static function summary($topic, $user)
    {
        $summary = [
            'options' => [],
            'total' => 0,
            'user_votes' => 0,
        ];

        if ($topic->poll()->exists()) {
            $userVotes = [];

            if ($user !== null) {
                $userVotes = model_pluck($topic->pollVotes()->where('vote_user_id', $user->getKey()), 'poll_option_id');
            }

            foreach ($topic->pollOptions as $poll) {
                $votedByUser = in_array($poll->poll_option_id, $userVotes, true);

                $summary['options'][$poll->poll_option_id] = [
                    'textHTML' => $poll->optionTextHTML(),
                    'total' => $poll->poll_option_total,
                    'voted_by_user' => $votedByUser,
                ];

                $summary['total'] += $poll->poll_option_total;
                $summary['user_votes'] += $votedByUser ? 1 : 0;
            }
        }

        return $summary;
    }

    public static function updateTotals($filters)
    {
        $staticTable = (new static)->table;
        $countQuery = PollVote::where([
                'topic_id' => DB::raw($staticTable.'.topic_id'),
                'poll_option_id' => DB::raw($staticTable.'.poll_option_id'),
            ])
            // raw because ->count() immediately executes the query.
            // DISTINCT because lack of unique index causing duplicated votes.
            ->select(DB::raw('COUNT(DISTINCT vote_user_id)'))
            ->toSql();

        return static::where($filters)
            ->update(['poll_option_total' => DB::raw("({$countQuery})")]);
    }

    public function userHasVoted($user)
    {
        if ($user === null) {
            return false;
        }

        return $this->votes()->where('vote_user_id', $user->user_id)->exists();
    }

    public function setPollOptionTextAttribute($value)
    {
        $this->attributes['poll_option_text'] = (new BBCodeForDB($value))->generate();
    }

    public function optionTextHTML()
    {
        return bbcode(
            $this->poll_option_text,
            $this->post->bbcode_uid,
            ['withGallery' => true, 'extraClasses' => 'u-ellipsis-overflow']
        );
    }

    public function optionTextRaw()
    {
        return bbcode_for_editor($this->poll_option_text, $this->post->bbcode_uid);
    }
}
