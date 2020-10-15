<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Elasticsearch;

use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Traits\EsIndexableModel;

trait TopicTrait
{
    use EsIndexableModel;

    public static function esIndexName()
    {
        return Post::esIndexName();
    }

    public static function esIndexingQuery()
    {
        $forumIds = Forum::where('enable_indexing', 1)->pluck('forum_id');

        return static::withoutGlobalScopes()->whereIn('forum_id', $forumIds)->with('forum');
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
        return $this->forum->enable_indexing
            && !$this->trashed()
            && $this->topic_moved_id === 0;
    }

    public function getEsId()
    {
        return "topic-{$this->topic_id}";
    }

    public function toEsJson()
    {
        $values = [
            'post_id' => $this->topic_first_post_id,
            'topic_id' => $this->topic_id,
            'poster_id' => $this->topic_poster,
            'forum_id' => $this->forum_id,
            'post_time' => json_time($this->topic_time),
            'search_content' => $this->topic_title,
            'type' => 'topics',
        ];

        return $values;
    }
}
