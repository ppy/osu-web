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

namespace App\Jobs;

use App\Libraries\Elasticsearch\BoolQuery;
use App\Libraries\Elasticsearch\Es;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Score\Best as ScoreBest;
use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class RemoveBeatmapsetBestScores implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $timeout = 600;
    public $beatmapset;
    public $maxScoreIds = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Beatmapset $beatmapset)
    {
        $this->beatmapset = $beatmapset;

        foreach (Beatmap::MODES as $mode => $_modeInt) {
            $this->maxScoreIds[$mode] = static::scoreClass($mode)::max('score_id');
        }
    }

    public function scoreClass($mode)
    {
        return ScoreBest::class.'\\'.studly_case($mode);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $beatmapIds = model_pluck($this->beatmapset->beatmaps(), 'beatmap_id');

        foreach (Beatmap::MODES as $mode => $_modeInt) {
            $query = new BoolQuery;
            $query->filter(['terms' => ['beatmap_id' => $beatmapIds]]);
            $query->filter(['range' => ['score_id' => ['lte' => $this->maxScoreIds[$mode]]]]);

            // TODO: do something with response?
            Es::getClient('scores')->deleteByQuery([
                'index' => config('osu.elasticsearch.prefix')."high_scores_{$mode}",
                'body' => ['query' => $query->toArray()],
            ]);

            $class = static::scoreClass($mode);
            $table = (new $class)->getTable();
            $class::whereIn('beatmap_id', $beatmapIds)
                ->orderBy('score_id')
                ->where('score_id', '<=', $this->maxScoreIds[$mode])
                ->from(DB::raw("{$table} FORCE INDEX (beatmap_score_lookup)")) // TODO: fixes an issue with MySQL 5.6; remove after updating.
                ->chunkById(100, function ($scores) {
                    $scores->each->delete();
                });
        }
    }
}
