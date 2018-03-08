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

namespace App\Models;

use App\Transformers\ContestEntryTransformer;
use App\Transformers\ContestTransformer;
use App\Transformers\UserContestEntryTransformer;
use Cache;

class Contest extends Model
{
    protected $dates = ['entry_starts_at', 'entry_ends_at', 'voting_starts_at', 'voting_ends_at'];
    protected $casts = [
        'extra_options' => 'json',
    ];

    public function entries()
    {
        return $this->hasMany(ContestEntry::class);
    }

    public function votes()
    {
        return $this->hasMany(ContestVote::class);
    }

    public function isBestOf()
    {
        return isset($this->extra_options['best_of']);
    }

    public function isSubmissionOpen()
    {
        return $this->entry_starts_at !== null && $this->entry_starts_at->isPast() &&
            $this->entry_ends_at !== null && $this->entry_ends_at->isFuture();
    }

    public function isVotingOpen()
    {
        return $this->isVotingStarted() &&
            $this->voting_ends_at !== null && $this->voting_ends_at->isFuture();
    }

    public function isVotingStarted()
    {
        //the react page handles both voting and results display.
        return $this->voting_starts_at !== null && $this->voting_starts_at->isPast();
    }

    public function state()
    {
        if ($this->entry_starts_at === null || $this->entry_starts_at->isFuture()) {
            return 'preparing';
        }

        if ($this->isSubmissionOpen()) {
            return 'entry';
        }

        if ($this->isVotingOpen()) {
            return 'voting';
        }

        if ($this->show_votes) {
            return 'results';
        }

        return 'over';
    }

    public function getEntryShapeAttribute()
    {
        if ($this->type !== 'art') {
            return;
        }

        return $this->extra_options['shape'] ?? 'square';
    }

    public function setEntryShapeAttribute($shape)
    {
        if ($this->type !== 'art') {
            return;
        }

        $this->extra_options['shape'] = $shape;
    }

    public function getUnmaskedAttribute()
    {
        return $this->extra_options['unmasked'] ?? false;
    }

    public function setUnmaskedAttribute(bool $bool)
    {
        $this->extra_options['unmasked'] = $bool;
    }

    public function getLinkIconAttribute()
    {
        return $this->extra_options['link_icon'] ?? 'cloud-download';
    }

    public function setLinkIconAttribute($icon)
    {
        $this->extra_options['link_icon'] = $icon;
    }

    public function currentPhaseEndDate()
    {
        switch ($this->state()) {
            case 'entry':
                return $this->entry_ends_at;
            case 'voting':
                return $this->voting_ends_at;
        }
    }

    public function currentPhaseDateRange()
    {
        switch ($this->state()) {
            case 'preparing':
                $date = $this->entry_starts_at === null
                    ? trans('contest.dates.starts.soon')
                    : i18n_date($this->entry_starts_at);

                return trans('contest.dates.starts._', ['date' => $date]);
            case 'entry':
                return i18n_date($this->entry_starts_at).' - '.i18n_date($this->entry_ends_at);
            case 'voting':
                return i18n_date($this->voting_starts_at).' - '.i18n_date($this->voting_ends_at);
            default:
                return trans('contest.dates.ended', ['date' => i18n_date($this->voting_ends_at)]);
        }
    }

    public function currentDescription()
    {
        if ($this->isVotingStarted()) {
            return $this->description_voting;
        } else {
            return $this->description_enter;
        }
    }

    public function vote(User $user, ContestEntry $entry)
    {
        $vote = $this->votes()->where('user_id', $user->user_id)->where('contest_entry_id', $entry->id);
        if ($vote->exists()) {
            $vote->delete();
        } else {
            // there's probably a race-condition here, but abusing this just results in the user diluting their vote... so *shrug*
            if ($this->votes()->where('user_id', $user->user_id)->count() < $this->max_votes) {
                $this->votes()->create(['user_id' => $user->user_id, 'contest_entry_id' => $entry->id]);
            }
        }
    }

    public function entriesByType($user = null)
    {
        $entries = $this->entries()->with('contest');

        if ($this->show_votes) {
            return Cache::remember("contest_entries_with_votes_{$this->id}", 5, function () use ($entries) {
                $entries = $entries->with('user');

                if ($this->isBestOf()) {
                    $entries = $entries
                        ->selectRaw('*')
                        ->selectRaw('(SELECT FLOOR(SUM(`weight`)) FROM `contest_votes` WHERE `contest_entries`.`id` = `contest_votes`.`contest_entry_id`) AS votes_count')
                        ->limit(50); // best of contests tend to have a _lot_ of entries...
                } else {
                    $entries = $entries->withCount('votes');
                }

                return $entries->orderBy('votes_count', 'desc')->get();
            });
        } else {
            if ($this->isBestOf()) {
                if ($user === null) {
                    return [];
                }

                // Only return contest entries that a user has actually played
                return $entries
                    ->whereIn('entry_url', function ($query) use ($user) {
                        $query->select('beatmapset_id')
                            ->from('osu_beatmaps')
                            ->where('osu_beatmaps.playmode', Beatmap::MODES[$this->extra_options['best_of']['mode'] ?? 'osu'])
                            ->whereIn('beatmap_id', function ($query) use ($user) {
                                $query->select('beatmap_id')
                                    ->from('osu_user_beatmap_playcount')
                                    ->where('user_id', '=', $user->user_id);
                            });
                    })->get();
            }
        }

        return $entries->get();
    }

    public function defaultJson($user = null)
    {
        $includes = [];

        if ($this->type === 'art') {
            $includes[] = 'artMeta';
        }

        if ($this->show_votes) {
            $includes[] = 'results';
        }

        $contestJson = json_item($this, new ContestTransformer);
        if ($this->isVotingStarted()) {
            $contestJson['entries'] = json_collection($this->entriesByType($user), new ContestEntryTransformer, $includes);
        }

        if (!empty($contestJson['entries'])) {
            if (!$this->show_votes) {
                if ($this->unmasked) {
                    // For unmasked contests, we sort alphabetically.
                    usort($contestJson['entries'], function ($a, $b) {
                        return strnatcasecmp($a['title'], $b['title']);
                    });
                } else {
                    // We want the results to appear randomized to the user but be
                    // deterministic (i.e. we don't want the rows shuffling each time
                    // the user votes), so we seed based on user_id (when logged in)
                    $seed = $user ? $user->user_id : time();
                    seeded_shuffle($contestJson['entries'], $seed);
                }
            }
        }

        return json_encode([
            'contest' => $contestJson,
            'userVotes' => ($this->isVotingStarted() ? $this->votesForUser($user) : []),
        ]);
    }

    public function votesForUser($user = null)
    {
        if ($user === null) {
            return [];
        }

        $votes = ContestVote::where('contest_id', $this->id)->where('user_id', $user->user_id)->get();

        return $votes->map(function ($v) {
            return $v->contest_entry_id;
        })->toArray();
    }

    public function userEntries($user = null)
    {
        if ($user === null) {
            return [];
        }

        return json_collection(
            UserContestEntry::where(['contest_id' => $this->id, 'user_id' => $user->user_id])->get(),
            new UserContestEntryTransformer
        );
    }
}
