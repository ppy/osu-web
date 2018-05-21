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

namespace App\Models\Elasticsearch\Score;

use App\Model\Beatmap;
use App\Traits\EsIndexable;
use Carbon\Carbon;

trait BestTrait
{
    use EsIndexable;

    public function getEsId()
    {
        // one score per user-beatmap-mod combination.
        return "{$this->user_id}-{$this->beatmap_id}-{$this->getAttributes()['enabled_mods']}";
    }

    public function toEsJson()
    {
        $json = $this->attributesToArray();

        return $json;
    }

    public static function esIndexName()
    {
        $mode = strtolower(get_class_basename(get_called_class()));

        return config('osu.elasticsearch.prefix').'high_scores_'.$mode;
    }

    public static function esIndexingQuery()
    {
        return static::on('mysql-readonly')
            ->withoutGlobalScopes();
    }

    public static function esSchemaFile()
    {
        return config_path('schemas/high_scores.json');
    }

    public static function esType()
    {
        return 'high_score';
    }
}
