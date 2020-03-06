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
    'discussion-posts' => [
        'store' => [
            'error' => '',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => '',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => '',
        'beatmap_information' => '',
        'delete' => '',
        'deleted' => '',
        'deny_kudosu' => '',
        'edit' => '',
        'edited' => '',
        'kudosu_denied' => '',
        'message_placeholder_deleted_beatmap' => '',
        'message_placeholder_locked' => '',
        'message_type_select' => '',
        'reply_notice' => '',
        'reply_placeholder' => '',
        'require-login' => '',
        'resolved' => '',
        'restore' => '',
        'show_deleted' => '',
        'title' => '',

        'collapse' => [
            'all-collapse' => '',
            'all-expand' => '',
        ],

        'empty' => [
            'empty' => '',
            'hidden' => '',
        ],

        'lock' => [
            'button' => [
                'lock' => '',
                'unlock' => '',
            ],

            'prompt' => [
                'lock' => '',
                'unlock' => '',
            ],
        ],

        'message_hint' => [
            'in_general' => '',
            'in_timeline' => '',
        ],

        'message_placeholder' => [
            'general' => '',
            'generalAll' => '',
            'timeline' => '',
        ],

        'message_type' => [
            'disqualify' => '',
            'hype' => '',
            'mapper_note' => '',
            'nomination_reset' => '',
            'praise' => '',
            'problem' => '',
            'review' => '',
            'suggestion' => '',
        ],

        'mode' => [
            'events' => '',
            'general' => '',
            'reviews' => '',
            'timeline' => '',
            'scopes' => [
                'general' => '',
                'generalAll' => '',
            ],
        ],

        'new' => [
            'pin' => '',
            'timestamp' => '',
            'timestamp_missing' => '',
            'title' => '',
            'unpin' => '',
        ],

        'show' => [
            'title' => '',
        ],

        'sort' => [
            'created_at' => '',
            'timeline' => '',
            'updated_at' => '',
        ],

        'stats' => [
            'deleted' => '',
            'mapper_notes' => '',
            'mine' => '',
            'pending' => '',
            'praises' => '',
            'resolved' => '',
            'total' => '',
        ],

        'status-messages' => [
            'approved' => '',
            'graveyard' => "",
            'loved' => '',
            'ranked' => '',
            'wip' => '',
        ],

        'votes' => [
            'none' => [
                'down' => '',
                'up' => '',
            ],
            'latest' => [
                'down' => '',
                'up' => '',
            ],
        ],
    ],

    'hype' => [
        'button' => '',
        'button_done' => '',
        'confirm' => "",
        'explanation' => '',
        'explanation_guest' => '',
        'new_time' => "",
        'remaining' => '',
        'required_text' => '',
        'section_title' => '',
        'title' => '',
    ],

    'feedback' => [
        'button' => '',
    ],

    'nominations' => [
        'delete' => '',
        'delete_own_confirm' => '',
        'delete_other_confirm' => '',
        'disqualification_prompt' => '',
        'disqualified_at' => '',
        'disqualified_no_reason' => '',
        'disqualify' => '',
        'incorrect_state' => '',
        'love' => '',
        'love_confirm' => '',
        'nominate' => '',
        'nominate_confirm' => '',
        'nominated_by' => '',
        'not_enough_hype' => "",
        'qualified' => '',
        'qualified_soon' => '',
        'required_text' => '',
        'reset_message_deleted' => '',
        'title' => '',
        'unresolved_issues' => '',

        'reset_at' => [
            'nomination_reset' => '',
            'disqualify' => '',
        ],

        'reset_confirm' => [
            'nomination_reset' => '',
            'disqualify' => '',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => '',
            'login_required' => '',
            'options' => '',
            'supporter_filter' => '',
            'not-found' => '',
            'not-found-quote' => '',
            'filters' => [
                'general' => '',
                'mode' => '',
                'status' => '',
                'genre' => '',
                'language' => '',
                'extra' => '',
                'rank' => '',
                'played' => '',
            ],
            'sorting' => [
                'title' => '',
                'artist' => '',
                'difficulty' => '',
                'favourites' => '',
                'updated' => '',
                'ranked' => '',
                'rating' => '',
                'plays' => '',
                'relevance' => '',
                'nominations' => '',
            ],
            'supporter_filter_quote' => [
                '_' => '',
                'link_text' => '',
            ],
        ],
    ],
    'general' => [
        'recommended' => '',
        'converts' => '',
    ],
    'mode' => [
        'any' => '',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => '',
        'approved' => '',
        'favourites' => '',
        'graveyard' => '',
        'leaderboard' => '',
        'loved' => '',
        'mine' => '',
        'pending' => '',
        'qualified' => '',
        'ranked' => '',
    ],
    'genre' => [
        'any' => '',
        'unspecified' => '',
        'video-game' => '',
        'anime' => '',
        'rock' => '',
        'pop' => '',
        'other' => '',
        'novelty' => '',
        'hip-hop' => '',
        'electronic' => '',
    ],
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'MR' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'Relax' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
    ],
    'language' => [
        'any' => '',
        'english' => '',
        'chinese' => '',
        'french' => '',
        'german' => '',
        'italian' => '',
        'japanese' => '',
        'korean' => '',
        'spanish' => '',
        'swedish' => '',
        'instrumental' => '',
        'other' => '',
    ],
    'played' => [
        'any' => '',
        'played' => '',
        'unplayed' => '',
    ],
    'extra' => [
        'video' => '',
        'storyboard' => '',
    ],
    'rank' => [
        'any' => '',
        'XH' => '',
        'X' => '',
        'SH' => '',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => '',
        'favourites' => '',
    ],
];
