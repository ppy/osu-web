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
use Es;

trait PostTrait
{
    use EsIndexable;

    public function toEsJson()
    {
        return [
            'index' => static::esIndexName(),
            'type' => static::esType(),
            'id' => $this->post_id,
            'body' => $this->esPostValues(),
        ];
    }

    public static function esIndexName()
    {
        return 'posts';
    }

    public static function esType()
    {
        return 'posts';
    }

    public static function esMappings()
    {
        return static::ES_MAPPINGS;
    }

    public static function esReindexAll($batchSize = 1000, $fromId = 0, array $options = [])
    {
        $startTime = time();

        $forumIds = Forum::where('enable_indexing', 1)->pluck('forum_id');

        $baseQuery = static::withoutGlobalScopes()
            ->whereIn('forum_id', $forumIds)
            ->orderBy('post_id', 'asc')
            ->limit($batchSize);

        $count = static::esIndexEach(function ($model) use ($options) {
            Es::index(array_merge($model->toEsJson(), $options));
        }, $baseQuery, 'post_id', $batchSize, $fromId);

        $duration = time() - $startTime;
        \Log::info("Indexed {$count} records in {$duration} s.");
    }

    private function esPostValues()
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

        return $values;
    }
}
