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

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Score\Best;
use App\Models\User;

class ReplaysController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function show($userId, $beatmapId, $mode)
    {
        $klass = Best\Model::getClassByString($mode);
        $user = User::lookup($userId, 'id');

        if ($user === null || !class_exists($klass)) {
            abort(404);
        }

        $score = $klass::forUser($user)
            ->where('beatmap_id', $beatmapId)
            ->where('replay', true)
            ->orderBy('score_id', 'desc')
            ->firstOrFail();

        // redirect any requests from outdated client versions.
        // TODO: remove
        return ujs_redirect(route('scores.download', ['mode' => $mode, 'score' => $score->getKey()]));
    }
}
