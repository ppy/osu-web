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

use App\Libraries\Elasticsearch\ModelIndexing;
use Closure;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use Es;
use Log;

trait Esindexable
{
    public function esDeleteDocument(array $options = [])
    {
        return Es::delete(
            array_merge([
                'index' => static::esIndexName(),
                'type' => static::esType(),
                'id' => $this->getKey(),
            ], $options)
        );
    }

    public function esIndexDocument(array $options = [])
    {
        $json = $this->toEsJson();
        $json['index'] = static::esIndexName();
        $json['type'] = static::esType();

        return Es::index(array_merge($json, $options));
    }

    public static function esHotReindex($batchSize = 1000, $name = null)
    {
        $newIndex = $name ?? static::esIndexName().'_'.time();
        Log::info("Creating new index {$newIndex}");
        static::esCreateIndex($newIndex);

        $options = [
            'index' => $newIndex,
        ];

        static::esReindexAll($batchSize, 0, $options);
        ModelIndexing::updateAlias(static::esIndexName(), $newIndex);

        return $newIndex;
    }

    /**
     * Paginates and indexes the recordsets using key-set pagination instead of
     *  the offset pagination used by chunk().
     */
    public static function esIndexEach(Closure $closure, $baseQuery, $batchSize, $fromId)
    {
        $keyColumn = (new static())->getKeyName();

        $count = 0;
        while (true) {
            $query = (clone $baseQuery)
                ->where($keyColumn, '>', $fromId)
                ->orderBy($keyColumn, 'asc')
                ->limit($batchSize);

            $models = $query->get();

            $next = null;
            foreach ($models as $model) {
                $next = $model;
                // $closure should return truthy value if indexed, falsey otherwise.
                if ($closure($model)
                    && ++$count % $batchSize === 0) {
                    Log::info(static::esType().': Indexed '.$count.' records.');
                }
            }

            if ($next === null) {
                break;
            }

            $fromId = $next->getKey();
            Log::info(static::esType().': next: '.$fromId);
        }

        return $count;
    }

    public static function esCreateIndex(string $name = null)
    {
        $type = static::esType();
        $params = [
            'index' => $name ?? static::esIndexName(),
            'body' => [
                'mappings' => [
                    $type => [
                        'properties' => static::esMappings(),
                    ]
                ],
            ],
        ];

        return Es::indices()->create($params);
    }

    public abstract static function esMappings();
    public abstract static function esType();
    public abstract static function esIndexName();
    public abstract static function esIndexingQuery();
    public abstract static function esReindexAll($batchSize, $fromId, array $options);

    public abstract function toEsJson();
}
