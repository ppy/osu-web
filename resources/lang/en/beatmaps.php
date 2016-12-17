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
        'delete' => 'delete',
        'deleted' => 'Deleted by :editor :delete_time',
        'edit' => 'edit',
        'edited' => 'Last edited by :editor :update_time',
        'message_placeholder' => 'Type here to post',
        'message_type_select' => 'Select Comment Type',
        'reply_placeholder' => 'Type your response here',
        'require-login' => 'Please login to post or reply',
        'resolved' => 'Resolved',
        'restore' => 'restore',
        'title' => 'Discussions',

        'collapse' => [
            'all-collapse' => 'Collapse all',
            'all-expand' => 'Expand all',
        ],

        'empty' => [
            'empty' => 'No discussions yet!',
            'hidden' => 'No discussion matches selected filter.',
        ],

        'message_hint' => [
            'in_general' => 'This post will go to general beatmapset discussion. To mod this beatmap, start message with timestamp (e.g. 00:12:345).',
            'in_timeline' => 'To mod multiple timestamps, post multiple times (one post per timestamp).',
        ],

        'message_type' => [
            'praise' => 'Praise',
            'problem' => 'Problem',
            'suggestion' => 'Suggestion',
        ],

        'mode' => [
            'general' => 'General',
            'timeline' => 'Timeline',
        ],

        'new' => [
            'timestamp' => 'Timestamp',
            'timestamp_missing' => 'ctrl-c in edit mode and paste in your message to add a timestamp!',
            'title' => 'New Discussion',
        ],

        'show' => [
            'title' => ':title mapped by :mapper',
        ],

        'stats' => [
            'deleted' => 'Deleted',
            'mine' => 'Mine',
            'pending' => 'Pending',
            'praises' => 'Praises',
            'resolved' => 'Resolved',
            'total' => 'Total',
        ],
    ],

    'nominations' => [
        'disqualifed-at' => 'disqualified :time_ago (:reason).',
        'disqualifed_no_reason' => 'no reason specified',
        'disqualification-prompt' => 'Reason for disqualification?',
        'disqualify' => 'Disqualify',
        'incorrect-state' => 'Error performing that action, try refreshing the page.',
        'nominate' => 'Nominate',
        'nominate-confirm' => 'Nominate this beatmap?',
        'qualified' => 'Estimated to be ranked :date, if no issues are found.',
        'qualified-soon' => 'Estimated to be ranked soon, if no issues are found.',
        'required-text' => 'Nominations: :current/:required',
        'title' => 'Nomination Status',
    ],

    'listing' => [
        'search' => [
            'prompt' => 'type in keywords...',
            'options' => 'More Search Options',
            'not-found' => 'no results',
            'not-found-quote' => '... nope, nothing found.',
        ],
        'mode' => 'Mode',
        'status' => 'Rank Status',
        'mapped-by' => 'mapped by :mapper',
        'source' => 'from :source',
        'load-more' => 'Load more...',
    ],
    'beatmapset' => [
        'availability' => [
            'disabled' => 'This beatmap is currently not available for download.',
            'parts-removed' => 'Portions of this beatmap have been removed at the request of the creator or a third-party rights holder.',
            'more-info' => 'Check here for more information.',
        ],
        'show' => [
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
                'success-rate' => 'Success Rate',
                'points-of-failure' => 'Points of Failure',

                'description' => 'Description',

                'source' => 'Source',
                'tags' => 'Tags',
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
                'achieved' => 'achieved :when',
                'stats' => [
                    'score' => 'Score',
                    'accuracy' => 'Accuracy',
                    // note to TLs: the 5 keys below don't really need to be translated,
                    // as those should remain pretty much the same across languages
                    'countgeki' => 'MAX',
                    'count300' => '300',
                    'countkatu' => '200',
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
        'loved' => 'Loved',
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
    'mods' => [
        'NF' => 'No Fail',
        'EZ' => 'Easy Mode',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'SD' => 'Sudden Death',
        'DT' => 'Double Time',
        'Relax' => 'Relax',
        'HT' => 'Half Time',
        'NC' => 'Nightcore',
        'FL' => 'Flashlight',
        'SO' => 'Spun Out',
        'AP' => 'Auto Pilot',
        'PF' => 'Perfect',
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        'FI' => 'Fade In',
        '9K' => '9K',
        'NM' => 'No mods',
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
