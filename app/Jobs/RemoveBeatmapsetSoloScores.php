<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Jobs;

use App\Libraries\Search\ScoreSearch;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Solo\Score;
use App\Models\UserStatistics\Model as UserStatisticsModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Support\Arr;

class RemoveBeatmapsetSoloScores implements ShouldQueue
{
    use InteractsWithQueue, Queueable;

    public $timeout = 36000;

    private int $beatmapsetId;
    private array $maniaConvertKeys = [];
    private int $maxScoreId;
    private array $schemas;
    private ScoreSearch $scoreSearch;
    private bool $shouldRecalculateUserRankCounts = false;
    private array $userBestScores;

    public function __construct(Beatmapset $beatmapset, bool $shouldRecalculateUserRankCounts)
    {
        $this->beatmapsetId = $beatmapset->getKey();
        $this->maxScoreId = Score::max('id') ?? 0;

        // Separate setter to allow the default be set when deserialising old jobs.
        // TODO: move to constructor argument after deployment
        $this->shouldRecalculateUserRankCounts = $shouldRecalculateUserRankCounts;
    }

    public function displayName()
    {
        return static::class." (Beatmapset {$this->beatmapsetId})";
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->scoreSearch = new ScoreSearch();
        $this->schemas = $this->scoreSearch->getActiveSchemas();
        $this->userBestScores = [];

        $beatmapIds = Beatmap::where('beatmapset_id', $this->beatmapsetId)->pluck('beatmap_id');
        Score
            ::whereIn('beatmap_id', $beatmapIds)
            ->where('id', '<=', $this->maxScoreId)
            ->with('beatmap')
            ->chunkById(1000, function ($scores) {
                $this->recordUserBestScores($scores);
                $this->deleteScores($scores);
            });
        $this->updateUserStatistics();
    }

    public function middleware(): array
    {
        return [new WithoutOverlapping((string) $this->beatmapsetId, $this->timeout, $this->timeout)];
    }

    private function deleteScores(Collection $scores): void
    {
        $ids = $scores->pluck('id')->all();

        Score::whereKey($ids)->update(['ranked' => false]);
        ScoreSearch::queueForIndex($this->schemas, $ids);
    }

    private function getScoreVariants(Score $score): array
    {
        $ret = ['all'];
        if ($score->ruleset_id === Beatmap::MODES['mania'] && $score->beatmap !== null) {
            $beatmap = $score->beatmap;
            $keys = null;
            if ($beatmap->playmode === $score->ruleset_id) {
                $keys = $beatmap->diff_size;
            } else {
                foreach ($score->data->mods as $mod) {
                    if ($mod->acronym === '4K') {
                        $keys = 4;
                        break;
                    } elseif ($mod->acronym === '7K') {
                        $keys = 7;
                        break;
                    }
                }
                if (!isset($keys)) {
                    $beatmapId = $beatmap->getKey();
                    if (!isset($this->maniaConvertKeys[$beatmapId])) {
                        $convertBeatmap = clone $beatmap;
                        $convertBeatmap->convert = true;
                        $convertBeatmap->playmode = Beatmap::MODES['mania'];
                        $this->maniaConvertKeys[$beatmapId] = $convertBeatmap->diff_size;
                    }
                    $keys = $this->maniaConvertKeys[$beatmapId];
                }
            }
            if ($keys === 4 || $keys === 7) {
                $ret[] = "{$keys}k";
            }
        }

        return $ret;
    }

    private function recordUserBestScores(Collection $scores): void
    {
        if (!$this->shouldRecalculateUserRankCounts) {
            return;
        }

        foreach ($scores as $score) {
            if (!$score->ranked) {
                continue;
            }

            $variants = $this->getScoreVariants($score);
            foreach ($variants as $variant) {
                $key = "{$score->ruleset_id}.{$variant}.{$score->user_id}.{$score->beatmap_id}";
                $prevScore = Arr::get($this->userBestScores, $key);
                if ($prevScore === null || $score->total_score > $prevScore->total_score) {
                    Arr::set($this->userBestScores, $key, $score);
                }
            }
        }
    }

    private function updateUserStatistics(): void
    {
        if (!$this->shouldRecalculateUserRankCounts) {
            return;
        }

        static $rankToColumn = [
            'A' => 'a_rank_count',
            'S' => 's_rank_count',
            'SH' => 'sh_rank_count',
            'X' => 'x_rank_count',
            'XH' => 'xh_rank_count',
        ];

        foreach ($this->userBestScores as $rulesetId => $byVariant) {
            foreach ($byVariant as $variant => $byUserId) {
                $class = UserStatisticsModel::getClass(
                    Beatmap::modeStr($rulesetId),
                    $variant === 'all' ? null : $variant,
                );
                foreach ($byUserId as $userId => $byBeatmapId) {
                    $statistics = $class::find($userId);
                    if ($statistics === null) {
                        continue;
                    }
                    $changes = [
                        'a_rank_count' => 0,
                        's_rank_count' => 0,
                        'sh_rank_count' => 0,
                        'x_rank_count' => 0,
                        'xh_rank_count' => 0,
                    ];
                    foreach ($byBeatmapId as $score) {
                        $column = $rankToColumn[$score->rank] ?? null;
                        if ($column !== null) {
                            $changes[$column]--;
                        }
                    }
                    foreach ($changes as $column => $change) {
                        if ($change !== 0) {
                            $statistics->$column = db_unsigned_increment($column, $change);
                        }
                    }
                    $statistics->save();
                }
            }
        }
    }
}
