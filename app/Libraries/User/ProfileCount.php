<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\User;

use App\Http\Controllers\UsersController;
use App\Libraries\Search\ScoreSearchParams;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\User;

class ProfileCount
{
    const BEATMAPSET_PROFILE_SECTION_MAP = [
        Beatmapset::STATES['graveyard'] => 'graveyardBeatmapsets',

        Beatmapset::STATES['loved'] => 'lovedBeatmapsets',

        Beatmapset::STATES['pending'] => 'pendingBeatmapsets',
        Beatmapset::STATES['wip'] => 'pendingBeatmapsets',

        Beatmapset::STATES['approved'] => 'rankedBeatmapsets',
        Beatmapset::STATES['qualified'] => 'rankedBeatmapsets',
        Beatmapset::STATES['ranked'] => 'rankedBeatmapsets',
    ];

    private readonly int $beatmapsModded;
    private readonly array $beatmapsetCountsByApproved;
    private readonly int $issuesResolved;

    public function __construct(private readonly User $user)
    {
    }

    public function get(string $section, ?string $rulesetName = null): ?int
    {
        return match ($section) {
            'favouriteBeatmapsets' => $this->user->profileBeatmapsetsFavourite()->count(),
            'guestBeatmapsets' => $this->user->profileBeatmapsetsGuest()->count(),
            'nominatedBeatmapsets' => $this->user->profileBeatmapsetsNominated()->count(),

            'beatmapsModded' => $this->beatmapsModded(),
            'issuesResolved' => $this->issuesResolved(),

            'graveyardBeatmapsets',
            'lovedBeatmapsets',
            'pendingBeatmapsets',
            'rankedBeatmapsets' => $this->beatmapsetsByProfileSection()[$section] ?? 0,

            'beatmapPlaycounts' => $this->user->beatmapPlaycounts()->count(),
            'scoreReplayStats' => $this->scoreReplayStats(),
            'scoresRecent' => $this->scoresRecent($rulesetName),

            'recentActivity' => null,

            'recentlyReceivedKudosu' => null,

            'scoresBest' => $this->scoresBest($rulesetName),
            'scoresFirsts' => $this->scoresFirsts($rulesetName),
            'scoresPinned' => $this->scoresPinned($rulesetName),
        };
    }

    public function beatmapsetStatusCounts(): array
    {
        $counts = $this->beatmapsetCountsByApproved();
        $count = fn (string $state): int => (int) ($counts[Beatmapset::STATES[$state]] ?? 0);

        return [
            'graveyard' => $count('graveyard'),
            'loved' => $count('loved'),
            'pending' => $count('pending'),
            'qualified' => $count('qualified'),
            'ranked' => $count('ranked') + $count('approved'),
            'wip' => $count('wip'),
        ];
    }

    private function beatmapsModded(): int
    {
        return $this->beatmapsModded ??= $this->user->beatmapDiscussions()
            ->withoutTrashed()
            ->ofType(['suggestion', 'problem', 'review'])
            ->whereHas(
                'visibleBeatmapset',
                fn ($query) => $query->where('user_id', '<>', $this->user->getKey()),
            )
            ->distinct()
            ->count('beatmapset_id');
    }

    private function beatmapsetCountsByApproved(): array
    {
        return $this->beatmapsetCountsByApproved ??= $this->user
            ->beatmapsets()
            ->active()
            ->selectRaw('COUNT(*) as beatmapset_count, approved')
            ->groupBy('approved')
            ->pluck('beatmapset_count', 'approved')
            ->all();
    }

    private function beatmapsetsByProfileSection(): array
    {
        $counts = [];

        foreach ($this->beatmapsetCountsByApproved() as $approved => $count) {
            $section = static::BEATMAPSET_PROFILE_SECTION_MAP[$approved];
            $counts[$section] ??= 0;
            $counts[$section] += $count;
        }

        return $counts;
    }

    private function issuesResolved(): int
    {
        return $this->issuesResolved ??= BeatmapsetEvent::where('user_id', $this->user->getKey())
            ->where('type', BeatmapsetEvent::ISSUE_RESOLVE)
            ->distinct()
            ->count('comment->beatmap_discussion_id');
    }

    private function scoreReplayStats(): int
    {
        return $this->user->scoreReplayStats()->whereHas('score.beatmap')->countLimit(UsersController::MAX_RESULTS);
    }

    private function scoresBest(string $rulesetName): int
    {
        return count($this->user->beatmapBestScoreIds($rulesetName));
    }

    private function scoresFirsts(string $rulesetName): int
    {
        $legacyOnly = ScoreSearchParams::showLegacyForUser(\Auth::user());

        return $this->user->scoresFirst($rulesetName, $legacyOnly)->count();
    }

    private function scoresPinned(string $rulesetName): int
    {
        return $this->user->scorePins()->forRuleset($rulesetName)->withVisibleScore()->count();
    }

    private function scoresRecent(string $rulesetName): int
    {
        return $this->user->soloScores()->recent($rulesetName, false)->count();
    }
}
