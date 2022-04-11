<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Dapat ay naka-sign-in para mag-edit.',
            'system_generated' => 'Hindi maaaring i-edit ang post na ginawa ng sistema.',
            'wrong_user' => 'Dapat ay may-ari ng post para maka-edit.',
        ],
    ],

    'events' => [
        'empty' => 'Walang pang nangyari... sa ngayon.',
    ],

    'index' => [
        'deleted_beatmap' => 'tinanggal',
        'none_found' => 'Walang diskusyon na tumugma sa pamantayan na hinahanap.',
        'title' => 'Talakayan ng Beatmap',

        'form' => [
            '_' => 'Search',
            'deleted' => 'Isama ang mga tinanggal na talakayan',
            'mode' => 'Mode ng beatmap',
            'only_unresolved' => 'Ipakita lamang ang diskusyon na hindi pa nalulutas',
            'types' => 'Mga uri ng mensahe',
            'username' => 'Username',

            'beatmapset_status' => [
                '_' => 'Estado ng beatmap',
                'all' => 'Lahat',
                'disqualified' => 'Diskwalipikado',
                'never_qualified' => 'Hindi kwalipikado',
                'qualified' => 'Kwalipikado',
                'ranked' => 'Ranked',
            ],

            'user' => [
                'label' => 'User',
                'overview' => 'Pangkalahatang aktibidad',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Petsa ng post',
        'deleted_at' => 'Petsa ng pagkakaalis',
        'message_type' => 'Uri',
        'permalink' => 'Permalink',
    ],

    'nearby_posts' => [
        'confirm' => 'Wala sa mga post ang nakatulong sa aking tungkulin',
        'notice' => 'Mayroong mga post noong humigit-kumulang :timestamp (:existing_timestamps). Mangyaring suriin ang mga ito bago mag-post.',
        'unsaved' => ':count sa pagsusuri na ito',
    ],

    'owner_editor' => [
        'button' => 'May-ari ng difficulty',
        'reset_confirm' => 'I-reset ang may-ari ng difficulty na ito?',
        'user' => 'May-ari',
        'version' => 'Difficulty',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Mag-sign in upang maka-sagot',
            'user' => 'Tumugon',
        ],
    ],

    'review' => [
        'block_count' => ':used sa :max na bloke ang gamit na',
        'go_to_parent' => 'Tignan ang naisuring poste',
        'go_to_child' => 'Tignan ang diskusyon',
        'validation' => [
            'block_too_large' => 'hanggang :limit na karakter lamang ang maaari sa bawat bloke',
            'external_references' => 'nagbabanggit ang rebyu ng mga isyu na hindi nababagay sa rebyu na ito',
            'invalid_block_type' => 'invalid na uri ng bloke',
            'invalid_document' => 'hindi wastong pagsusuri',
            'invalid_discussion_type' => 'maling uri ng diskusyon',
            'minimum_issues' => 'kailangang may :count o higit pa na mga isyu ang rebyu',
            'missing_text' => 'walang text ang bloke',
            'too_many_blocks' => 'hanggang :count na mga talata o isyu lamang ang maaari',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Minarkahang resolbado ni :user',
            'false' => 'Muling binuksan ni :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'pangkalahatan',
        'general_all' => 'pangkalahatan (lahat)',
    ],

    'user_filter' => [
        'everyone' => 'Lahat',
        'label' => 'I-filter sa user',
    ],
];
