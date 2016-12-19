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

namespace App\Models;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;

class BeatmapDiscussion extends Model
{
    protected $guarded = [];

    protected $touches = ['beatmapsetDiscussion'];

    protected $casts = [
        'resolved' => 'boolean',
    ];

    protected $dates = ['deleted_at'];

    const KUDOSU_STEPS = [5, 10, 15];

    const MESSAGE_TYPES = [
        'praise' => 0,
        'suggestion' => 1,
        'problem' => 2,
    ];

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class);
    }

    public function beatmapset()
    {
        return $this->beatmap->beatmapset();
    }

    public function beatmapDiscussionPosts()
    {
        return $this->hasMany(BeatmapDiscussionPost::class);
    }

    public function beatmapDiscussionVotes()
    {
        return $this->hasMany(BeatmapDiscussionVote::class);
    }

    public function beatmapsetDiscussion()
    {
        return $this->belongsTo(BeatmapsetDiscussion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getMessageTypeAttribute($value)
    {
        return array_search_null(get_int($value), static::MESSAGE_TYPES);
    }

    public function setMessageTypeAttribute($value)
    {
        return $this->attributes['message_type'] = static::MESSAGE_TYPES[$value] ?? null;
    }

    public function calculateKudosu($event, $scoreChange)
    {
        // no kudosu for praises...?
        if ($this->message_type === 'praise') {
            return;
        }

        $currentVotes = $this->currentVotes();
        $previousVotes = $currentVotes - $scoreChange;

        $change = 0;

        if ($scoreChange > 0) {
            foreach (static::KUDOSU_STEPS as $step) {
                if ($previousVotes < $step && $currentVotes >= $step) {
                    $change += 1;
                }
            }
        } else {
            foreach (static::KUDOSU_STEPS as $step) {
                if ($currentVotes < $step && $previousVotes >= $step) {
                    $change -= 1;
                }
            }
        }

        if ($change === 0) {
            return;
        }

        DB::transaction(function () use ($change, $event) {
            KudosuHistory::create([
                'receiver_id' => $this->user->user_id,
                'amount' => $change,
                'action' => $change > 0 ? 'give' : 'reset',
                'date' => Carbon::now(),
                'kudosuable_type' => static::class,
                'kudosuable_id' => $this->id,
                'details' => [
                    'event' => $event,
                ],
            ]);
            $this->user->update([
                'osu_kudostotal' => DB::raw("osu_kudostotal + {$change}"),
                'osu_kudosavailable' => DB::raw("osu_kudosavailable + {$change}"),
            ]);
        });
    }

    public function currentVotes($ignoreDeletedStatus = false)
    {
        return $this->isDeleted() && !$ignoreDeletedStatus
            ? 0
            : $this->beatmapDiscussionVotes()->sum('score');
    }

    public function hasValidBeatmap()
    {
        return
            $this->beatmap_id === null ||
            ($this->beatmap && $this->beatmap->beatmapset_id === $this->beatmapsetDiscussion->beatmapset_id);
    }

    public function hasValidMessageType()
    {
        return
            ($this->beatmap_id === null && $this->message_type === null) ||
            ($this->beatmap_id !== null && $this->message_type !== null);
    }

    public function hasValidTimestamp()
    {
        return
            ($this->timestamp === null) ||
            ($this->beatmap_id !== null && $this->timestamp >= 0 && $this->timestamp < ($this->beatmap->total_length * 1000));
    }

    public function votesSummary()
    {
        $votes = ['up' => 0, 'down' => 0];

        foreach ($this->beatmapDiscussionVotes as $vote) {
            if ($vote->score === 1) {
                $votes['up'] += 1;
            } elseif ($vote->score === -1) {
                $votes['down'] += 1;
            }
        }

        return $votes;
    }

    /*
     * Called before saving. The callback definition is located in
     * App\Providers\AppServiceProvider. Don't ask me why it's there;
     * ask Laravel.
     */
    public function isValid()
    {
        return $this->hasValidBeatmap() &&
            $this->hasValidMessageType() &&
            $this->hasValidTimestamp();
    }

    public function vote($params)
    {
        return DB::transaction(function () use ($params) {
            $vote = $this->beatmapDiscussionVotes()->where(['user_id' => $params['user_id']])->firstOrNew([]);
            $previousScore = $vote->score ?? 0;
            $vote->fill($params);
            $scoreChange = $vote->score - $previousScore;

            if ($scoreChange !== 0) {
                if ($vote->score === 0) {
                    $vote->delete();
                } else {
                    $vote->save();
                }

                $this->calculateKudosu('vote', $scoreChange);
            }

            return true;
        });
    }

    public function title()
    {
        return "{$this->beatmapset->title} [{$this->beatmap->version}]";
    }

    public function url()
    {
        return route('beatmap-discussions.show', $this->id);
    }

    public function isDeleted()
    {
        return $this->deleted_at !== null;
    }

    public function restore()
    {
        DB::transaction(function () {
            $this->update(['deleted_at' => null]);
            $this->calculateKudosu('restore', max($this->currentVotes(true), 0));
        });
    }

    public function softDelete($deletedBy)
    {
        DB::transaction(function () use ($deletedBy) {
            $this->update([
                'deleted_by_id' => $deletedBy->user_id ?? null,
                'deleted_at' => Carbon::now(),
            ]);
            $this->calculateKudosu('delete', min(-1 * $this->currentVotes(true), 0));
        });
    }

    public function scopeWithoutDeleted($query)
    {
        $query->whereNull('deleted_at');
    }
}
