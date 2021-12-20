<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Traits\Es;

use App\Libraries\Elasticsearch\Es;
use DateTime;

trait BaseIndexable
{
    abstract public static function esIndexName();

    abstract public static function esSchemaFile();

    public static function esCreateIndex(string $name = null)
    {
        // TODO: allow overriding of certain settings (shards, replicas, etc)?
        $params = [
            'include_type_name' => 'true',
            'index' => $name ?? static::esIndexName(),
            'body' => static::esSchemaConfig(),
        ];

        return Es::getClient()->indices()->create($params);
    }

    public static function esMappings()
    {
        return static::esSchemaConfig()['mappings']['_doc']['properties'];
    }

    public static function esSchemaConfig()
    {
        static $schema;
        if (!isset($schema)) {
            $schema = json_decode(file_get_contents(static::esSchemaFile()), true);
        }

        return $schema;
    }

    public static function esTimestampedIndexName(?DateTime $time = null)
    {
        return static::esIndexName().'_'.($time ?? now())->format('YmdHis');
    }
}
