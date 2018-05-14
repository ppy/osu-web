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
        'delete' => '',
        'deleted' => 'Deleted by :editor :delete_time',
        'deny_kudosu' => '',
        'edit' => '',
        'edited' => 'Last edited by :editor :update_time',
        'kudosu_denied' => '',
        'message_placeholder' => '',
        'message_placeholder_deleted_beatmap' => '',
        'message_type_select' => '',
        'reply_notice' => 'Press enter to submit.',
        'reply_placeholder' => '',
        'require-login' => 'Please login to post or reply',
        'resolved' => '',
        'restore' => '',
        'title' => '',

        'collapse' => [
            'all-collapse' => '',
            'all-expand' => '',
        ],

        'empty' => [
            'empty' => '',
            'hidden' => '',
        ],

        'message_hint' => [
            'in_general' => '',
            'in_timeline' => '',
        ],

        'message_type' => [
            'disqualify' => '',
            'hype' => '',
            'mapper_note' => '',
            'nomination_reset' => '',
            'praise' => '',
            'problem' => '',
            'suggestion' => '',
        ],

        'mode' => [
            'events' => '',
            'general' => 'General',
            'timeline' => '',
            'scopes' => [
                'general' => '',
                'generalAll' => '',
            ],
        ],

        'new' => [
            'timestamp' => '',
            'timestamp_missing' => '',
            'title' => '',
        ],

        'show' => [
            'title' => '',
        ],

        'sort' => [
            '_' => '',
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
        'disqualification_prompt' => '',
        'disqualified_at' => '',
        'disqualified_no_reason' => '',
        'disqualify' => '',
        'incorrect_state' => '',
        'nominate' => '',
        'nominate_confirm' => '',
        'nominated_by' => '',
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
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => '',
            'options' => '',
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
        ],
        'mode' => '',
        'status' => '',
        'mapped-by' => '',
        'source' => '',
        'load-more' => '',
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
        'ranked-approved' => '',
        'approved' => '',
        'qualified' => '',
        'loved' => '',
        'faves' => '',
        'pending' => '',
        'graveyard' => '',
        'my-maps' => '',
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
];
