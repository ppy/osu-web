<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
use Sentry\ClientBuilder;
use Sentry\State\Scope;

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
                $client = ClientBuilder::create(['dsn' => config('osu.beatmap_processor.sentry')])->getClient();
                $scope = (new Scope())->setTag('beatmapset_id', (string) $this->beatmapset->beatmapset_id);
                $client->captureException($e, $scope);
                throw new SilencedException('Silenced Exception: ['.get_class($e).'] '.$e->getMessage());
            } else {
                throw $e;
            }
        }
    }
}
