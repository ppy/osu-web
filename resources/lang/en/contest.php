<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Compete in more ways than just clicking circles.',
        'large' => 'Community Contests',
    ],

    'index' => [
        'nav_title' => 'listing',
    ],

    'judge' => [
        'comments' => 'comments',
        'hide_judged' => 'hide judged entries',
        'nav_title' => 'judge',
        'no_current_vote' => 'you didn\'t vote yet.',
        'update' => 'update',
        'validation' => [
            'missing_score' => 'missing score',
            'contest_vote_judged' => 'can\'t vote in judged contests',
        ],
        'voted' => 'You already submitted a vote on this entry.',
    ],

    'judge_results' => [
        '_' => 'Judging results',
        'creator' => 'creator',
        'score' => 'Score',
        'score_std' => 'Standardised Score',
        'total_score' => 'total score',
        'total_score_std' => 'total standardised score',
    ],

    'voting' => [
        'judge_link' => 'You are a judge of this contest. Judge the entries here!',
        'judged_notice' => 'This contest is using the judging system, the judges are currently processing the entries.',
        'login_required' => 'Please sign in to vote.',
        'over' => 'Voting for this contest has ended',
        'show_voted_only' => 'Show voted',

        'best_of' => [
            'none_played' => "It doesn't look like you played any beatmaps that qualify for this contest!",
        ],

        'button' => [
            'add' => 'Vote',
            'remove' => 'Remove vote',
            'used_up' => 'You have used up all your votes',
        ],

        'progress' => [
            '_' => ':used / :max votes used',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Must play all beatmaps in the specified playlists before voting',
            ],
        ],
    ],

    'entry' => [
        '_' => 'entry',
        'login_required' => 'Please sign in to enter the contest.',
        'silenced_or_restricted' => 'You cannot enter contests while restricted or silenced.',
        'preparation' => 'We are currently preparing this contest. Please wait patiently!',
        'drop_here' => 'Drop your entry here',
        'allowed_extensions' => ':types files are accepted',
        'max_size' => 'Max size: :limit',
        'download' => 'Download .osz',
        'wrong_file_type' => 'Only :types files are accepted for this contest.',
        'wrong_dimensions' => 'Entries for this contest must be :widthx:height',
        'too_big' => 'Entries for this contest can only be up to :limit.',
    ],

    'beatmaps' => [
        'download' => 'Download Entry',
    ],

    'vote' => [
        'list' => 'votes',
        'count' => ':count_delimited vote|:count_delimited votes',
        'points' => ':count_delimited point|:count_delimited points',
        'points_float' => ':points points',
    ],

    'dates' => [
        'ended' => 'Ended :date',
        'ended_no_date' => 'Ended',

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

    'show' => [
        'admin' => [
            'page' => 'View info and entries',
        ],
    ],
];
