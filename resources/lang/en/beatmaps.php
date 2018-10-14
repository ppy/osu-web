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
        'allow_kudosu' => 'allow kudosu',
        'delete' => 'delete',
        'deleted' => 'Deleted by :editor :delete_time.',
        'deny_kudosu' => 'deny kudosu',
        'edit' => 'edit',
        'edited' => 'Last edited by :editor :update_time.',
        'kudosu_denied' => 'Denied from obtaining kudosu.',
        'message_placeholder_deleted_beatmap' => 'This difficulty has been deleted so it may no longer be discussed.',
        'message_type_select' => 'Select Comment Type',
        'reply_notice' => 'Press enter to reply.',
        'reply_placeholder' => 'Type your response here',
        'require-login' => 'Please sign in to post or reply',
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

        'message_placeholder' => [
            'general' => 'Type here to post to General (:version)',
            'generalAll' => 'Type here to post to General (All difficulties)',
            'timeline' => 'Type here to post to Timeline (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Disqualify',
            'hype' => 'Hype!',
            'mapper_note' => 'Note',
            'nomination_reset' => 'Reset Nomination',
            'praise' => 'Praise',
            'problem' => 'Problem',
            'suggestion' => 'Suggestion',
        ],

        'mode' => [
            'events' => 'History',
            'general' => 'General :scope',
            'timeline' => 'Timeline',
            'scopes' => [
                'general' => 'This difficulty',
                'generalAll' => 'All difficulties',
            ],
        ],

        'new' => [
            'timestamp' => 'Timestamp',
            'timestamp_missing' => 'ctrl-c in edit mode and paste in your message to add a timestamp!',
            'title' => 'New Discussion',
        ],

        'show' => [
            'title' => ':title mapped by :mapper',
        ],

        'sort' => [
            '_' => 'Sorted by:',
            'created_at' => 'creation time',
            'timeline' => 'timeline',
            'updated_at' => 'last update',
        ],

        'stats' => [
            'deleted' => 'Deleted',
            'mapper_notes' => 'Notes',
            'mine' => 'Mine',
            'pending' => 'Pending',
            'praises' => 'Praises',
            'resolved' => 'Resolved',
            'total' => 'All',
        ],

        'status-messages' => [
            'approved' => 'This beatmap was approved on :date!',
            'graveyard' => "This beatmap hasn't been updated since :date and has most likely been abandoned by the creator...",
            'loved' => 'This beatmap was added to loved on :date!',
            'ranked' => 'This beatmap was ranked on :date!',
            'wip' => 'Note: This beatmap is marked as a work-in-progress by the creator.',
        ],

    ],

    'hype' => [
        'button' => 'Hype Beatmap!',
        'button_done' => 'Already Hyped!',
        'confirm' => "Are you sure? This will use one out of your remaining :n hype and can't be undone.",
        'explanation' => 'Hype this beatmap to make it more visible for nomination and ranking!',
        'explanation_guest' => 'Sign in and hype this beatmap to make it more visible for nomination and ranking!',
        'new_time' => "You'll get another hype :new_time.",
        'remaining' => 'You have :remaining hype left.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype Train',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Leave Feedback',
    ],

    'nominations' => [
        'delete' => 'Delete',
        'delete_own_confirm' => 'Are you sure? The beatmap will be deleted and you will be redirected back to your profile.',
        'delete_other_confirm' => 'Are you sure? The beatmap will be deleted and you will be redirected back to the user\'s profile.',
        'disqualification_prompt' => 'Reason for disqualification?',
        'disqualified_at' => 'Disqualified :time_ago (:reason).',
        'disqualified_no_reason' => 'no reason specified',
        'disqualify' => 'Disqualify',
        'incorrect_state' => 'Error performing that action, try refreshing the page.',
        'love' => 'Love',
        'love_confirm' => 'Love this beatmap?',
        'nominate' => 'Nominate',
        'nominate_confirm' => 'Nominate this beatmap?',
        'nominated_by' => 'nominated by :users',
        'qualified' => 'Estimated to be ranked :date, if no issues are found.',
        'qualified_soon' => 'Estimated to be ranked soon, if no issues are found.',
        'required_text' => 'Nominations: :current/:required',
        'reset_message_deleted' => 'deleted',
        'title' => 'Nomination Status',
        'unresolved_issues' => 'There are still unresolved issues that must be addressed first.',

        'reset_at' => [
            'nomination_reset' => 'Nomination process reset :time_ago by :user with new problem :discussion (:message).',
            'disqualify' => 'Disqualified :time_ago by :user with new problem :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Are you sure? Posting a new problem will reset nomination process.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'type in keywords...',
            'login_required' => 'Sign in to search.',
            'options' => 'More Search Options',
            'supporter_filter' => 'Filtering by :filters requires an active osu!supporter tag',
            'not-found' => 'no results',
            'not-found-quote' => '... nope, nothing found.',
            'filters' => [
                'general' => 'General',
                'mode' => 'Mode',
                'status' => 'Categories',
                'genre' => 'Genre',
                'language' => 'Language',
                'extra' => 'extra',
                'rank' => 'Rank Achieved',
                'played' => 'Played',
            ],
            'sorting' => [
                'title' => 'title',
                'artist' => 'artist',
                'difficulty' => 'difficulty',
                'updated' => 'updated',
                'ranked' => 'ranked',
                'rating' => 'rating',
                'plays' => 'plays',
                'relevance' => 'relevance',
                'nominations' => 'nominations',
            ],
            'supporter_filter_quote' => [
                '_' => 'Filtering by :filters requires an active :link',
                'link_text' => 'osu!supporter tag',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'Recommended difficulty',
        'converts' => 'Include converted beatmaps',
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
        'qualified' => 'Qualified',
        'loved' => 'Loved',
        'faves' => 'Favourites',
        'pending' => 'Pending & WIP',
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
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        '9K' => '9K',
        'AP' => 'Auto Pilot',
        'DT' => 'Double Time',
        'EZ' => 'Easy Mode',
        'FI' => 'Fade In',
        'FL' => 'Flashlight',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'HT' => 'Half Time',
        'NC' => 'Nightcore',
        'NF' => 'No Fail',
        'NM' => 'No mods',
        'PF' => 'Perfect',
        'Relax' => 'Relax',
        'SD' => 'Sudden Death',
        'SO' => 'Spun Out',
        'TD' => 'Touch Device',
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
    'played' => [
        'any' => 'Any',
        'played' => 'Played',
        'unplayed' => 'Unplayed',
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
