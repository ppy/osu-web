<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs;

use App\Libraries\Elasticsearch\Es;
use App\Libraries\Elasticsearch\Indexable;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class EsIndexDocumentBulk implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected $className;
    protected $ids;

    public function __construct(string $className, array $ids)
    {
        if (!is_a($className, Indexable::class, true)) {
            throw new Exception("{$className} is not indexable.");
        }

        $this->className = $className;
        $this->ids = $ids;
    }

    public function handle()
    {
        $dummy = new $this->className();

        $chunks = array_chunk($this->ids, Es::CHUNK_SIZE);
        foreach ($chunks as $chunk) {
            $models = $this->className::esIndexingQuery()->whereIn($dummy->getKeyName(), $chunk)->get();
            $actions = Es::generateBulkActions($models);
            if (!empty($actions)) {
                // TODO: handling response would be nice =)
                Es::getClient()->bulk([
                    'index' => $this->className::esIndexName(),
                    'type' => '_doc',
                    'body' => $actions,
                    'client' => ['timeout' => 0],
                ]);
            }
        }
    }
}
