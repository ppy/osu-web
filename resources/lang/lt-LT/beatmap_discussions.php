<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Redagavimui reikia prisijungti.',
            'system_generated' => 'Sistemos sugeneruotos žinutės negali būti redaguojamos.',
            'wrong_user' => 'Redaguoti gali tik žinutės siuntėjas.',
        ],
    ],

    'events' => [
        'empty' => 'Kol kas nieko neįvyko...',
    ],

    'index' => [
        'deleted_beatmap' => 'ištrintas',
        'none_found' => 'Jokių diskusijų atitinkančių šių paieškos kriterijų nebuvo rasta.',
        'title' => 'Beatmapo Diskusijos',

        'form' => [
            '_' => 'Ieškoti',
            'deleted' => 'Įtraukti ištrintas diskusijas',
            'mode' => '',
            'only_unresolved' => 'Rodyti tiktais neišspręstas diskusijas',
            'types' => 'Žinutės tipai',
            'username' => 'Vartotojo vardas',

            'beatmapset_status' => [
                '_' => '„Beatmap“ Statusas',
                'all' => 'Visi',
                'disqualified' => 'Diskvalifikuotas',
                'never_qualified' => 'Niekada nekvalifikuotas',
                'qualified' => 'Kvalifikuotas',
                'ranked' => 'Patvirtintas',
            ],

            'user' => [
                'label' => 'Vartotojas',
                'overview' => 'Veiklos peržiūra',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Pranešimo data',
        'deleted_at' => 'Ištrynimo data',
        'message_type' => 'Tipas',
        'permalink' => 'Nuoroda',
    ],

    'nearby_posts' => [
        'confirm' => 'Nei viena žinutė neišsprendžia mano rūpesčių',
        'notice' => 'Šios žinutės išsiųstos :timestamp (:existing_timestamps). Peržiūrėk jas, prieš siunčiant naują.',
        'unsaved' => ':count šioje apžvalgoje
',
    ],

    'owner_editor' => [
        'button' => 'Žemėlapio savininkas',
        'reset_confirm' => '',
        'user' => 'Savininkas',
        'version' => 'Sudėtingumas',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Atsakymui reikia prisijungti',
            'user' => 'Atsakyti',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max blokų panaudota',
        'go_to_parent' => 'Žiurėti aprašymo publikavimą
',
        'go_to_child' => 'Peržiūrėti diskusiją
',
        'validation' => [
            'block_too_large' => 'kiekvienas blokas gali turėti iki :limit ženklų',
            'external_references' => '',
            'invalid_block_type' => '',
            'invalid_document' => '',
            'invalid_discussion_type' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => ':user pažymėjo kaip išspręsta',
            'false' => ':user atidarė vėl',
        ],
    ],

    'timestamp_display' => [
        'general' => 'bendras',
        'general_all' => 'bendras (visi)',
    ],

    'user_filter' => [
        'everyone' => 'Visi',
        'label' => 'Filtruoti pagal vartotoją',
    ],
];
