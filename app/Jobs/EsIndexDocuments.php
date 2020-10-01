<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs;

use App\Libraries\Elasticsearch\Indexable;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EsIndexDocuments implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ids;
    protected $type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $type, array $ids)
    {
        if (!new $type() instanceof Indexable) {
            throw new Exception("{$type} is not indexable.");
        }

        $this->type = $type;
        $this->ids = $ids;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dummy = new $this->type();

        $models = $this->type::esIndexingQuery()->whereIn($dummy->getKeyName(), $this->ids)->get();
        foreach ($models as $model) {
            // TODO: change to batch
            $model->esIndexDocument();
        }
    }
}
