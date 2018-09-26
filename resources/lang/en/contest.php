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

return [
    'header' => [
        'small' => 'Compete in more ways than just clicking circles.',
        'large' => 'Community Contests',
    ],
    'voting' => [
        'over' => 'Voting for this contest has ended',
        'login_required' => 'Please sign in to vote.',
        'best_of' => [
            'none_played' => "It doesn't look like you played any beatmaps that qualify for this contest!",
        ],
    ],
    'entry' => [
        '_' => 'entry',
        'login_required' => 'Please sign in to enter the contest.',
        'silenced_or_restricted' => 'You cannot enter contests while restricted or silenced.',
        'preparation' => 'We are currently preparing this contest. Please wait patiently!',
        'over' => 'Thank you for your entries! Submissions have closed for this contest and voting will open soon.',
        'limit_reached' => 'You have reached the entry limit for this contest',
        'drop_here' => 'Drop your entry here',
        'download' => 'Download .osz',
        'wrong_type' => [
            'art' => 'Only .jpg and .png files are accepted for this contest.',
            'beatmap' => 'Only .osu files are accepted for this contest.',
            'music' => 'Only .mp3 files are accepted for this contest.',
        ],
        'too_big' => 'Entries for this contest can only be up to :limit.',
    ],
    'beatmaps' => [
        'download' => 'Download Entry',
    ],
    'vote' => [
        'list' => 'votes',
        'count' => ':count vote|:count votes',
        'points' => ':count point|:count points',
    ],
    'dates' => [
        'ended' => 'Ended :date',

        'starts' => [
            '_' => 'Starts :date',
            'soon' => 'soon™',
        ],
    ],
    'states' => [
        'entry' => 'Entry Open',
        'voting' => 'Voting Started',
        'results' => 'Results Out',
    ],
];
