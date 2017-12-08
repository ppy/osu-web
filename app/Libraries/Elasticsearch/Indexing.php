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

class Indexing
{
    public static function deleteIndex(string $name)
    {
        return Es::indices()->delete([
            'index' => $name,
            'client' => ['ignore' => 404],
        ]);
    }

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

    /**
     * Updates the index alias to point to the given index and unaliases any
     *  existing indices.
     *
     * @param string $alias Name of the alias.
     * @param array $indices Names of the indices to alias.
     */
    public static function updateAlias(string $alias, array $indices)
    {
        $oldIndices = static::getOldIndices($alias);

        // updateAliases doesn't work if the alias doesn't exist :D
        if (count($oldIndices) === 0) {
            return Es::indices()->putAlias(['index' => $indices, 'name' => $alias]);
        }

        $actions = [];
        foreach ($oldIndices as $oldIndex) {
            $actions[] = ['remove' => ['index' => $oldIndex, 'alias' => $alias]];
        }

        foreach ($indices as $index) {
            $actions[] = ['add' => ['index' => $index, 'alias' => $alias]];
        }

        return Es::indices()->updateAliases([
            'body' => [
                'actions' => $actions,
            ],
        ]);
    }
}
