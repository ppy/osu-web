<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'This beatmap is currently not available for download.',
        'parts-removed' => 'Portions of this beatmap have been removed at the request of the creator or a third-party rights holder.',
        'more-info' => 'Check here for more information.',
    ],

    'index' => [
        'title' => 'Beatmaps Listing',
        'guest_title' => 'Beatmaps',
    ],

    'panel' => [
        'download' => [
            'all' => 'download',
            'video' => 'download with video',
            'no_video' => 'download without video',
            'direct' => 'open in osu!direct',
        ],
    ],

    'show' => [
        'discussion' => 'Discussion',

        'details' => [
            'favourite' => 'Favourite this beatmapset',
            'logged-out' => 'You need to sign in before downloading any beatmaps!',
            'mapped_by' => 'mapped by :mapper',
            'unfavourite' => 'Unfavourite this beatmapset',
            'updated_timeago' => 'last updated :timeago',

            'download' => [
                '_' => 'Download',
                'direct' => 'osu!direct',
                'no-video' => 'without Video',
                'video' => 'with Video',
            ],

            'login_required' => [
                'bottom' => 'to access more features',
                'top' => 'Sign In',
            ],
        ],

        'details_date' => [
            'approved' => 'approved :timeago',
            'loved' => 'loved :timeago',
            'qualified' => 'qualified :timeago',
            'ranked' => 'ranked :timeago',
            'submitted' => 'submitted :timeago',
            'updated' => 'last updated :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'You have too many favourited beatmaps! Please unfavourite some before trying again.',
        ],

        'hype' => [
            'action' => 'Hype this map if you enjoyed playing it to help it progress to <strong>Ranked</strong> status.',

            'current' => [
                '_' => 'This map is currently :status.',

                'status' => [
                    'pending' => 'pending',
                    'qualified' => 'qualified',
                    'wip' => 'work in progress',
                ],
            ],

            'disqualify' => [
                '_' => 'If you find an issue with this beatmap, please disqualify it :link.',
                'button_title' => 'Disqualify a qualified beatmap.',
            ],

            'report' => [
                '_' => 'If you find an issue with this beatmap, please report it :link to alert the team.',
                'button' => 'Report Problem',
                'button_title' => 'Report a problem on a qualified beatmap.',
                'link' => 'here',
            ],
        ],

        'info' => [
            'description' => 'Description',
            'genre' => 'Genre',
            'language' => 'Language',
            'no_scores' => 'Data still being calculated...',
            'points-of-failure' => 'Points of Failure',
            'source' => 'Source',
            'success-rate' => 'Success Rate',
            'tags' => 'Tags',
            'unranked' => 'Unranked beatmap',
        ],

        'scoreboard' => [
            'achieved' => 'achieved :when',
            'country' => 'Country Ranking',
            'friend' => 'Friend Ranking',
            'global' => 'Global Ranking',
            'supporter-link' => 'Click <a href=":link">here</a> to see all the fancy features that you get!',
            'supporter-only' => 'You need to be an osu!supporter to access the friend and country rankings!',
            'title' => 'Scoreboard',

            'headers' => [
                'accuracy' => 'Accuracy',
                'combo' => 'Max Combo',
                'miss' => 'Miss',
                'mods' => 'Mods',
                'player' => 'Player',
                'pp' => 'pp',
                'rank' => 'Rank',
                'score_total' => 'Total Score',
                'score' => 'Score',
            ],

            'no_scores' => [
                'country' => 'No one from your country has set a score on this map yet!',
                'friend' => 'None of your friends has set a score on this map yet!',
                'global' => 'No scores yet. Maybe you should try setting some?',
                'loading' => 'Loading scores...',
                'unranked' => 'Unranked beatmap.',
            ],
            'score' => [
                'first' => 'In the Lead',
                'own' => 'Your Best',
            ],
        ],

        'stats' => [
            'cs' => 'Circle Size',
            'cs-mania' => 'Key Amount',
            'drain' => 'HP Drain',
            'accuracy' => 'Accuracy',
            'ar' => 'Approach Rate',
            'stars' => 'Star Difficulty',
            'total_length' => 'Length (Drain length: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Circle Count',
            'count_sliders' => 'Slider Count',
            'user-rating' => 'User Rating',
            'rating-spread' => 'Rating Spread',
            'nominations' => 'Nominations',
            'playcount' => 'Playcount',
        ],

        'status' => [
            'ranked' => 'Ranked',
            'approved' => 'Approved',
            'loved' => 'Loved',
            'qualified' => 'Qualified',
            'wip' => 'WIP',
            'pending' => 'Pending',
            'graveyard' => 'Graveyard',
        ],
    ],
];
