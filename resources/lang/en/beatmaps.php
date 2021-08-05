<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Failed updating vote',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'allow kudosu',
        'beatmap_information' => 'Beatmap Page',
        'delete' => 'delete',
        'deleted' => 'Deleted by :editor :delete_time.',
        'deny_kudosu' => 'deny kudosu',
        'edit' => 'edit',
        'edited' => 'Last edited by :editor :update_time.',
        'guest' => 'Guest difficulty by :user',
        'kudosu_denied' => 'Denied from obtaining kudosu.',
        'message_placeholder_deleted_beatmap' => 'This difficulty has been deleted so it may no longer be discussed.',
        'message_placeholder_locked' => 'Discussion for this beatmap has been disabled.',
        'message_placeholder_silenced' => "Can't post discussion while silenced.",
        'message_type_select' => 'Select Comment Type',
        'reply_notice' => 'Press enter to reply.',
        'reply_placeholder' => 'Type your response here',
        'require-login' => 'Please sign in to post or reply',
        'resolved' => 'Resolved',
        'restore' => 'restore',
        'show_deleted' => 'Show deleted',
        'title' => 'Discussions',

        'collapse' => [
            'all-collapse' => 'Collapse all',
            'all-expand' => 'Expand all',
        ],

        'empty' => [
            'empty' => 'No discussions yet!',
            'hidden' => 'No discussion matches selected filter.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Lock discussion',
                'unlock' => 'Unlock discussion',
            ],

            'prompt' => [
                'lock' => 'Reason for locking',
                'unlock' => 'Are you sure to unlock?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'This post will go to general beatmap discussion. To mod this difficulty, start message with timestamp (e.g. 00:12:345).',
            'in_timeline' => 'To mod multiple timestamps, post multiple times (one post per timestamp).',
        ],

        'message_placeholder' => [
            'general' => 'Type here to post to General (:version)',
            'generalAll' => 'Type here to post to General (All difficulties)',
            'review' => 'Type here to post a review',
            'timeline' => 'Type here to post to Timeline (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Disqualify',
            'hype' => 'Hype!',
            'mapper_note' => 'Note',
            'nomination_reset' => 'Reset Nomination',
            'praise' => 'Praise',
            'problem' => 'Problem',
            'review' => 'Review',
            'suggestion' => 'Suggestion',
        ],

        'mode' => [
            'events' => 'History',
            'general' => 'General :scope',
            'reviews' => 'Reviews',
            'timeline' => 'Timeline',
            'scopes' => [
                'general' => 'This difficulty',
                'generalAll' => 'All difficulties',
            ],
        ],

        'new' => [
            'pin' => 'Pin',
            'timestamp' => 'Timestamp',
            'timestamp_missing' => 'ctrl-c in edit mode and paste in your message to add a timestamp!',
            'title' => 'New Discussion',
            'unpin' => 'Unpin',
        ],

        'review' => [
            'new' => 'New Review',
            'embed' => [
                'delete' => 'Delete',
                'missing' => '[DISCUSSION DELETED]',
                'unlink' => 'Unlink',
                'unsaved' => 'Unsaved',
                'timestamp' => [
                    'all-diff' => 'Posts on "All difficulties" can\'t be timestamped.',
                    'diff' => 'If this :type starts with a timestamp, it will be shown under Timeline.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'insert paragraph',
                'praise' => 'insert praise',
                'problem' => 'insert problem',
                'suggestion' => 'insert suggestion',
            ],
        ],

        'show' => [
            'title' => ':title mapped by :mapper',
        ],

        'sort' => [
            'created_at' => 'Creation time',
            'timeline' => 'Timeline',
            'updated_at' => 'Last update',
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
            'graveyard' => "This beatmap wasn't updated since :date so it was graveyarded...",
            'loved' => 'This beatmap was added to loved on :date!',
            'ranked' => 'This beatmap was ranked on :date!',
            'wip' => 'Note: This beatmap is marked as a work-in-progress by the creator.',
        ],

        'votes' => [
            'none' => [
                'down' => 'No downvotes yet',
                'up' => 'No upvotes yet',
            ],
            'latest' => [
                'down' => 'Latest downvotes',
                'up' => 'Latest upvotes',
            ],
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
        'love_choose' => 'Choose difficulty for loved',
        'love_confirm' => 'Love this beatmap?',
        'nominate' => 'Nominate',
        'nominate_confirm' => 'Nominate this beatmap?',
        'nominated_by' => 'nominated by :users',
        'not_enough_hype' => "There isn't enough hype.",
        'remove_from_loved' => 'Remove from Loved',
        'remove_from_loved_prompt' => 'Reason for removing from Loved:',
        'required_text' => 'Nominations: :current/:required',
        'reset_message_deleted' => 'deleted',
        'title' => 'Nomination Status',
        'unresolved_issues' => 'There are still unresolved issues that must be addressed first.',

        'rank_estimate' => [
            '_' => 'This map is estimated to be ranked :date if no issues are found. It is #:position in the :queue.',
            'queue' => 'ranking queue',
            'soon' => 'soon',
        ],

        'reset_at' => [
            'nomination_reset' => 'Nomination process reset :time_ago by :user with new problem :discussion (:message).',
            'disqualify' => 'Disqualified :time_ago by :user with new problem :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Are you sure? Posting a new problem will reset the nomination process.',
            'disqualify' => 'Are you sure? This will remove the beatmap from qualifying and reset the nomination process.',
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
                'extra' => 'Extra',
                'general' => 'General',
                'genre' => 'Genre',
                'language' => 'Language',
                'mode' => 'Mode',
                'nsfw' => 'Explicit Content',
                'played' => 'Played',
                'rank' => 'Rank Achieved',
                'status' => 'Categories',
            ],
            'sorting' => [
                'title' => 'Title',
                'artist' => 'Artist',
                'difficulty' => 'Difficulty',
                'favourites' => 'Favourites',
                'updated' => 'Updated',
                'ranked' => 'Ranked',
                'rating' => 'Rating',
                'plays' => 'Plays',
                'relevance' => 'Relevance',
                'nominations' => 'Nominations',
            ],
            'supporter_filter_quote' => [
                '_' => 'Filtering by :filters requires an active :link',
                'link_text' => 'osu!supporter tag',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Include converted beatmaps',
        'follows' => 'Subscribed mappers',
        'recommended' => 'Recommended difficulty',
    ],
    'mode' => [
        'all' => 'All',
        'any' => 'Any',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Any',
        'approved' => 'Approved',
        'favourites' => 'Favourites',
        'graveyard' => 'Graveyard',
        'leaderboard' => 'Has Leaderboard',
        'loved' => 'Loved',
        'mine' => 'My Maps',
        'pending' => 'Pending',
        'qualified' => 'Qualified',
        'ranked' => 'Ranked',
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
        'metal' => 'Metal',
        'classical' => 'Classical',
        'folk' => 'Folk',
        'jazz' => 'Jazz',
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
        'MR' => 'Mirror',
        'NC' => 'Nightcore',
        'NF' => 'No Fail',
        'NM' => 'No mods',
        'PF' => 'Perfect',
        'RX' => 'Relax',
        'SD' => 'Sudden Death',
        'SO' => 'Spun Out',
        'TD' => 'Touch Device',
        'V2' => 'Score V2',
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
        'russian' => 'Russian',
        'polish' => 'Polish',
        'instrumental' => 'Instrumental',
        'other' => 'Other',
        'unspecified' => 'Unspecified',
    ],

    'nsfw' => [
        'exclude' => 'Hide',
        'include' => 'Show',
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
    'panel' => [
        'playcount' => 'Playcount: :count',
        'favourites' => 'Favourites: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'All',
        ],
    ],
];
