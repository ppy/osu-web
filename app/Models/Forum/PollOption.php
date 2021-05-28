<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Forum;

use App\Libraries\BBCodeForDB;
use DB;

/**
 * @property int $poll_option_id
 * @property string $poll_option_text
 * @property int $poll_option_total
 * @property Post $post
 * @property Topic $topic
 * @property int $topic_id
 * @property \Illuminate\Database\Eloquent\Collection $votes PollVote
 */
class PollOption extends Model
{
    protected $table = 'phpbb_poll_options';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    // For bbcode_uid, the first post (even if the post is deleted).
    public function post()
    {
        return $this
            ->belongsTo(Post::class, 'topic_id', 'topic_id')
            ->withTrashed()
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
            if ($user === null) {
                $userVotes = [];
            } else {
                $userVotes = array_flip(model_pluck($topic->pollVotes()->where('vote_user_id', $user->getKey()), 'poll_option_id'));
            }

            foreach ($topic->pollOptions as $poll) {
                $votedByUser = array_key_exists($poll->poll_option_id, $userVotes);

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
        $staticTable = (new static())->table;
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
            ['withGallery' => true]
        );
    }

    public function optionTextRaw()
    {
        return bbcode_for_editor($this->poll_option_text, $this->post->bbcode_uid);
    }
}
