<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Elasticsearch;

use App\Models\Forum\Forum;
use App\Traits\EsIndexableModel;
use Carbon\Carbon;

trait PostTrait
{
    use EsIndexableModel;

    public static function esIndexName()
    {
        return config('osu.elasticsearch.prefix').'posts';
    }

    public static function esIndexingQuery()
    {
        $forumIds = Forum::where('enable_indexing', 1)->pluck('forum_id');

        return static::withoutGlobalScopes()->whereIn('forum_id', $forumIds)->with('forum');
    }

    public static function esSchemaFile()
    {
        return config_path('schemas/posts.json');
    }

    public function esRouting()
    {
        // Post and Topic should have the same routing for relationships to work.
        return $this->topic_id;
    }

    public function esShouldIndex()
    {
        return $this->forum->enable_indexing && !$this->trashed();
    }

    public function getEsId()
    {
        return "post-{$this->post_id}";
    }

    public function toEsJson()
    {
        $mappings = static::esMappings();

        $values = [];
        foreach ($mappings as $field => $mapping) {
            $value = $this[$field];
            if ($value instanceof Carbon) {
                $value = $value->toIso8601String();
            }

            $values[$field] = $value;
        }

        $values['type'] = [
            'name' => 'posts',
            'parent' => "topic-{$this->topic_id}",
        ];

        return $values;
    }
}
