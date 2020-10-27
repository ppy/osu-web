<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Elasticsearch;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class Es
{
    // default size to use for chunk/chunkById.
    public const CHUNK_SIZE = 1000;

    public static function generateBulkActions($models)
    {
        $actions = [];

        foreach ($models as $model) {
            // bulk API am speshul.
            $metadata = [
                '_id' => $model->getEsId(),
                'routing' => $model->esRouting(),
            ];

            if (!$model->esShouldIndex()) {
                $actions[] = ['delete' => $metadata];
            } else {
                // index requires action and metadata followed by data on the next line.
                $actions[] = ['index' => $metadata];
                $actions[] = $model->toEsJson();
            }
        }

        return $actions;
    }

    public static function getClient(string $name = 'default'): Client
    {
        static $clients = [];

        if (!array_key_exists($name, $clients)) {
            $config = $name === 'default' ? 'elasticsearch' : "elasticsearch_{$name}";
            $clients[$name] = ClientBuilder::fromConfig(config($config));
        }

        return $clients[$name];
    }
}
