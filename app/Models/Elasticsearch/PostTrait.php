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
use App\Traits\EsIndexable;
use Carbon\Carbon;

trait PostTrait
{
    use EsIndexable;

    public function esRouting()
    {
        // Post and Topic should have the same routing for relationships to work.
        return $this->topic_id;
    }

    public function getEsId()
    {
        return "post-{$this->post_id}";
    }

    public function toEsJson()
    {
        $mappings = static::ES_MAPPINGS;

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

    public static function esAnalysisSettings()
    {
        static $settings = [
            'analyzer' => [
                'post_text_analyzer' => [
                    'tokenizer' => 'standard',
                    'filter' => ['lowercase'],
                    'char_filter' => ['html_filter'],
                ],
            ],
            'char_filter' => [
                'html_filter' => [
                    'type' => 'html_strip',
                ],
            ],
        ];

        return $settings;
    }

    public static function esIndexName()
    {
        return config('osu.elasticsearch.prefix').'posts';
    }

    public static function esIndexingQuery()
    {
        $forumIds = Forum::on('mysql-readonly')->where('enable_indexing', 1)->pluck('forum_id');

        return static::on('mysql-readonly')->withoutGlobalScopes()->whereIn('forum_id', $forumIds);
    }

    public static function esMappings()
    {
        return static::ES_MAPPINGS;
    }

    public static function esType()
    {
        return 'posts';
    }
}
