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

namespace App\Http\Controllers\Beatmapsets;

use App\Exceptions\InvariantException;
use App\Http\Controllers\Controller;
use App\Models\Beatmapset;

class FavouritesController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function store($beatmapsetId)
    {
        $beatmapset = Beatmapset::findOrFail($beatmapsetId);
        $user = auth()->user();

        switch (request('action')) {
            case 'favourite':
                if ($user->favouriteBeatmapsets()->count() >= $user->beatmapsetFavouriteAllowance()) {
                    return error_popup(trans('beatmapsets.show.favourites.limit_reached'));
                }
                $beatmapset->favourite($user);
                break;

            case 'unfavourite':
                $beatmapset->unfavourite($user);
                break;

            default:
                throw new InvariantException('Invalid action');
        }

        return [
            'favourite_count' => $beatmapset->fresh()->favourite_count,
        ];
    }
}
