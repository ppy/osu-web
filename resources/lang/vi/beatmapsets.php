<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'title' => 'Danh Sách Beatmap',
        'guest_title' => 'Beatmaps',
    ],

    'show' => [
        'discussion' => 'Discussion',

        'details' => [
            'made-by' => 'made by ',
            'submitted' => 'submitted on ',
            'updated' => 'last updated on ',
            'ranked' => 'ranked on ',
            'approved' => 'approved on ',
            'qualified' => 'qualified on ',
            'loved' => 'loved on ',
            'logged-out' => 'You need to log in before downloading any beatmaps!',
            'download' => [
                '_' => 'Download',
                'video' => 'with Video',
                'no-video' => 'without Video',
                'direct' => 'osu!direct',
            ],
            'favourite' => 'Favourite this beatmapset',
            'unfavourite' => 'Unfavourite this beatmapset',
            'favourited_count' => '+ 1 other!|+ :count others!',
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
        ],
        'info' => [
            'no_scores' => 'Unranked beatmap',
            'points-of-failure' => 'Points of Failure',
            'success-rate' => 'Success Rate',

            'description' => 'Description',

            'source' => 'Source',
            'tags' => 'Tags',
        ],
        'scoreboard' => [
            'achieved' => 'achieved :when',
            'country' => 'Country Ranking',
            'friend' => 'Friend Ranking',
            'global' => 'Global Ranking',
            'supporter-link' => 'Click <a href=":link">here</a> to see all the fancy features that you get!',
            'supporter-only' => 'You need to be a supporter to access the friend and country rankings!',
            'title' => 'Scoreboard',

            'list' => [
                'accuracy' => 'Accuracy',
                'player-header' => 'Player',
                'rank-header' => 'Rank',
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
            'stats' => [
                'accuracy' => 'Accuracy',
                'combo' => 'Combo',
                'misses' => 'Miss',
                'score' => 'Score',
            ],
        ],
    ],
];
