<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

namespace App\Traits;

use App\Libraries\Elasticsearch\Es;
use Log;

trait EsModelIndexable
{
    use EsIndexable;

    abstract public static function esIndexingQuery();

    public function getEsId()
    {
        return $this->getKey();
    }

    public static function esCount()
    {
        return static::esIndexingQuery()->count();
    }

    public static function esReindexAll(array $options = [], callable $progress = null)
    {
        $batchSize = $options['batchSize'] ?? 1000;
        $fromId = $options['fromId'] ?? 0;

        $dummy = new static();
        $isSoftDeleting = method_exists($dummy, 'getDeletedAtColumn');
        $startTime = time();

        $baseQuery = static::esIndexingQuery()->where($dummy->getKeyName(), '>', $fromId);
        $count = 0;

        $baseQuery->chunkById($batchSize, function ($models) use ($options, $isSoftDeleting, &$count, $progress) {
            $actions = [];

            foreach ($models as $model) {
                $next = $model;
                // bulk API am speshul.
                $metadata = [
                    '_id' => $model->getEsId(),
                    'routing' => $model->esRouting(),
                ];

                if ($isSoftDeleting && $model->trashed()) {
                    $actions[] = ['delete' => $metadata];
                } else {
                    // index requires action and metadata followed by data on the next line.
                    $actions[] = ['index' => $metadata];
                    $actions[] = $model->toEsJson();
                }
            }

            if ($actions !== []) {
                $result = Es::getClient()->bulk([
                    'index' => $options['index'] ?? static::esIndexName(),
                    'type' => static::esType(),
                    'body' => $actions,
                    'client' => ['timeout' => 0],
                ]);

                $count += count($result['items']);
            }

            Log::info(static::class." next: {$models->last()->getKey()}");
            if ($progress) {
                $progress($count);
            }
        });

        $duration = time() - $startTime;
        Log::info(static::class." Indexed {$count} records in {$duration} s.");
    }
}
