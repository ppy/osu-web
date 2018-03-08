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

use App\Exceptions\SilencedException;
use App\Models\Beatmapset;
use Datadog;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;
use Raven_Client;

class RegenerateBeatmapsetCover implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    protected $beatmapset;
    protected $sizesToRegenerate;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 300;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Beatmapset $beatmapset, array $sizesToRegenerate = null)
    {
        $this->beatmapset = $beatmapset;
        $this->sizesToRegenerate = $sizesToRegenerate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Log::info("[beatmapset_id: {$this->beatmapset->beatmapset_id}] Started cover regeneration.");
            $this->beatmapset->regenerateCovers($this->sizesToRegenerate);
            Datadog::increment(['thumbdonger.processed', 'thumbdonger.ok']);
            Log::info("[beatmapset_id: {$this->beatmapset->beatmapset_id}] Cover regeneration done.");
        } catch (Exception $e) {
            Datadog::increment(['thumbdonger.processed', 'thumbdonger.error']);
            Log::warning("[beatmapset_id: {$this->beatmapset->beatmapset_id}] Cover regeneration FAILED.");
            if (config('osu.beatmap_processor.sentry')) {
                $tags = [
                    'beatmapset_id' => $this->beatmapset->beatmapset_id,
                ];
                $client = new Raven_Client(config('osu.beatmap_processor.sentry'), ['tags' => $tags]);
                $client->captureException($e);
                throw new SilencedException('Silenced Exception: ['.get_class($e).'] '.$e->getMessage());
            } else {
                throw $e;
            }
        }
    }
}
