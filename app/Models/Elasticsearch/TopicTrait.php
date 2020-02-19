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

namespace App\Models\Elasticsearch;

use App\Models\Forum\Forum;
use App\Models\Forum\Post;
use App\Traits\EsIndexableModel;

trait TopicTrait
{
    use EsIndexableModel;

    public function esRouting()
    {
        // Post and Topic should have the same routing for relationships to work.
        return $this->topic_id;
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

    public static function esIndexName()
    {
        return Post::esIndexName();
    }

    public static function esIndexingQuery()
    {
        $forumIds = Forum::on('mysql')->where('enable_indexing', 1)->pluck('forum_id');

        return static::on('mysql')->withoutGlobalScopes()->whereIn('forum_id', $forumIds);
    }

    public static function esSchemaFile()
    {
        return Post::esSchemaFile();
    }

    public static function esType()
    {
        return Post::esType();
    }

    public function esShouldIndex()
    {
        return $this->forum->enable_indexing
            && !$this->trashed()
            && $this->topic_moved_id === 0;
    }
}
