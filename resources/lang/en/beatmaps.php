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
        'empty' => 'No discussions yet!',

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
            'contents' => [
                'made-by' => 'made by ',
                'submitted' => 'submitted on ',
                'ranked' => 'ranked on ',
                'logged-out' => 'You need to log in before downloading any beatmaps!',
                'download' => [
                    'normal' => 'download',
                    'direct' => 'osu!direct',
                    'no-video' => 'without video version',
                ],
            ],
            'extra' => [
                'description' => [
                    'title' => 'Description',
                ],
                'success-rate' => [
                    'title' => 'Success Rate',
                ],
                'scoreboard' => [
                    'title' => 'Scoreboard',
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
