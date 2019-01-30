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

    'show' => [
        'discussion' => 'Discussion',

        'details' => [
            'approved' => 'approved on ',
            'favourite' => 'Favourite this beatmapset',
            'favourited_count' => '+ :count_delimited other!|+ :count_delimited others!',
            'logged-out' => 'You need to sign in before downloading any beatmaps!',
            'loved' => 'loved on ',
            'mapped_by' => 'mapped by :mapper',
            'qualified' => 'qualified on ',
            'ranked' => 'ranked on ',
            'submitted' => 'submitted on ',
            'unfavourite' => 'Unfavourite this beatmapset',
            'updated' => 'last updated on ',
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
            'total_length' => 'Length',
            'bpm' => 'BPM',
            'count_circles' => 'Circle Count',
            'count_sliders' => 'Slider Count',
            'user-rating' => 'User Rating',
            'rating-spread' => 'Rating Spread',
            'nominations' => 'Nominations',
            'playcount' => 'Playcount',
        ],
    ],
];
