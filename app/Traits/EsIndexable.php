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

trait EsIndexable
{
    abstract public static function esIndexName();

    abstract public static function esSchemaFile();

    abstract public static function esType();

    abstract public static function esCount();

    abstract public function toEsJson();

    /**
     * The value for routing.
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
        // null will result in an id assigned by elastic
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

        return Es::getClient()->delete($document);
    }

    public function esIndexDocument(array $options = [])
    {
        if (method_exists($this, 'esShouldIndex') && !$this->esShouldIndex()) {
            return $this->esDeleteDocument($options);
        }

        $document = array_merge([
            'index' => static::esIndexName(),
            'type' => static::esType(),
            'routing' => $this->esRouting(),
            'id' => $this->getEsId(),
            'body' => $this->toEsJson(),
        ], $options);

        return Es::getClient()->index($document);
    }

    public static function esCreateIndex(string $name = null)
    {
        // TODO: allow overriding of certain settings (shards, replicas, etc)?
        $params = [
            'index' => $name ?? static::esIndexName(),
            'body' => static::esSchemaConfig(),
        ];

        return Es::getClient()->indices()->create($params);
    }

    public static function esIndexIntoNew(array $options = [], callable $progress = null)
    {
        $newIndex = $options['index'] ?? static::esIndexName().'_'.time();
        Log::info("Creating new index {$newIndex}");
        static::esCreateIndex($newIndex);

        $options['index'] = $newIndex;

        static::esReindexAll($options, $progress);

        return $newIndex;
    }

    public static function esMappings()
    {
        return static::esSchemaConfig()['mappings'][static::esType()]['properties'];
    }

    abstract public static function esReindexAll(array $options = [], callable $progress = null);

    public static function esSchemaConfig()
    {
        static $schema;
        if (!isset($schema)) {
            $schema = json_decode(file_get_contents(static::esSchemaFile()), true);
        }

        return $schema;
    }
}
