<?php

namespace App\Jobs;

use App\Models\BeatmapSet;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Raven_Client;
use App\Exceptions\SilencedException;
use League\StatsD;

class RegenerateBeatmapSetCover extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    protected $beatmapset;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(BeatmapSet $beatmapset)
    {
        $this->beatmapset = $beatmapset;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $statsd = StatsD\Client::instance('datadog');
        try {
            echo "Processing {$this->beatmapset->beatmapset_id}... ";
            $this->beatmapset->regenerateCovers();
            $statsd->increment(['thumbdonger.processed', 'thumbdonger.ok']);
            echo "ok.\n";
        } catch (\Exception $e) {
            $statsd->increment(['thumbdonger.processed', 'thumbdonger.error']);
            echo "errored.\n";
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
