<?php

namespace App\Jobs;

use App\Exceptions\SilencedException;
use App\Models\Beatmapset;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Raven_Client;
use Statsd;

class RegenerateBeatmapsetCover implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    protected $beatmapset;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Beatmapset $beatmapset)
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
        try {
            echo "Processing {$this->beatmapset->beatmapset_id}... ";
            $this->beatmapset->regenerateCovers();
            Statsd::increment(['thumbdonger.processed', 'thumbdonger.ok']);
            echo "ok.\n";
        } catch (\Exception $e) {
            Statsd::increment(['thumbdonger.processed', 'thumbdonger.error']);
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
