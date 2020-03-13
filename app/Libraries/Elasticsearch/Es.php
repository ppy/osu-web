<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Elasticsearch;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class Es
{
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
