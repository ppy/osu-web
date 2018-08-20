<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

namespace App\Libraries;

use App\Libraries\Elasticsearch\Es;
use App\Models\User;
use App\Models\Score\Best;

class UserBestScoresCheck
{
    /** @var User */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function check(string $mode)
    {
        $clazz = Best\Model::getClassByString($mode);

        $esIds = $this->user->beatmapBestScoreIds($mode, 100);
        $dbIds = $clazz::default()->whereIn('score_id', $esIds)->pluck('score_id')->all();

        return array_values(array_diff($esIds, $dbIds));
    }

    public function removeFromEs(string $mode, array $ids)
    {
        return Es::getClient('scores')->deleteByQuery([
            'index' => config('osu.elasticsearch.prefix')."high_scores_{$mode}",
            'body' => ['query' => ['terms' => ['score_id' => $ids]]],
        ]);
    }

    public function run(string $mode)
    {
        return $this->removeFromEs($mode, $this->check($mode));
    }
}
