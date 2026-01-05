<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Exceptions\InvariantException;
use App\Traits\Memoizes;
use App\Transformers\ContestEntryTransformer;
use App\Transformers\ContestTransformer;
use App\Transformers\UserContestEntryTransformer;
use Cache;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read Collection<ContestJudge> $contestJudges
 * @property \Carbon\Carbon|null $created_at
 * @property string $description_enter
 * @property string|null $description_voting
 * @property-read Collection<ContestEntry> $entries
 * @property \Carbon\Carbon|null $entry_ends_at
 * @property mixed $thumbnail_shape
 * @property \Carbon\Carbon|null $entry_starts_at
 * @property json|null $extra_options
 * @property string $header_url
 * @property int $id
 * @property mixed $link_icon
 * @property-read Collection<User> $judges
 * @property int $max_entries
 * @property int $max_votes
 * @property string $name
 * @property bool $show_votes
 * @property mixed $type
 * @property mixed $unmasked
 * @property-read Collection<ContestScoringCategory> $scoringCategories
 * @property bool $show_names
 * @property \Carbon\Carbon|null $updated_at
 * @property bool $visible
 * @property-read Collection<ContestVote> $votes
 * @property \Carbon\Carbon|null $voting_ends_at
 * @property \Carbon\Carbon|null $voting_starts_at
 */
class Contest extends Model
{
    use Memoizes;

    private const DEFAULT_EXTENSIONS = [
        'art' => ['jpg', 'jpeg', 'png'],
        'beatmap' => ['osz'],
        'music' => ['mp3'],
    ];

    private const MAX_FILESIZE = [
        'art' => 8 * 1024 * 1024,
        'beatmap' => 32 * 1024 * 1024,
        'music' => 16 * 1024 * 1024,
    ];

    protected $casts = [
        'entry_ends_at' => 'datetime',
        'entry_starts_at' => 'datetime',
        'extra_options' => 'array',
        'show_votes' => 'boolean',
        'visible' => 'boolean',
        'voting_ends_at' => 'datetime',
        'voting_starts_at' => 'datetime',
    ];

    public function contestJudges(): HasMany
    {
        return $this->HasMany(ContestJudge::class);
    }

    public function entries()
    {
        return $this->hasMany(ContestEntry::class);
    }

    public function judges(): BelongsToMany
    {
        return $this->belongsToMany(User::class, ContestJudge::class);
    }

    public function userContestEntries()
    {
        return $this->hasMany(UserContestEntry::class);
    }

    public function votes()
    {
        return $this->hasMany(ContestVote::class);
    }

    public function assertVoteRequirement(?User $user): void
    {
        $requirement = $this->getExtraOptions()['requirement'] ?? null;

        if ($requirement === null) {
            return;
        }

        if ($user === null) {
            throw new InvariantException(osu_trans('authorization.require_login'));
        }

        switch ($requirement['name']) {
            // requires playing (and optionally passing) all the beatmapsets in the specified room ids
            case 'playlist_beatmapsets':
                $roomIds = $requirement['room_ids'];
                $mustPass = $requirement['must_pass'] ?? true;
                $beatmapIdsQuery = Multiplayer\PlaylistItem::whereIn('room_id', $roomIds)->select('beatmap_id');
                $requiredBeatmapsetCount = Beatmap::whereIn('beatmap_id', $beatmapIdsQuery)->distinct('beatmapset_id')->count();
                $playedScoreIdsQuery = Multiplayer\ScoreLink
                    ::whereHas('playlistItem', fn($q) => $q->whereIn('room_id', $roomIds))
                    ->where(['user_id' => $user->getKey()])
                    ->select('score_id');
                if ($mustPass) {
                    $playedScoreIdsQuery->whereHas('playlistItemUserHighScore');
                }
                $playedBeatmapIdsQuery = Solo\Score::whereIn('id', $playedScoreIdsQuery)->select('beatmap_id');
                $playedBeatmapsetCount = Beatmap::whereIn('beatmap_id', $playedBeatmapIdsQuery)->distinct('beatmapset_id')->count();

                if ($playedBeatmapsetCount !== $requiredBeatmapsetCount) {
                    throw new InvariantException(osu_trans('contest.voting.requirement.playlist_beatmapsets.incomplete_play'));
                }
                break;
            default:
                throw new Exception('unknown requirement');
        }
    }

