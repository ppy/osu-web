<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
use App\Traits\EsIndexable;

trait TopicTrait
{
    use EsIndexable;

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
            'post_time' => $this->topic_time->toIso8601String(),
            'search_content' => $this->topic_title,
            'type' => 'topics',
        ];

        return $values;
    }

    public static function esAnalysisSettings()
    {
        return Post::esAnalysisSettings();
    }

    public static function esIndexName()
    {
        return Post::esIndexName();
    }

    public static function esIndexingQuery()
    {
        $forumIds = Forum::on('mysql-readonly')->where('enable_indexing', 1)->pluck('forum_id');

        return static::on('mysql-readonly')->withoutGlobalScopes()->whereIn('forum_id', $forumIds);
    }

    public static function esMappings()
    {
        return Post::esMappings();
    }

    public static function esType()
    {
        return Post::esType();
    }
}
