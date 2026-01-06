<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use App\Traits\Memoizes;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

/**
 * @property \DateTimeInterface $created_at
 * @property int $id
 * @property array $summary_data
 * @property string $share_key
 * @property \DateTimeInterface $updated_at
 * @property-read User $user
 * @property int $user_id
 * @property int $year
 */
class UserSummary extends Model
{
    use Memoizes;

    protected $casts = [
        'processed' => 'bool',
        'summary_data' => 'array',
    ];

    public static function createForUser(int $year, int $userId): static
    {
        $lookup = [
            'year' => $year,
            'user_id' => $userId,
        ];
        $summary = static::firstWhere($lookup);

        if ($summary === null) {
            $summary = static::create([
                ...$lookup,
                'share_key' => bin2hex(random_bytes(16)),
            ]);
        }
        if (!$summary->processed) {
            $summary->fill([
                'summary_data' => $summary->generate(),
                'processed' => true,
            ])->save();
        }

        return $summary;
    }

    public static function hasViewed(int $userId): bool
    {
        return \Cache::get("wrapped:view:{$userId}") === '1';
    }

    public static function markViewed(int $userId): bool
    {
        // 3 months
        return \Cache::put("wrapped:view:{$userId}", '1', 3 * 30 * 24 * 3600);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function generate(): array
    {
        return [
            'daily_challenge' => $this->generateDailyChallengeSummary(),
            'favourite_artists' => $this->generateFavouriteArtistsSummary(),
            'favourite_mappers' => $this->generateFavouriteMappersSummary(),
            'mapping' => $this->generateMappingSummary(),
            'medals' => $this->generateMedalsSummary(),
            'replays' => $this->generateReplaysSummary(),
            'scores' => $this->generateScoresSummary(),
            'top_plays' => $this->generateTopPlaysSummary(),
        ];
    }

    public function relatedBeatmapIds(): array
    {
        $summary = $this->summary_data;

        return array_values(array_unique([
            ...Solo\Score::whereKey($summary['top_plays'])->pluck('beatmap_id'),
            ...array_map(fn ($m) => $m['scores']['score_best_beatmap_id'], $summary['favourite_mappers']),
            ...array_map(fn ($m) => $m['scores']['score_best_beatmap_id'], $summary['favourite_artists']),
        ]));
    }

    public function relatedUserIds(): array
    {
        $summary = $this->summary_data;

        return array_values(array_unique([
            $this->user_id,
            ...array_map(fn ($m) => $m['mapper_id'], $summary['favourite_mappers']),
        ]));
    }

    private function generateDailyChallengeSummary(): array
    {
        $highScores = Multiplayer\PlaylistItemUserHighScore
            ::where('user_id', $this->user_id)
            ->passing()
            ->whereHas(
                'playlistItem.room',
                fn ($q) => $q
                    ->dailyChallenges()
                    ->whereBetween('starts_at', $this->timeRange()),
            )->with('playlistItem.room')
            ->get()
            ->sortBy('playlistItem.room.starts_at');

        $ret = ['cleared' => 0, 'top_10p' => 0, 'top_50p' => 0, 'highest_streak' => 0];
        $lastDate = null;
        $currentStreak = 0;
        foreach ($highScores as $highScore) {
            $ret['cleared']++;

            foreach ($highScore->playlistItem->scorePercentile() as $p => $totalScore) {
                if ($highScore->total_score >= $totalScore) {
                    $ret[$p]++;
                }
            }

            $room = $highScore->playlistItem->room;
            if ($lastDate === null) {
                $currentStreak++;
            } else {
                if ($room->starts_at->startOfDay()->diffInDays($lastDate) === -1.0) {
                    $currentStreak++;
                } else {
                    $currentStreak = 1;
                }
            }
            $lastDate = $room->starts_at->startOfDay();
            if ($currentStreak > $ret['highest_streak']) {
                $ret['highest_streak'] = $currentStreak;
            }
        }

        return $ret;
    }

    private function generateFavouriteArtistsSummary(): array
    {
        $scores = $this->userScores();

        $scoresByArtist = [];
        foreach ($scores as $score) {
            $beatmapset = $score->beatmap->beatmapset;
            $artist = $beatmapset->track?->artist;
            $artistName = $artist?->name ?? $beatmapset->artist;
            $scoresByArtist[$artistName] ??= [
                'artist' => [
                    'id' => $artist?->getKey(),
                    'name' => $artistName,
                ],
                'scores' => [],
            ];
            $scoresByArtist[$artistName]['scores'][] = $score;
        }
        usort($scoresByArtist, fn ($a, $b) => count($b['scores']) - count($a['scores']));
        $scoresByArtist = array_slice($scoresByArtist, 0, 10);

        $ret = [];
        foreach ($scoresByArtist as $scores) {
            $ret[] = [
                'artist' => $scores['artist'],
                'scores' => $this->summariseHighScores($scores['scores']),
            ];
        }

        return $ret;
    }

    private function generateFavouriteMappersSummary(): array
    {
        $scores = $this->userScores();

        $scoresByMapper = [];
        foreach ($scores as $score) {
            foreach ($score->beatmap->getOwners() as $mapper) {
                if (!($mapper instanceof DeletedUser)) {
                    $mapperId = $mapper->getKey();
                    $scoresByMapper[$mapperId] ??= [
                        'mapper_id' => $mapperId,
                        'scores' => [],
                    ];
                    $scoresByMapper[$mapperId]['scores'][] = $score;
                }
            }
        }
        usort($scoresByMapper, fn ($a, $b) => count($b['scores']) - count($a['scores']));
        $scoresByMapper = array_slice($scoresByMapper, 0, 10);

        $ret = [];
        foreach ($scoresByMapper as $scores) {
            $ret[] = [
                'mapper_id' => $scores['mapper_id'],
                'scores' => $this->summariseHighScores($scores['scores']),
            ];
        }

        return $ret;
    }

    private function generateMappingSummary(): array
    {
        $timeRange = $this->timeRange();
        $timeScope = fn ($q) => $q
            ->whereBetween('submit_date', $timeRange)
            ->orWhereBetween('approved_date', $timeRange);

        $ownMaps = $this->user->beatmapsets()->where($timeScope)->get();
        $ownMapsByApproved = $ownMaps->groupBy('approved');

        $discussionsCount = $this->user->beatmapDiscussions()
            ->whereBetween('created_at', $timeRange)
            ->count();

        $guestMaps = $this
            ->user
            ->profileBeatmapsetsGuest()
            ->where($timeScope)
            ->whereIn('approved', [Beatmapset::STATES['ranked'], Beatmapset::STATES['loved']])
            ->get();

        $kudosu = (int) $this
            ->user
            ->receivedKudosu()
            ->whereBetween('date', $timeRange)
            ->sum('amount');

        $nominations = $this
            ->user
            ->beatmapsetNominations()
            ->current()
            ->whereBetween('created_at', $timeRange)
            ->whereHas('beatmapset', fn ($q) => $q->whereIn('approved', [
                Beatmapset::STATES['ranked'],
                Beatmapset::STATES['approved'],
            ]))->count();

        return [
            'created' => $ownMaps->count(),
            'discussions' => $discussionsCount,
            'guest' => $guestMaps->count(),
            'kudosu' => $kudosu,
            'loved' => $ownMapsByApproved->get(Beatmapset::STATES['loved'])?->count() ?? 0,
            'nominations' => $nominations,
            'ranked' => $ownMapsByApproved->get(Beatmapset::STATES['ranked'])?->count() ?? 0,
        ];
    }

    private function generateMedalsSummary(): int
    {
        return $this
            ->user
            ->userAchievements()
            ->whereBetween('date', $this->timeRange())
            ->count();
    }

    private function generateReplaysSummary(): int
    {
        return (int) $this
            ->user
            ->replaysWatchedCounts()
            ->whereBetween('year_month', array_map(
                fn ($t) => $t->format('ym'),
                $this->timeRange(),
            ))->sum('count');
    }

    private function generateScoresSummary(): array
    {
        $scores = $this->userScores();

        $summary = [
            'acc' => 0,
            'combo' => 0,
            'combo_score_id' => 0,
            'pp' => 0,
            'pp_score_id' => 0,
            'score' => 0,
            'score_score_id' => 0,
        ];
        foreach ($scores as $score) {
            if ($summary['combo'] < $score->max_combo) {
                $summary['combo'] = $score->max_combo;
                $summary['combo_score_id'] = $score->getKey();
            }
            if ($summary['score'] < $score->total_score) {
                $summary['score'] = $score->total_score;
                $summary['score_score_id'] = $score->getKey();
            }
            if ($score->pp !== null && $summary['pp'] < $score->pp) {
                $summary['pp'] = $score->pp;
                $summary['pp_score_id'] = $score->getKey();
            }
            $summary['acc'] += $score->accuracy;
        }
        $summary['acc'] /= max(1, count($scores));

        $summary['playcount'] = YearlyPlaycount::getPosition($this->year, $this->user_id);

        return $summary;
    }

    private function generateTopPlaysSummary(): array
    {
        return $this
            ->userScoresBestPpByBeatmapId()
            ->sortByDesc('pp')
            ->slice(0, 20)
            ->values()
            ->pluck('id')
            ->all();
    }

    private function summariseHighScores(array $scores): array
    {
        $ret = [
            'pp_avg' => 0,
            'pp_best' => 0,
            'pp_best_score_id' => 0,
            'score_avg' => 0,
            'score_best' => 0,
            'score_best_score_id' => 0,
            'score_count' => count($scores),
        ];
        $ppScoreCount = 0;
        foreach ($scores as $score) {
            $pp = $score->pp;
            if ($pp !== null) {
                if ($pp > $ret['pp_best']) {
                    $ret['pp_best'] = $pp;
                    $ret['pp_best_score_id'] = $score->getKey();
                }
                $ret['pp_avg'] += $pp;
                $ppScoreCount++;
            }
            if ($score->total_score > $ret['score_best']) {
                $ret['score_best'] = $score->total_score;
                $ret['score_best_beatmap_id'] = $score->beatmap_id;
                $ret['score_best_score_id'] = $score->getKey();
            }
            $ret['score_avg'] += $score->total_score;
        }
        $ret['score_avg'] /= max(1, $ret['score_count']);
        $ret['pp_avg'] /= max(1, $ppScoreCount);

        return $ret;
    }

    private function timeRange(): array
    {
        return $this->memoize(__FUNCTION__, fn () => [
            CarbonImmutable::create($this->year),
            CarbonImmutable::create($this->year)->endOfYear(),
        ]);
    }

    private function userScores(): EloquentCollection
    {
        return $this->memoize(
            __FUNCTION__,
            fn () => $this
                ->user
                ->soloScores()
                ->where('id', '>=', $GLOBALS['cfg']['osu']['scores']['user_summary_min_id'])
                ->where('preserve', true)
                ->whereBetween('ended_at', $this->timeRange())
                ->whereHas('beatmap', fn ($q) => $q->scoreable())
                ->with(['beatmap.beatmapset.track.artist', 'beatmap.beatmapOwners.user'])
                ->get(),
        );
    }

    private function userScoresBestPpByBeatmapId(): Collection
    {
        return $this->memoize(__FUNCTION__, function () {
            $scoresByBeatmapId = [];
            foreach ($this->userScores() as $score) {
                if ($score->pp !== null) {
                    $currentHighScore = $scoresByBeatmapId[$score->beatmap_id] ?? null;
                    if ($currentHighScore === null) {
                        $scoresByBeatmapId[$score->beatmap_id] = $score;
                    } else {
                        if ($score->pp > $currentHighScore->pp) {
                            $scoresByBeatmapId[$score->beatmap_id] = $score;
                        }
                    }
                }
            }

            return collect($scoresByBeatmapId);
        });
    }
}