    public function calculateScoresStd(): void
    {
        $judgeScores = [];
        foreach ($this->contestJudges as $judge) {
            $judgeScores[$judge->user_id] = $judge->stdDev();
        }

        $judgeVotes = ContestJudgeVote::whereHas('entry', fn($q) => $q->where('contest_id', $this->getKey()))->get();
        foreach ($judgeVotes as $vote) {
            [$stdDev, $mean] = $judgeScores[$vote->user_id];
            $vote->update(['total_score_std' => $stdDev === 0.0 ? 0 : ($vote->totalScore() - $mean) / $stdDev]);
        }
    }

    public function isBestOf(): bool
    {
        return isset($this->getExtraOptions()['best_of']);
    }

    public function isJudge(User $user): bool
    {
        $judges = $this->judges();

        return $judges->where($judges->qualifyColumn('user_id'), $user->getKey())->exists();
    }

    public function isJudged(): bool
    {
        return $this->getExtraOptions()['judged'] ?? false;
    }

    public function isJudgingActive(): bool
    {
        return $this->isJudged() && $this->isVotingOpen() && !$this->show_votes;
    }

    public function getShowJudgesAttribute()
    {
        return $this->getExtraOptions()['show_judges'] ?? true;
    }

    public function isScoreStandardised(): bool
    {
        return $this->getExtraOptions()['is_score_standardised'] ?? false;
    }

    public function isSubmittedBeatmaps(): bool
    {
        return $this->isBestOf() || ($this->getExtraOptions()['submitted_beatmaps'] ?? false);
    }

    public function isSubmissionOpen()
    {
        return $this->entry_starts_at !== null && $this->entry_starts_at->isPast() &&
            $this->entry_ends_at !== null && $this->entry_ends_at->isFuture();
    }

    public function isVotingEnded()
    {
        return $this->voting_ends_at !== null && $this->voting_ends_at->isPast();
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

    public function scoringCategories(): HasMany
    {
        return $this->hasMany(ContestScoringCategory::class);
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
                return i18n_date($this->entry_starts_at) . ' - ' . i18n_date($this->entry_ends_at);
            case 'voting':
                return i18n_date($this->voting_starts_at) . ' - ' . i18n_date($this->voting_ends_at);
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
            $this->assertVoteRequirement($user);
            // there's probably a race-condition here, but abusing this just results in the user diluting their vote... so *shrug*
            if ($this->votes()->where('user_id', $user->user_id)->count() < $this->max_votes) {
                $this->votes()->create(['user_id' => $user->user_id, 'contest_entry_id' => $entry->id]);
            }
        }
    }

    public function entriesByType(?User $user, array $preloads = [])
    {
        $query = $this->entries()->with(['contest', ...$preloads]);

        if ($this->show_votes) {
            return Cache::remember(
                "contest_entries_with_votes_{$this->id}",
                300,
                fn() => $query->with(['contest', ...$preloads])->withScore($this)->get()
            );
        } elseif ($this->isBestOf()) {
            if ($user === null) {
                return [];
            }

            $options = $this->getExtraOptions()['best_of'];
            $query->forBestOf($user, $options['mode'] ?? 'osu', $options['variant'] ?? null);
        }

        return $query->get();
    }

    public function defaultJson($user = null)
    {
        $includes = [];
        $preloads = [];

        if ($this->type === 'art') {
            $includes[] = 'artMeta';
        }

        $showVotes = $this->show_votes;
        if ($showVotes) {
            $includes[] = 'results';
        }
        if ($this->showEntryUser()) {
            $includes[] = 'user';
            $preloads[] = 'user';
        }

        $contestJson = json_item(
            $this,
            new ContestTransformer(),
            $showVotes ? ['users_voted_count'] : null,
        );
        if ($this->isVotingStarted()) {
            $contestJson['entries'] = json_collection(
                $this->entriesByType($user, $preloads),
                new ContestEntryTransformer(),
                $includes,
            );
        }

        if (!empty($contestJson['entries'])) {
            if (!$showVotes) {
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

    public function usersVotedCount(): int
    {
        return cache()->remember(
            static::class . ':' . __FUNCTION__ . ':' . $this->getKey(),
            300,
            fn() => $this->votes()->distinct('user_id')->count(),
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

    public function getForcedWidth()
    {
        return $this->getExtraOptions()['forced_width'] ?? null;
    }

    public function getForcedHeight()
    {
        return $this->getExtraOptions()['forced_height'] ?? null;
    }

    public function getAllowedExtensions(): array
    {
        return $this->getExtraOptions()['allowed_extensions'] ?? self::DEFAULT_EXTENSIONS[$this->type] ?? [];
    }

    public function getMaxFilesize(): int
    {
        return self::MAX_FILESIZE[$this->type] ?? 0;
    }

    public function showEntryUser(): bool
    {
        return $this->show_votes || ($this->getExtraOptions()['show_entry_user'] ?? false);
    }
}
