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

namespace App\Libraries\Elasticsearch;

use Elasticsearch\Common\Exceptions\Missing404Exception;
use Es;

class ModelIndexing
{
    public static function getOldIndices(string $alias)
    {
        try {
            // getAlias returns a dictionary where the keys are the names of the indices.
            return array_keys(Es::indices()->getAlias(['name' => $alias]));
        } catch (Missing404Exception $_e) {
            return [];
        }
    }

    /**
     * Creates an index with mappings from multiple types.
     * This is intended for compatibility with the existing index.
     */
    public static function createMultiTypeIndex(string $name, array $types)
    {
        $mappings = [];
        foreach ($types as $type) {
            $mappings[$type::esType()] = ['properties' => $type::esMappings()];
        }

        $params = [
            'index' => $name,
            'body' => [
                'mappings' => $mappings,
            ],
        ];

        return Es::indices()->create($params);
    }

    public static function updateAlias(string $alias, string $index)
    {
        $oldIndices = static::getOldIndices($alias);

        // updateAliases doesn't work if the alias doesn't exist :D
        if (count($oldIndices) === 0) {
            return Es::indices()->putAlias(['index' => $index, 'name' => $alias]);
        }

        $actions = [];
        foreach ($oldIndices as $oldIndex) {
            $actions[] = ['remove' => ['index' => $oldIndex, 'alias' => $alias]];
        }

        $actions[] = ['add' => ['index' => $index, 'alias' => $alias]];

        return Es::indices()->updateAliases([
            'body' => [
                'actions' => $actions,
            ],
        ]);
    }
}
