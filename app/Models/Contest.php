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

use Illuminate\Database\Eloquent\Model;
use App\Transformers\ContestTransformer;
use Cache;

class Contest extends Model
{
    protected $dates = ['ends_at'];

    public function entries()
    {
        return $this->hasMany(ContestEntry::class);
    }

    public function votes()
    {
        return $this->hasMany(ContestVote::class);
    }

    public function voteAggregates()
    {
        return $this->hasMany(ContestVoteAggregate::class);
    }

    public function cachedVoteAggregates()
    {
        return Cache::remember("contest_votes_{$this->id}", 5, function () {
            return $this->voteAggregates;
        });
    }

    public function vote(User $user, ContestEntry $entry)
    {
        $vote = $this->votes()->where('user_id', $user->user_id)->where('contest_entry_id', $entry->id);
        if ($vote->exists()) {
            $vote->delete();
        } else {
            // there's probably a race-condition here, but abusing this just results in the user diluting their vote... so *shrug*
            if ($this->votes->where('user_id', $user->user_id)->count() < $this->max_votes) {
                $this->votes()->create(['user_id' => $user->user_id, 'contest_entry_id' => $entry->id]);
            }
        }
    }

    public function defaultJson($currentUser = null)
    {
        $includes = ['entries'];

        if ($this->type === 'art') {
            $includes[] = 'entries.artMeta';
        }

        if ($this->show_votes) {
            $includes[] = 'entries.results';
        }

        $contestJson = fractal_api_serialize_item($this, new ContestTransformer, $includes);

        if (!empty($contestJson['entries'])) {
            if ($this->show_votes) {
                // Sort results by number of votes desc
                usort($contestJson['entries'], function ($a, $b) {
                    if ($a['results']['votes'] === $b['results']['votes']) {
                        return 0;
                    }

                    return ($a['results']['votes'] > $b['results']['votes']) ? -1 : 1;
                });
            } else {
                // We want the results to appear randomized to the user but be
                // deterministic (i.e. we don't want the rows shuffling each time
                // the user votes), so we seed based on user_id
                $seed = $currentUser ? $currentUser->user_id : time();
                seeded_shuffle($contestJson['entries'], $seed);
            }
        }

        return json_encode([
            'contest' => $contestJson,
            'userVotes' => $this->votesForUser($currentUser),
        ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    }

    public function votesForUser($currentUser = null)
    {
        $votes = [];
        if ($currentUser) {
            $votes = ContestVote::where('contest_id', $this->id)->where('user_id', $currentUser->user_id)->get();
            $votes = $votes->map(function ($v) {
                return $v->contest_entry_id;
            })->toArray();
        }

        return $votes;
    }
}
