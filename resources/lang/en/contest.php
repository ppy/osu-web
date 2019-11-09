<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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

        'button' => [
            'add' => 'Vote',
            'remove' => 'Remove vote',
            'used_up' => 'You have used up all your votes',
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
        'count' => ':count_delimited vote|:count_delimited votes',
        'points' => ':count_delimited point|:count_delimited points',
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
