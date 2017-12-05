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

namespace App\Traits;

use Es;

trait Esindexable
{
    /**
     * Paginates and indexes the recordsets using key-set pagination instead of
     *  the offset pagination used by chunk().
     */
    public static function esIndexEach($baseQuery, $keyColumn, $batchSize, $fromId)
    {
        $count = 0;
        while (true) {
            $query = (clone $baseQuery)
                ->where($keyColumn, '>', $fromId)
                ->orderBy($keyColumn, 'asc')
                ->limit($batchSize);

            $models = $query->get();

            $next = null;
            foreach ($models as $model) {
                $next = $model;
                // FIXME: only check if soft delete supported
                if ($model->trashed()) {
                    continue;
                }

                Es::index($model->toEsJson());

                ++$count;
                if ($count % $batchSize === 0) {
                    \Log::info("Indexed {$count} records.");
                }
            }

            if ($next === null) {
                break;
            }

            $fromId = $next->getKey();
            \Log::info("next: {$fromId}");
        }

        return $count;
    }

    public abstract function toEsJson();
}
