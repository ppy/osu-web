<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Moraš biti prijavljen kako bi uredio.',
            'system_generated' => 'Sistemski generirana objava se ne može uređivati.',
            'wrong_user' => 'Moraš biti autor objave za uređivanje.',
        ],
    ],

    'events' => [
        'empty' => 'Ništa se nije dogodilo... još.',
    ],

    'index' => [
        'deleted_beatmap' => 'izbrisano',
        'none_found' => 'Nisu pronađene rasprave koje odgovaraju tim kriterijima pretraživanja.',
        'title' => 'Rasprava o beatmapama',

        'form' => [
            '_' => 'Pretraži',
            'deleted' => 'Uključi izbrisane rasprave ',
            'mode' => 'Mod beatmape',
            'only_unresolved' => 'Pokaži samo neriješene rasprave',
            'show_review_embeds' => 'Pokaži objave recenzije',
            'types' => 'Vrsta poruke',
            'username' => 'Korisničko ime',

            'beatmapset_status' => [
                '_' => 'Status beatmape',
                'all' => 'Svi',
                'disqualified' => 'Diskvalificiran',
                'never_qualified' => 'Nikad kvalificiran',
                'qualified' => 'Kvalificiran',
                'ranked' => 'Rangiran',
            ],

            'user' => [
                'label' => 'Korisnik',
                'overview' => 'Pregled aktivnosti',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Datum objave',
        'deleted_at' => 'Datum brisanja',
        'message_type' => 'Tip',
        'permalink' => 'Trajna poveznica',
    ],

    'nearby_posts' => [
        'confirm' => 'Niti jedna objava me ne zabrinjava',
        'notice' => 'Postoje objave od oko :timestamp (:existing_timestamps). Molimo da ih provjerite prije objavljivanja.',
        'unsaved' => ':count u ovoj recenziji',
    ],

    'owner_editor' => [
        'button' => 'Vlasnik težine',
        'reset_confirm' => 'Resetiraj vlasnika ove težine?',
        'user' => 'Vlasnik',
        'version' => 'Težina',
    ],

    'refresh' => [
        'checking' => 'Provjeravanje za novosti...',
        'has_updates' => 'Rasprava ima novosti, klikni da osvježiš stranicu.',
        'no_updates' => 'Nema ažuriranja.',
        'updating' => 'Ažuriranje...',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Prijavi se da odgovoriš',
            'user' => 'Odgovori',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max blokova iskorišteno',
        'go_to_parent' => 'Pogledaj recenziju',
        'go_to_child' => 'Pogledaj raspravu ',
        'validation' => [
            'block_too_large' => 'svaki blok može iskoristiti do :limit karaktera ',
            'external_references' => 'recenzija sadrži reference na probleme koji ne pripadaju ovoj recenziji',
            'invalid_block_type' => 'nevažeća vrsta blokova',
            'invalid_document' => 'nevažeća recenzija',
            'invalid_discussion_type' => 'nevažeća vrsta rasprave ',
            'minimum_issues' => 'recenzija mora sadržavati najmanje :count problem|recenzija mora sadržavati najmanje :count problema',
            'missing_text' => 'bloku nedostaje tekst',
            'too_many_blocks' => 'recenzije mogu sadržavati samo :count paragraf/problem|recenzije mogu sadržavati samo do :count paragrafa/problema',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Označeno kao riješeno od :user',
            'false' => 'Ponovno otvoreno od :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'općenito',
        'general_all' => 'općenito (sve)',
    ],

    'user_filter' => [
        'everyone' => 'Svi',
        'label' => 'Filtriraj prema korisniku',
    ],
];
