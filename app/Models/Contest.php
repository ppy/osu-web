<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Traits\Memoizes;
use App\Transformers\ContestEntryTransformer;
use App\Transformers\ContestTransformer;
use App\Transformers\UserContestEntryTransformer;
use Cache;

/**
 * @property \Carbon\Carbon|null $created_at
 * @property string $description_enter
 * @property string|null $description_voting
 * @property \Illuminate\Database\Eloquent\Collection $entries ContestEntry
 * @property \Carbon\Carbon|null $entry_ends_at
 * @property mixed $thumbnail_shape
 * @property \Carbon\Carbon|null $entry_starts_at
 * @property json|null $extra_options
 * @property string $header_url
 * @property int $id
 * @property mixed $link_icon
 * @property int $max_entries
 * @property int $max_votes
 * @property string $name
 * @property int $show_votes
 * @property mixed $type
 * @property mixed $unmasked
 * @property bool $show_names
 * @property \Carbon\Carbon|null $updated_at
 * @property bool $visible
 * @property \Illuminate\Database\Eloquent\Collection $votes ContestVote
 * @property \Carbon\Carbon|null $voting_ends_at
 * @property \Carbon\Carbon|null $voting_starts_at
 */
class Contest extends Model
{
    use Memoizes;

    protected $dates = ['entry_starts_at', 'entry_ends_at', 'voting_starts_at', 'voting_ends_at'];
    protected $casts = [
        'extra_options' => 'array',
        'visible' => 'boolean',
    ];

    public function entries()
    {
        return $this->hasMany(ContestEntry::class);
    }

    public function userContestEntries()
    {
        return $this->hasMany(UserContestEntry::class);
    }

    public function votes()
    {
        return $this->hasMany(ContestVote::class);
    }

    public function isBestOf()
    {
        return isset($this->getExtraOptions()['best_of']);
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

    public function hasThumbnails(): bool
    {
        return $this->type === 'art' ||
            ($this->type === 'external' && isset($this->getExtraOptions()['thumbnail_shape']));
    }

    public function getThumbnailShapeAttribute(): ?string
    {
        if (!$this->hasThumbnails()) {
            return null;
        }

        return $this->getExtraOptions()['thumbnail_shape'] ?? 'square';
    }

    public function getUnmaskedAttribute()
    {
        return $this->getExtraOptions()['unmasked'] ?? false;
    }

    public function getShowNamesAttribute()
    {
        return $this->getExtraOptions()['show_names'] ?? false;
    }

    public function getLinkIconAttribute()
    {
        return $this->getExtraOptions()['link_icon'] ?? 'download';
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
                    ? osu_trans('contest.dates.starts.soon')
                    : i18n_date($this->entry_starts_at);

                return osu_trans('contest.dates.starts._', ['date' => $date]);
            case 'entry':
                return i18n_date($this->entry_starts_at).' - '.i18n_date($this->entry_ends_at);
            case 'voting':
                return i18n_date($this->voting_starts_at).' - '.i18n_date($this->voting_ends_at);
            default:
                if ($this->voting_ends_at === null) {
                    return osu_trans('contest.dates.ended_no_date');
                } else {
                    return osu_trans('contest.dates.ended', ['date' => i18n_date($this->voting_ends_at)]);
                }
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
            return Cache::remember("contest_entries_with_votes_{$this->id}", 300, function () use ($entries) {
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
                            ->where('osu_beatmaps.playmode', Beatmap::MODES[$this->getExtraOptions()['best_of']['mode'] ?? 'osu'])
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

        $contestJson = json_item($this, new ContestTransformer());
        if ($this->isVotingStarted()) {
            $contestJson['entries'] = json_collection($this->entriesByType($user), new ContestEntryTransformer(), $includes);
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
            new UserContestEntryTransformer()
        );
    }

    public function url()
    {
        return route('contests.show', $this->id);
    }

    public function setExtraOption($key, $value): void
    {
        $this->extra_options = array_merge($this->extra_options ?? [], [$key => $value]);
        $this->resetMemoized();
    }

    public function getExtraOptions()
    {
        return $this->memoize(__FUNCTION__, function () {
            return $this->extra_options;
        });
    }
}
