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

namespace App\Traits;

use App\Libraries\Elasticsearch\Indexing;
use Es;
use Log;

trait EsIndexable
{
    abstract public static function esIndexName();

    abstract public static function esIndexingQuery();

    abstract public static function esMappings();

    abstract public static function esType();

    abstract public function toEsJson();

    /**
     * The value for _routing.
     * Override to provide a routing value; null by default.
     *
     * @return string|null
     */
    public function esRouting()
    {
        // null will be omitted when used as routing.
    }

    public function getEsId()
    {
        return $this->getKey();
    }

    public function esDeleteDocument(array $options = [])
    {
        $document = array_merge([
            'index' => static::esIndexName(),
            'type' => static::esType(),
            'routing' => $this->esRouting(),
            'id' => $this->getEsId(),
            'client' => ['ignore' => 404],
        ], $options);

        return Es::delete($document);
    }

    public function esIndexDocument(array $options = [])
    {
        $document = array_merge([
            'index' => static::esIndexName(),
            'type' => static::esType(),
            'routing' => $this->esRouting(),
            'id' => $this->getEsId(),
            'body' => $this->toEsJson(),
        ], $options);

        return Es::index($document);
    }

    public static function esCreateIndex(string $name = null)
    {
        $type = static::esType();
        $body = [
            'mappings' => [
                $type => [
                    'properties' => static::esMappings(),
                ],
            ],
        ];

        if (method_exists(get_called_class(), 'esAnalysisSettings')) {
            $settings = [
                'settings' => [
                    'analysis' => static::esAnalysisSettings(),
                ],
            ];

            $body = array_merge($body, $settings);
        }

        $params = [
            'index' => $name ?? static::esIndexName(),
            'body' => $body,
        ];

        return Es::indices()->create($params);
    }

    public static function esIndexIntoNew($batchSize = 1000, $name = null, callable $progress = null)
    {
        $newIndex = $name ?? static::esIndexName().'_'.time();
        Log::info("Creating new index {$newIndex}");
        static::esCreateIndex($newIndex);

        $options = [
            'index' => $newIndex,
        ];

        static::esReindexAll($batchSize, 0, $options, $progress);
        Indexing::updateAlias(static::esIndexName(), [$newIndex]);

        return $newIndex;
    }

    public static function esReindexAll($batchSize = 1000, $fromId = 0, array $options = [], callable $progress = null)
    {
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
                    '_routing' => $model->esRouting(),
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
                $result = Es::bulk([
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
