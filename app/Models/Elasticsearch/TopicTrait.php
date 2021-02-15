<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Elasticsearch;

use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Traits\EsIndexableModel;

// TODO: this should be removed eventually
trait TopicTrait
{
    use EsIndexableModel;

    public static function esIndexName()
    {
        return Post::esIndexName();
    }

    public static function esIndexingQuery()
    {
        return static::none();
    }

    public static function esSchemaFile()
    {
        return Post::esSchemaFile();
    }

    public function esRouting()
    {
        // Post and Topic should have the same routing for relationships to work.
        return $this->topic_id;
    }

    public function esShouldIndex()
    {
        return false;
    }

    public function getEsId()
    {
        return "topic-{$this->topic_id}";
    }

    public function toEsJson()
    {
        return [];
    }
}
