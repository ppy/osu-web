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
        $until = $end->addDay();
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
            $until,
        );

        $nominations = $this->countsByDate(
            BeatmapsetEvent::where('user_id', $userId)
                ->where('type', BeatmapsetEvent::NOMINATE),
            $start,
            $until,
        );

        $ranks = $this->countsByDate(
            BeatmapsetEvent::where('type', BeatmapsetEvent::RANK)
                ->whereHas('beatmapset', fn ($query) => $query->where('user_id', $userId)),
            $start,
            $until,
        );

        $daysByDate = [];
        foreach (['nominations' => $nominations, 'posts' => $posts, 'ranks' => $ranks] as $type => $counts) {
            foreach ($counts as $date => $count) {
                $daysByDate[$date] ??= ['date' => $date];
                $daysByDate[$date][$type] = (int) $count;
            }
        }
        ksort($daysByDate);

        return [
            'days' => array_values($daysByDate),
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

    private function countsByDate(Builder $query, CarbonImmutable $start, CarbonImmutable $until): array
    {
        return $query
            ->where('created_at', '>=', $start)
            ->where('created_at', '<', $until)
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
