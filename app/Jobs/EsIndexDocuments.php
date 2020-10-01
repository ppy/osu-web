<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs;

use App\Libraries\MorphMap;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EsIndexDocuments implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $batches;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $batches)
    {
        $this->batches = $batches;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        static $allowedTypes = ['beatmapset', 'user'];

        foreach ($this->batches as $type => $ids) {
            if (!in_array($type, $allowedTypes, true)) {
                continue;
            }

            $class = MorphMap::getClass($type);
            $dummy = new $class();

            $models = $class::esIndexingQuery()->whereIn($dummy->getKeyName(), $ids)->get();
            foreach ($models as $model) {
                // TODO: change to batch
                $model->esIndexDocument();
            }
        }
    }
}
