<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Elasticsearch;

use Elasticsearch\Common\Exceptions\Missing404Exception;

class Indexing
{
    public static function deleteIndex(string $name)
    {
        return Es::getClient()->indices()->delete([
            'index' => $name,
            'client' => ['ignore' => 404],
        ]);
    }

    public static function getOldIndices(string $alias)
    {
        try {
            // getAlias returns a dictionary where the keys are the names of the indices.
            return array_keys(Es::getClient()->indices()->getAlias(['name' => $alias]));
        } catch (Missing404Exception $_e) {
            return [];
        }
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
            return Es::getClient()->indices()->putAlias(['index' => $indices, 'name' => $alias]);
        }

        $actions = [];
        foreach ($oldIndices as $oldIndex) {
            $actions[] = ['remove' => ['index' => $oldIndex, 'alias' => $alias]];
        }

        foreach ($indices as $index) {
            $actions[] = ['add' => ['index' => $index, 'alias' => $alias]];
        }

        return Es::getClient()->indices()->updateAliases([
            'body' => [
                'actions' => $actions,
            ],
        ]);
    }
}
