<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
namespace App\Transformers;

use App\Models\Team;
use League\Fractal;

class TeamTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
    'members',
    'admins',
    ];

    public function transform(Team $team)
    {
        $profileCustomization = $team->profileCustomization()->firstOrNew([]);
        return [
            'id' => $team->id,
            'name' => $team->name,
            // probably going to drop this one, seems useless and makes us need to extend the function.
            'created' => display_regdate($team), // established since...
            'created_at' => $team->created_at->formatLocalized('%B %Y'), //December 2009
            'info' => $profileCustomization->info,
            'website' => $profileCustomization->website,
            'avatarUrl' => $team->avatarUrl,
            'cover' => [
                'customUrl' => $profileCustomization->cover->fileUrl(),
                'url' => $profileCustomization->cover->url(),
                'id' => $profileCustomization->cover->id(),
        ],
    ];
    }

    public function includeMembers(Team $team)
    {
        return $this->collection($team->teamMembers()->wherePivot('is_admin', 0)->get(), new UserTransformer());
    }

    public function includeAdmins(Team $team)
    {
        return $this->collection($team->teamMembers()->wherePivot('is_admin', 1)->get(), new UserTransformer());
    }
}
