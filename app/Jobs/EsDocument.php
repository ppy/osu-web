<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class EsDocument implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    private array $modelMeta;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($model)
    {
        $this->modelMeta = [
            'class' => get_class($model),
            'id' => $model->getKey(),
        ];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $id = $this->modelMeta['id'];

        if (!is_scalar($id)) {
            log_error(new Exception("can't index models with unsupported primary key: ".json_encode($id)));

            return;
        }

        $class = $this->modelMeta['class'];
        $query = $class::query();

        if ($class::hasMacro('withTrashed')) {
            $query->withTrashed();
        }

        $model = $query->find($id);

        if ($model !== null) {
            $model->esIndexDocument();

            return;
        }

        $model = new $class();
        $keyName = $model->getKeyName();
        $model->setAttribute($keyName, $id);
        $model->esDeleteDocument();
    }
}
