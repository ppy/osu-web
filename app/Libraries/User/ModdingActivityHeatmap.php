<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\User;

use App\Models\BeatmapDiscussionPost;
use App\Models\BeatmapsetEvent;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;

class ModdingActivityHeatmap
{
    private const CACHE_DURATION = 6 * 3600;

    public function __construct(private readonly User $user)
    {
    }

    public function calculate(): array
    {
        [$start, $end] = $this->window();
        $userId = $this->user->getKey();

        $posts = $this->countsByDate(
            BeatmapDiscussionPost::where('user_id', $userId)
                ->withoutSystem()
                ->visible()
                ->whereHas(
                    'beatmapDiscussion.visibleBeatmapset',
                    fn ($query) => $query->where('user_id', '<>', $userId),
                ),
            $start,
            $end,
        );

        $nominations = $this->countsByDate(
            BeatmapsetEvent::where('user_id', $userId)
                ->where('type', BeatmapsetEvent::NOMINATE),
            $start,
            $end,
        );

        $ranks = $this->countsByDate(
            BeatmapsetEvent::where('type', BeatmapsetEvent::RANK)
                ->whereHas('beatmapset', fn ($query) => $query->where('user_id', $userId)),
            $start,
            $end,
        );

        $dates = array_keys($posts + $nominations + $ranks);
        sort($dates);

        $days = [];
        foreach ($dates as $date) {
            $days[] = [
                'date' => $date,
                'nominations' => (int) ($nominations[$date] ?? 0),
                'posts' => (int) ($posts[$date] ?? 0),
                'ranks' => (int) ($ranks[$date] ?? 0),
            ];
        }

        return [
            'days' => $days,
            'end_date' => json_date($end),
            'start_date' => json_date($start),
        ];
    }

    public function get(): array
    {
        return \Cache::remember(
            "modding_activity_heatmap:{$this->user->getKey()}:".json_date(CarbonImmutable::now('UTC')),
            static::CACHE_DURATION,
            fn () => $this->calculate(),
        );
    }

    private function countsByDate(Builder $query, CarbonImmutable $start, CarbonImmutable $end): array
    {
        return $query
            ->where('created_at', '>=', $start)
            ->where('created_at', '<', $end->addDay())
            ->toBase()
            ->selectRaw('DATE(created_at) date, COUNT(*) count')
            ->groupBy('date')
            ->pluck('count', 'date')
            ->all();
    }

    private function window(): array
    {
        $end = CarbonImmutable::now('UTC')->startOfDay();

        return [$end->subMonths(7)->startOfWeek(CarbonImmutable::MONDAY), $end];
    }
}
