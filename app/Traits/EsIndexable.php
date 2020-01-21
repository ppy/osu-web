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
use DateTime;

trait EsIndexable
{
    abstract public static function esIndexName();

    abstract public static function esSchemaFile();

    abstract public static function esType();

    public static function esCreateIndex(string $name = null)
    {
        // TODO: allow overriding of certain settings (shards, replicas, etc)?
        $params = [
            'index' => $name ?? static::esIndexName(),
            'body' => static::esSchemaConfig(),
        ];

        return Es::getClient()->indices()->create($params);
    }

    public static function esMappings()
    {
        return static::esSchemaConfig()['mappings'][static::esType()]['properties'];
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
