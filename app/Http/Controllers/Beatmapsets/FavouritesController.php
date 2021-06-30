<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
                    return error_popup(osu_trans('beatmapsets.show.favourites.limit_reached'));
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
