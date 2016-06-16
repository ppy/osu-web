<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
    'discussion-posts' => [
        'store' => [
            'error' => 'Failed saving post',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Failed updating vote',
        ],
    ],

    'discussions' => [
        'collapse' => [
            'all-collapse' => 'Collapse all',
            'all-expand' => 'Expand all',
        ],

        'edit' => 'edit',
        'edited' => 'Last edited by :editor :update_time',
        'empty' => [
            'empty' => 'No discussions yet!',
            'filtered' => 'No discussion matches selected filter.',
        ],

        'message_hint' => [
            'in_general' => 'This post will go to general beatmapset discussion. To mod this beatmap, start message with timestamp (e.g. 00:12:345).',
            'in_timeline' => 'To mod multiple timestamps, post multiple times (one post per timestamp).',
        ],

        'message_placeholder' => 'Type here to post',

        'message_type' => [
            'praise' => 'Praise',
            'problem' => 'Problem',
            'suggestion' => 'Suggestion',
        ],

        'message_type_select' => 'Select Comment Type',

        'mode' => [
            'general' => 'General',
            'timeline' => 'Timeline',
        ],

        'require-login' => 'Please login to post or reply',
        'resolved' => 'Resolved',

        'show' => [
            'title' => 'Beatmap Discussion',
        ],

        'stats' => [
            'mine' => 'Mine',
            'pending' => 'Pending',
            'praises' => 'Praises',
            'resolved' => 'Resolved',
            'total' => 'Total',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'type in keywords...',
            'options' => 'More Search Options',
            'not-found' => 'not results',
            'not-found-quote' => '... nope, nothing found.',
        ],
        'mode' => 'Mode',
        'status' => 'Rank Status',
        'mapped-by' => 'mapped by :mapper',
        'source' => 'from :source',
        'load-more' => 'Load more...',
    ],
    'beatmapset' => [
        'show' => [
            'details' => [
                'made-by' => 'made by :user',
                'submitted' => 'submitted on ',
                'ranked' => 'ranked on ',
                'logged-out' => 'You need to log in before downloading any beatmaps!',
                'download' => [
                    'normal' => 'download',
                    'direct' => 'osu!direct',
                    'no-video' => 'without video version',
                ],
            ],
            'stats' => [
                'cs' => 'Circle Size',
                'hp' => 'HP Drain',
                'od' => 'Accuracy',
                'ar' => 'Approach Rate',
                'stars' => 'Star Difficulty',
                'length' => 'Length',
                'bpm' => 'BPM',

                'chart' => [
                    'cs' => 'CS',
                    'hp' => 'HP',
                    'od' => 'OD',
                    'ar' => 'AR',
                    'sd' => 'SD',
                ],

                'source' => 'Source',
                'tags' => 'Tags',
            ],
            'extra' => [
                'description' => [
                    'title' => 'Description',
                ],
                'success-rate' => [
                    'title' => 'Success Rate',
                    'rate' => 'Success Rate: :percentage%',
                    'points' => 'Points of Failure',
                    'retry' => 'Retry',
                    'fail' => 'Fail',
                ],
                'scoreboard' => [
                    'title' => 'Scoreboard',
                    'no-scores' => [
                        'global' => 'No scores yet. Maybe you should try setting some?',
                        'loading' => 'Loading scores...',
                        'country' => 'No one from your country has set a score on this map yet!',
                        'friend' => 'No one of your friends has set a score on this map yet!',
                    ],
                    'supporter-only' => 'You need to be a supporter to access the friend and country rankings!',
                    'supporter-link' => 'Click <a href=":link">here</a> to see all the fancy features that you get!',
                    'global' => 'Global Ranking',
                    'country' => 'Country Ranking',
                    'friend' => 'Friend Ranking',
                    'first' => [
                        'accuracy' => 'Accuracy',
                        'score' => 'Score',
                        'count300' => '300',
                        'count100' => '100',
                        'count50' => '50',
                    ],
                    'list' => [
                        'rank-header' => 'Rank',
                        'player-header' => 'Player',
                        'score' => 'Score',
                        'accuracy' => 'Accuracy',
                    ],
                ],
            ],
        ],
    ],
    'mode' => [
        'any' => 'Any',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Any',
        'ranked-approved' => 'Ranked & Approved',
        'approved' => 'Approved',
        'faves' => 'Favourites',
        'modreqs' => 'Mod Requests',
        'pending' => 'Pending',
        'graveyard' => 'Graveyard',
        'my-maps' => 'My Maps',
    ],
    'genre' => [
        'any' => 'Any',
        'unspecified' => 'Unspecified',
        'video-game' => 'Video Game',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Other',
        'novelty' => 'Novelty',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Electronic',
    ],
    'language' => [
    'any' => 'Any',
    'english' => 'English',
    'chinese' => 'Chinese',
    'french' => 'French',
    'german' => 'German',
    'italian' => 'Italian',
    'japanese' => 'Japanese',
    'korean' => 'Korean',
    'spanish' => 'Spanish',
    'swedish' => 'Swedish',
    'instrumental' => 'Instrumental',
    'other' => 'Other',
    ],
    'extra' => [
        'video' => 'Has Video',
        'storyboard' => 'Has Storyboard',
    ],
    'rank' => [
        'any' => 'Any',
        'XH' => 'Silver SS',
        'X' => 'SS',
        'SH' => 'Silver S',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];
