<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Redagavimui reikia prisijungti.',
            'system_generated' => 'Sistemos sugeneruoti įrašai negali būti redaguojami.',
            'wrong_user' => 'Redaguoti gali tik įrašo siuntėjas.',
        ],
    ],

    'events' => [
        'empty' => 'Kol kas nieko neįvyko...',
    ],

    'index' => [
        'deleted_beatmap' => 'ištrintas',
        'none_found' => 'Jokių diskusijų atitinkančių šių paieškos kriterijų nebuvo rasta.',
        'title' => 'Bitmapo Diskusijos',

        'form' => [
            '_' => 'Ieškoti',
            'deleted' => 'Įtraukti ištrintas diskusijas',
            'mode' => 'Bitmapo režimas',
            'only_unresolved' => 'Rodyti tiktais neišspręstas diskusijas',
            'types' => 'Žinučių tipai',
            'username' => 'Vartotojo vardas',

            'beatmapset_status' => [
                '_' => 'Bitmapo Būsena',
                'all' => 'Visi',
                'disqualified' => 'Diskvalifikuotas',
                'never_qualified' => 'Niekada nebuvo kvalifikuotas',
                'qualified' => 'Kvalifikuotas',
                'ranked' => 'Reitinguotas',
            ],

            'user' => [
                'label' => 'Vartotojas',
                'overview' => 'Veiklos peržiūra',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Publikavimo data',
        'deleted_at' => 'Ištrynimo data',
        'message_type' => 'Tipas',
        'permalink' => 'Nuoroda',
    ],

    'nearby_posts' => [
        'confirm' => 'Nei vienas įrašas neišsprendžia mano rūpesčių',
        'notice' => 'Šie įrašai išsiųsti :timestamp (:existing_timestamps). Peržiūrėk juos, prieš publikuojant naują.',
        'unsaved' => ':count šioje apžvalgoje
',
    ],

    'owner_editor' => [
        'button' => 'Sunkumo Savininkas',
        'reset_confirm' => 'Atstatyti savininką šiam sunkumui?',
        'user' => 'Savininkas',
        'version' => 'Sunkumas',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Atsakymui reikia prisijungti',
            'user' => 'Atsakyti',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max teksto laukų panaudota',
        'go_to_parent' => 'Žiūrėti Apžvalgos Įrašą
',
        'go_to_child' => 'Peržiūrėti diskusiją
',
        'validation' => [
            'block_too_large' => 'kiekvienas teksto laukas gali turėti iki :limit ženklų',
            'external_references' => 'apžvalgoje yra nuorodų į problemas, kurios nepriklauso šiai apžvalgai',
            'invalid_block_type' => 'negalimas teksto lauko tipas',
            'invalid_document' => 'negalima apžvalga',
            'invalid_discussion_type' => 'negalimas diskusijos tipas',
            'minimum_issues' => 'apžvalgoje turi būti bent :count problema|apžvalgoje turi būti bent :count problemos(-ų)',
            'missing_text' => 'teksto lauke nėra teksto',
            'too_many_blocks' => 'apžvalga gali turėti tik :count pastraipą/problemą|apžvalga gali turėti tik :count pastraipas(-ų)/problemas(-ų)',
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
