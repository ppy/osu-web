<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Traits\Es;

use App\Models\Forum\Forum;

trait ForumPostSearch
{
    use BaseDbIndexable;

    public static function esIndexName()
    {
        return $GLOBALS['cfg']['osu']['elasticsearch']['prefix'].'posts';
    }

    public static function esIndexingQuery()
    {
        $forumIds = Forum::where('enable_indexing', 1)->pluck('forum_id');

        return static::withoutGlobalScopes()->whereIn('forum_id', $forumIds)->with('forum')->with('topic');
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
        return $this->forum->enable_indexing && $this->topic !== null;
    }

    public function getEsId()
    {
        return "post-{$this->post_id}";
    }

    protected function getEsFieldValue(string $field)
    {
        return match ($field) {
            'is_deleted' => $this->trashed() || $this->topic->trashed(),
            'topic_title' => $this->topic !== null && $this->topic->topic_first_post_id === $this->getKey()
                    ? $this->topic->topic_title
                    : null,
            default => $this->$field,
        };
    }
}
