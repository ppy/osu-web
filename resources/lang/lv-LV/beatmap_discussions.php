<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Vajag būt pierakstījušamies, lai rediģētu.',
            'system_generated' => 'Sistēmas-ģenerēto rakstu nevar rediģēt.',
            'wrong_user' => ' Lai rediģētu, ir jābūt raksta īpašniekam.',
        ],
    ],

    'events' => [
        'empty' => 'Nekas nav noticis... pagaidām.',
    ],

    'index' => [
        'deleted_beatmap' => 'izdzēsts',
        'none_found' => 'Netika atrastas diskusijas šim meklēšanas kritērijam.',
        'title' => 'Ritma-Karšu Diskusijas',

        'form' => [
            '_' => 'Meklēt',
            'deleted' => 'Iekļaut dzēstās diskusijas',
            'mode' => 'Ritma-Karšu mods',
            'only_unresolved' => 'Rādīt tikai neatrisinātās diskusijas',
            'show_review_embeds' => 'Rādīt apskata rakstus',
            'types' => 'Ziņu tipi',
            'username' => 'Lietotājvārds',

            'beatmapset_status' => [
                '_' => 'Ritma-Kartes Statuss',
                'all' => 'Viss',
                'disqualified' => 'Diskvalificēta',
                'never_qualified' => 'Nekad Nav Bijusi Kvalificēta',
                'qualified' => 'Kvalificēta',
                'ranked' => 'Novērtēta',
            ],

            'user' => [
                'label' => 'Lietotājs',
                'overview' => 'Aktivitāšu pārskats',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Raksta datums',
        'deleted_at' => 'Dzēšanas datums',
        'message_type' => 'Tips',
        'permalink' => 'Patstāvīgā saitne',
    ],

    'nearby_posts' => [
        'confirm' => 'Neviens no šiem rakstiem neattiecas uz manu problēmu',
        'notice' => 'Ir raksti ap :timestamp (:existing_timestamps). Lūdzu, pārbaudi tos pirms publicēšanas.',
        'unsaved' => ':count šajā atsauksmē',
    ],

    'owner_editor' => [
        'button' => 'Grūtības Īpašnieks',
        'reset_confirm' => 'Atiestatīt īpašnieku šai grūtībai?',
        'user' => 'Īpašnieks',
        'version' => 'Grūtība',
    ],

    'refresh' => [
        'checking' => 'Pārbauda atjauninājumus...',
        'has_updates' => 'Šai diskusijai ir atjauninājumi, uzspiest lai atsvaidzinātu.',
        'no_updates' => 'Nav atjauninājumu.',
        'updating' => 'Atjauninās...',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Pierakstieties, lai atbildētu',
            'user' => 'Atbildēt',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max bloki izmantoti',
        'go_to_parent' => 'Skatīt Atsauksmes Rakstu',
        'go_to_child' => 'Skatīt Diskusiju',
        'validation' => [
            'block_too_large' => 'katrā blokā drīkst būt ne vairāk kā :limit rakstzīmes',
            'external_references' => 'atsauksmē ir atsauces uz problēmām, kas neietilpst šajā atsauksmē',
            'invalid_block_type' => 'nederīgs bloka tips',
            'invalid_document' => 'nederīga atsauksme',
            'invalid_discussion_type' => 'nederīgs diskusijas tips',
            'minimum_issues' => 'atsauksmē jābūt vismaz :count problēma|atsauksmē jābūt vismaz :count problēmas',
            'missing_text' => 'blokā trūkst teksta',
            'too_many_blocks' => 'atsauksmēs var būt tikai :count rindkopa/problēma|atsauksmēs var būt tikai līdz :count rindkopām/problēmām',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => ':user ir atzīmējis kā atrisinātu',
            'false' => ':user ir atkārtoti atvēris',
        ],
    ],

    'timestamp_display' => [
        'general' => 'visparīgi',
        'general_all' => 'vispārīgi (viss)',
    ],

    'user_filter' => [
        'everyone' => 'Visi',
        'label' => 'Filtrēt pēc lietotāja',
    ],
];
